<?php

namespace App\Form;

use App\Entity\Pole;
use App\Entity\DasErmr;
use App\Entity\Direction;
use App\Entity\VoieAdmin;
use App\Entity\Exposition;
use App\Entity\Litterature;
use App\Entity\Imputabilite;
use App\Entity\EssaisCliniques;
use App\Entity\MecanismeAction;
use App\Entity\SignalPotentiel;
use App\Entity\EffetRCPautrePays;
use App\Repository\PoleRepository;
use App\Repository\DasErmrRepository;
use App\Repository\DirectionRepository;
use App\Repository\VoieAdminRepository;
use App\Repository\ExpositionRepository;
use Symfony\Component\Form\AbstractType;
use App\Repository\LitteratureRepository;
use App\Repository\ImputabiliteRepository;
use App\Repository\EssaisCliniquesRepository;
use App\Repository\MecanismeActionRepository;
use App\Repository\EffetRCPautrePaysRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SignalPotentielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Direction', EntityType::class, [
                'class' => Direction::class,
                'choice_label' => 'LibelleCourt',
                'query_builder' => function (DirectionRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->orderBy('d.LibelleCourt', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => '',
                'required' => true,
            ])
            ->add('Pole', EntityType::class, [
                'class' => Pole::class,
                'choice_label' => 'LibelleCourt',
                'query_builder' => function (PoleRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->orderBy('d.LibelleCourt', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => '',
                'required' => true,
            ])
            ->add('EvalNom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('EvalPrenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('Substance', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('Dosage', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('VoieAdmin', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            
            ->add('VoieAdmin', EntityType::class, [
                'class' => VoieAdmin::class,
                'choice_label' => 'Libelle',
                'query_builder' => function (VoieAdminRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->andWhere('d.codeTermePere IS NULL')
                        ->orderBy('d.OrdreAffichage', 'ASC');
                },
                'placeholder' => '',
                'attr' => [
                    'class' => 'form-select',
                ],
                'required' => true,
            ])
            ->add('SignalPotentiel', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('OrigineSignal', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('MecanismeAction', EntityType::class, [
                'class' => MecanismeAction::class,
                'choice_label' => fn(MecanismeAction $mecanismeAction) => $mecanismeAction->getLibelle() . ' (' . $mecanismeAction->getScore() . ')',
                'query_builder' => function (MecanismeActionRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->orderBy('d.Score', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => '',
                'required' => true,
            ])
            ->add('Exposition', EntityType::class, [
                'class' => Exposition::class,
                'choice_label' => fn(Exposition $exposition) => $exposition->getLibelle() . ' (' . $exposition->getScore() . ')',
                'query_builder' => function (ExpositionRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->orderBy('d.Score', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => '',
                'required' => true,
            ])
            ->add('Imputabilite', EntityType::class, [
                'label' => '3) Robustesse des cas disponibles : Imputabilité (méthode OMS<sup><a href="#methode-oms" class="text-decoration-none">1</a></sup>)<sup><a href="#robustesse-cas" class="text-decoration-none">2</a></sup> :',
                'label_html' => true, // Permet d'utiliser du HTML dans le label
                'class' => Imputabilite::class,
                'choice_label' => fn(Imputabilite $imputabilite) => $imputabilite->getLibelle() . ' (' . $imputabilite->getScore() . ')',
                'query_builder' => function (ImputabiliteRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->orderBy('d.Score', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => '',
                'required' => true,
            ])
            ->add('Litterature', EntityType::class, [
                'label' => '4) Littérature (étude non-clinique, étude pharmacoépidémiologie, case reports, Métanalyse, etc.<sup><a href="#pertinence-litterature" class="text-decoration-none">3</a></sup>)<sup><a href="#score-litterature" class="text-decoration-none">4</a></sup> :',
                'label_html' => true,
                'class' => Litterature::class,
                'choice_label' => fn(Litterature $litterature) => $litterature->getLibelle() . ' (' . $litterature->getScore() . ')',
                'query_builder' => function (LitteratureRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->orderBy('d.Score', 'DESC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => '',
                'required' => true,
            ])
            ->add('EssaisCliniques', EntityType::class, [
                'label' => '5) Essais cliniques<sup><a href="#disproportionalite-stat" class="text-decoration-none">5</a></sup> :',
                'label_html' => true,
                'class' => EssaisCliniques::class,
                'choice_label' => fn(EssaisCliniques $essaisCliniques) => $essaisCliniques->getLibelle() . ' (' . $essaisCliniques->getScore() . ')',
                'query_builder' => function (EssaisCliniquesRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->orderBy('d.Score', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => '',
                'required' => true,
            ])
            ->add('EffetRCPautrePays', EntityType::class, [
                'class' => EffetRCPautrePays::class,
                'choice_label' => fn(EffetRCPautrePays $effetRCPautrePays) => $effetRCPautrePays->getLibelle() . ' (' . $effetRCPautrePays->getScore() . ')',
                'query_builder' => function (EffetRCPautrePaysRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->orderBy('d.Score', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => '',
                'required' => true,
            ])
            ->add('DasErmr', EntityType::class, [
                'class' => DasErmr::class,
                'choice_label' => fn(DasErmr $dasErmr) => $dasErmr->getLibelle() . ' (' . $dasErmr->getScore() . ')',
                'query_builder' => function (DasErmrRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.Inactif = 0')
                        ->orderBy('d.Score', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
                'placeholder' => '',
                'required' => true,
            ])
            ->add('Score', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'readonly' => true, // Rend le champ non modifiable par l'utilisateur
                    'id' => 'score-field', // Identifiant unique pour le champ
                ],
            ])
            ->add('Commentaire', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('Validation', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary m-2'],
                'label' => 'Valider',
                'row_attr' => ['id' => 'validation'],
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SignalPotentiel::class,
        ]);
    }
}
