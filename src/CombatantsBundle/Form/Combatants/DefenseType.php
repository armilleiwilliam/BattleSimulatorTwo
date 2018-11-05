<?php

namespace CombatantsBundle\Form\Combatants;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DefenseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('min',
            IntegerType::class,
            [
                'constraints' => [
                    new NotBlank(),
                    new Length([ 'min' => 1])
                ]
            ]
        )
            ->add('max',
                IntegerType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => 1])
                    ]
            ]
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CombatantsBundle\Entity\Combatants\Defense'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'combatantsbundle_combatants_defense';
    }


}
