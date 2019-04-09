<?php

namespace UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use EventoBundle\Form\EventoType;
use AhorroBundle\Form\AhorroType;
use CuentaBundle\Form\CuentaType;

class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombreApellido')
            ->add('eventos', CollectionType::class, array(
                'entry_type' => EventoType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))
            ->add('ahorros', CollectionType::class, array(
                'entry_type' => AhorroType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))
            ->add('cuentas', CollectionType::class, array(
                'entry_type' => CuentaType::class,
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
            'data_class' => 'UsuarioBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'usuario';
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

}
