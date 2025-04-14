<?php

namespace App\Controller;

use App\Entity\SignalPotentiel;
use App\Form\SignalPotentielType;
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
    public function saisie_nouveau_signal(Request $request): Response
    {
        $substance = $request->query->get('substance');
        $signalPotentiel = new SignalPotentiel();
        $signalPotentiel->setSubstance($substance);
        $form = $this->createForm(SignalPotentielType::class, $signalPotentiel);

        // dd($substance   );
        return $this->render('saisie_signal/saisie_nouveau_signal.html.twig', [
            'form' => $form,
        ]);
    }
}
