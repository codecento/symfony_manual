<?php
// src/AppBundle/Form/UsuarioType.php 
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre')
        ->add('apellidos')
        ->add('email', EmailType::class)
        ->add('password', RepeatedType::class, array( 
            'type' => PasswordType::class, 
            'invalid_message' => 'Las dos contraseñas deben coincidir', 
            'first_options' => array('label' => 'Contraseña'), 
            'second_options' => array('label' => 'Repite Contraseña'), )) 
        ->add('direccion')
        ->add('permiteEmail')
        ->add('fechaNacimiento', BirthdayType::class)
        ->add('dni')
        ->add('numero_tarjeta')
        ->add('ciudad')
        ->add('permiteEmail', CheckboxType::class, array('required' => false)) 
        ->add('registrarme', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario',
        ));
    }
    public function getBlockPrefix()
    {
        return 'usuario';
    }
}
