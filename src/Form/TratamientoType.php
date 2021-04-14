<?php

namespace App\Form;

use App\Entity\Tratamiento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TratamientoType extends AbstractType
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
            ->add('fechaTratamiento', DateType::class, [
                "label" => 'Fecha Tratamiento',
                "required" => true,
                "disabled" => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control corto',
                    'data-date-format' => 'dd-mm-yyyy',
                    'data-class' => 'string']])
            ->add('motivoConsulta', TextareaType::class, [
                "label" => 'Motivo de la Consulta',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('descripcion', TextareaType::class, [
                "label" => 'Tratamiento Realizado',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('deleteTratamiento', ButtonType::class, [
                'label' => 'Eliminar ',
                "attr" => ["class" => "btn btn-t btn-danger"]])
            ->add('Guardar', SubmitType::class, [
                "attr" => ["class" => "btn btn-t btn-success"
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tratamiento::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'formTratamiento';
    }
}
