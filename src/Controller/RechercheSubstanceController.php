<?php

namespace App\Controller;

use App\Entity\SignalPotentiel;
use App\Form\RechercheSubstanceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class RechercheSubstanceController extends AbstractController
{
    #[Route('/recherche_substance', name: 'app_recherche_substance')]
    public function RechercheSubstance(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RechercheSubstanceType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $substance = $data['Substance'];
            $repository = $em->getRepository(SignalPotentiel::class);
            $results = $repository->findBy(['Substance' => $substance]);
            if (!$results) {
                // Aucune substance trouvée. On redirige vers l'écran de saisie pour la créer
                return $this->redirectToRoute('app_saisie_signal_new', [
                    'substance' => $substance,
                ]);
            } else {
                // Une ou plusieurs substances trouvées. On affiche les résultats pour que l'utilisateur puisse modifier la ligne qu'il souhaite ou en créer une nouvelle
            }
            dd($substance,$results);
            // Here you would typically fetch the data from the database
            // For example:
            // $repository = $this->getDoctrine()->getRepository(SignalPotentiel::class);
            // $results = $repository->findBy(['Substance' => $substance]);

            // For now, let's just return the submitted substance
            // return $this->render('recherche_substance/result.html.twig', [
            //     'substance' => $substance,
            //     // 'results' => $results,
            // ]);
        }



        return $this->render('recherche_substance/index.html.twig', [
            'controller_name' => 'RechercheSubstanceController',
            'form' => $form->createView(),
        ]);
    }
}
