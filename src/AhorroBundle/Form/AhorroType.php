<?php

namespace AhorroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use ExtraBundle\Form\IngresoType;
use ExtraBundle\Form\EgresoType;

class AhorroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fechaInicio', DateTimeType::class, array('widget'=>"single_text"))
            ->add('descripcion')
            ->add('usuario', EntityType::class, array(
                'class' => 'UsuarioBundle:Usuario'
            ))
            ->add('ingresos', CollectionType::class, array(
                'entry_type' => IngresoType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))
            ->add('egresos', CollectionType::class, array(
                'entry_type' => EgresoType::class,
                'allow_add' => true,
                'allow_delete' => true
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AhorroBundle\Entity\Ahorro',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ahorro';
    }


}
