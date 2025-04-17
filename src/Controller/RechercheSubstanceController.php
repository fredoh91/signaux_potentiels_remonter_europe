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
            $lstSignauxSaisis = $repository->findBy(['Substance' => $substance]);
            if (!$lstSignauxSaisis) {
                // Aucune substance trouvée. On redirige vers l'écran de saisie pour la créer
                return $this->redirectToRoute('app_saisie_signal_new', [
                    'substance' => $substance,
                ]);
            } else {
                // Une ou plusieurs substances trouvées. On affiche les résultats pour que l'utilisateur puisse modifier la ligne qu'il souhaite ou en créer une nouvelle
            }

            return $this->render('recherche_substance/liste_substances.html.twig', [
                'substance' => $substance,
                'lstSignauxSaisis' => $lstSignauxSaisis,
            ]);
        }

        return $this->render('recherche_substance/index.html.twig', [
            'controller_name' => 'RechercheSubstanceController',
            'form' => $form->createView(),
        ]);
    }
    #[Route('/recherche_toutes_substances', name: 'app_recherche_toutes_substances')]
    public function RechercheToutesSubstances(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(SignalPotentiel::class);
        $lstSignauxSaisis = $repository->findAll();
        if (!$lstSignauxSaisis) {
            // Aucune substance trouvée. On redirige vers l'écran de saisie pour la créer
            return $this->redirectToRoute('app_home');
        } else {
            // Une ou plusieurs substances trouvées. On affiche les résultats pour que l'utilisateur puisse modifier la ligne qu'il souhaite ou en créer une nouvelle
        }

        return $this->render('recherche_substance/liste_toutes_substances.html.twig', [
            'lstSignauxSaisis' => $lstSignauxSaisis,
        ]);
    }
}
