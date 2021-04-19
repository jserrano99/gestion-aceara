<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltroFechasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaInicio', DateType::class, [
                "label" => 'Fecha Inicio',
                "required" => true,
                "disabled" => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control corto',
                    'data-date-format' => 'dd-mm-yyyy',
                    'data-class' => 'string']])
            ->add('fechaFin', DateType::class, [
                "label" => 'Fecha Fin',
                "required" => true,
                "disabled" => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control corto',
                    'data-date-format' => 'dd-mm-yyyy',
                    'data-class' => 'string']])
            ->add('Guardar', SubmitType::class, [
                "attr" => ["class" => "btn btn-t btn-success"
                ]]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'formFiltroFechas';
    }
}
