<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\SignalPotentiel;
use App\Form\SignalPotentielType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SaisieSignalController extends AbstractController
{
    #[Route('/saisie_signal', name: 'app_saisie_signal')]
    public function index(): Response
    {
        return $this->render('saisie_signal/index.html.twig', [
            'controller_name' => 'SaisieSignalController',
        ]);
    }
    #[Route('/saisie_nouveau_signal', name: 'app_saisie_signal_new')]
    public function saisie_nouveau_signal(Request $request,ManagerRegistry $doctrine): Response
    {
        $substance = $request->query->get('substance');
        $signalPotentiel = new SignalPotentiel();
        $signalPotentiel->setSubstance($substance);
        $form = $this->createForm(SignalPotentielType::class, $signalPotentiel);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $dateNow = new DateTimeImmutable();

            $score = $signalPotentiel->getMecanismeAction()->getScore()
                    + $signalPotentiel->getExposition()->getScore()
                    + $signalPotentiel->getImputabilite()->getScore()
                    + $signalPotentiel->getLitterature()->getScore()
                    + $signalPotentiel->getEssaisCliniques()->getScore()      
                    + $signalPotentiel->getEffetRCPautrePays()->getScore()
                    + $signalPotentiel->getDasErmr()->getScore();

            $entityManager = $doctrine->getManager();
            $signalPotentiel->setCreatedAt($dateNow);
            $signalPotentiel->setUpdatedAt($dateNow);
            $signalPotentiel->setEvalNom(strtoupper($signalPotentiel->getEvalNom()));
            $signalPotentiel->setScore($score);
            $entityManager->persist($signalPotentiel);
            $entityManager->flush();
            $idSigPot=$signalPotentiel->getId();
            return $this->redirectToRoute('app_post_saisie_signal',[
                'idSigPot' => $idSigPot,
            ]);
        }
        // dd($substance   );
        return $this->render('saisie_signal/saisie_signal.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/post_saisie_signal/{idSigPot}', name: 'app_post_saisie_signal')]
    public function post_saisie_signal(int $idSigPot,ManagerRegistry $doctrine): Response
    {
        // Récupérer l'entité SignalPotentiel à partir de l'ID
        $entityManager = $doctrine->getManager();
        $signalPotentiel = $entityManager->getRepository(SignalPotentiel::class)->find($idSigPot);  if (!$signalPotentiel) {
            throw $this->createNotFoundException('SignalPotentiel not found');
        }
        // Récupérer les données du formulaire

        return $this->render('saisie_signal/post_saisie_signal.html.twig', [
            'signalPotentiel' => $signalPotentiel,
        ]);
    }
    #[Route('/edition_signal/{idSigPot}', name: 'app_edit_signal')]
    public function edition_signal(int $idSigPot,Request $request,ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();
        $signalPotentiel = $entityManager->getRepository(SignalPotentiel::class)->find($idSigPot);  if (!$signalPotentiel) {
            throw $this->createNotFoundException('SignalPotentiel not found');
        }
        // Récupérer les données du formulaire
        $form = $this->createForm(SignalPotentielType::class, $signalPotentiel);
        
        // return $this->render('saisie_signal/saisie_signal.html.twig', [
        //     'signalPotentiel' => $signalPotentiel,
        //     'form' => $form,
        // ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $dateNow = new DateTimeImmutable();

            $score = $signalPotentiel->getMecanismeAction()->getScore()
                    + $signalPotentiel->getExposition()->getScore()
                    + $signalPotentiel->getImputabilite()->getScore()
                    + $signalPotentiel->getLitterature()->getScore()
                    + $signalPotentiel->getEssaisCliniques()->getScore()      
                    + $signalPotentiel->getEffetRCPautrePays()->getScore()
                    + $signalPotentiel->getDasErmr()->getScore();

            $entityManager = $doctrine->getManager();
            // $signalPotentiel->setCreatedAt($dateNow);
            $signalPotentiel->setUpdatedAt($dateNow);
            $signalPotentiel->setEvalNom(strtoupper($signalPotentiel->getEvalNom()));
            $signalPotentiel->setScore($score);
            $entityManager->persist($signalPotentiel);
            $entityManager->flush();
            $idSigPot=$signalPotentiel->getId();
            return $this->redirectToRoute('app_post_saisie_signal',[
                'idSigPot' => $idSigPot,
            ]);
        }
        // dd($substance   );
        return $this->render('saisie_signal/saisie_signal.html.twig', [
            'form' => $form,
        ]);
    }
}
