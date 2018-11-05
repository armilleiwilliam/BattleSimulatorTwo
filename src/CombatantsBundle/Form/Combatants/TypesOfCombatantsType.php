<?php

namespace CombatantsBundle\Form\Combatants;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypesOfCombatantsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')->add('createdAt')->add('updatedAt')->add('health')->add('defense')->add('luck')->add('speed')->add('strength');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CombatantsBundle\Entity\Combatants\TypesOfCombatants'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'combatantsbundle_combatants_typesofcombatants';
    }


}
