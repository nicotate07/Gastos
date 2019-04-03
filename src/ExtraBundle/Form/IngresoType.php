<?php

namespace ExtraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class IngresoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('monto')
            ->add('fecha', DateTimeType::class, array('widget'=>"single_text"))
            ->add('descripcion')
            ->add('evento', EntityType::class, array(
                    'class' => 'EventoBundle:Evento'
            ))
            ->add('ahorro', EntityType::class, array(
                'class' => 'AhorroBundle:Ahorro'
            ))
            ->add('cuenta', EntityType::class, array(
                'class' => 'CuentaBundle:Cuenta'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'data_class' => 'ExtraBundle\Entity\Ingreso'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ingreso';
    }
}
