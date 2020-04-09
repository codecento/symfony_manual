<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TiendaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('slug')
            ->add('login', TextType::class)
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class, 'invalid_message' => 'Las dos contraseñas deben coincidir', 'first_options' => array('label' => 'Contraseña'), 'second_options' => array('label' => 'Repite Contraseña'), 'required' => false
            ))
            ->add('descripcion')
            ->add('direccion')
            ->add('ciudad')
            ->add('guardar', SubmitType::class, array('label' => 'Guardar cambios'));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tienda'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tienda';
    }
}
