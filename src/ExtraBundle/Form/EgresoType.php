<?php

namespace ExtraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EgresoType extends AbstractType
{
    /**
     * {@inheritdoc}
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
            'data_class' => 'ExtraBundle\Entity\Egreso',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'egreso';
    }


}
