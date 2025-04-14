<?php

namespace App\Form;

use App\Entity\Pole;
use App\Entity\Direction;
use App\Entity\SignalPotentiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheSubstanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('DMM')
            // ->add('PoleLong')
            // ->add('PoleCourt')
            // ->add('EvalNom')
            // ->add('EvalPrenom')
            ->add('Substance', TextType::class,
            [
                'label' => 'Substance active : ',
            ])
            ->add(
                'recherche',
                SubmitType::class,
                [
                    'attr' => ['class' => 'btn btn-primary m-2'],
                    'label' => 'Recherche/saisie',
                    'row_attr' => ['id' => 'recherche'],
                ])
            // ->add('Dosage')
            // ->add('VoieAdmin')
            // ->add('SignalPotentiel')
            // ->add('OrigineSignal')
            // ->add('MecanismeAction')
            // ->add('Exposition')
            // ->add('Imputabilie')
            // ->add('Litterature')
            // ->add('EssaisCliniques')
            // ->add('EffetRCPautrePays')
            // ->add('DasErmr')
            // ->add('Score')
            // ->add('Commentaire')
            // ->add('createdAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('updatedAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('userCreate')
            // ->add('userModif')
            // ->add('Direction', EntityType::class, [
            //     'class' => Direction::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('Pole', EntityType::class, [
            //     'class' => Pole::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => SignalPotentiel::class,
        ]);
    }
}
