<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', TextType::class, [
                "label" => 'Identificador',
                "required" => 'required',
                'disabled' => true,
                "attr" => ["class" => "form-control"
                ]])
            ->add('alias', TextareaType::class, [
                "label" => 'Alias',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('nombre', TextType::class, [
                "label" => 'Nombre',
                "required" => 'required',
                "attr" => ["class" => "form-control"
                ]])
            ->add('apellido1', TextType::class, [
                "label" => 'Primer Apellido',
                "required" => 'required',
                "attr" => ["class" => "form-control"
                ]])
            ->add('apellido2', TextType::class, [
                "label" => 'Segundo Apellido',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('domicilio', TextType::class, [
                "label" => 'Domicilio',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('codigoPostal', TextType::class, [
                "label" => 'Código Postal',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('fechaNacimiento', DateType::class, [
                "label" => 'Fecha Nacimiento',
                "required" => false,
                "disabled" => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control corto',
                    'data-date-format' => 'dd-mm-yyyy',
                    'data-class' => 'string']])
            ->add('profesion', TextareaType::class, [
                "label" => 'Profesión',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('comentarios', TextareaType::class, [
                "label" => 'Comentarios',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('movil', TextType::class, [
                "label" => 'Télefono Movil',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('telefono', TextareaType::class, [
                "label" => 'Otro Teléfono',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('email', EmailType::class, [
                "label" => 'Correo Electrónico',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('fechaAlta', DateType::class, [
                "label" => 'Fecha Alta',
                "required" => false,
                "disabled" => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control corto',
                    'data-date-format' => 'dd-mm-yyyy',
                    'data-class' => 'string']])
            ->add('nif', TextType::class, [
                "label" => 'NIF',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('idAnterior', HiddenType::class)
            ->add('deleteCliente', ButtonType::class, [
                'label' => 'Eliminar ',
                "attr" => ["class" => "btn btn-t btn-danger"]])
            ->add('Guardar', SubmitType::class, [
                "attr" => ["class" => "btn btn-t btn-success"
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'formCliente';
    }
}
