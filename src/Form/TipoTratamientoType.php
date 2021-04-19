<?php

namespace App\Form;

use App\Entity\TipoTratamiento;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TipoTratamientoType extends AbstractType
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
            ->add('descripcion', TextType::class, [
                "label" => 'Descripcion',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])

            ->add('importe', TextType::class, [
                "label" => 'Importe Sin IVA',
                "required" => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('cuotaIva',TextType::class, [
                "label" => 'CuotaIva',
                "required" => false,
                'disabled'=> true,
                "attr" => ["class" => "form-control"
                ]])
            ->add('importeTotal',TextType::class, [
                "label" => 'Importe Total',
                "required" => false,
                'disabled'=> true,
                "attr" => ["class" => "form-control"
                ]])

            ->add('tipoIva', EntityType::class, [
                'label' => 'Tipo de IVA',
                'class' => 'App\Entity\TipoIva',
                'required' => true,
                'placeholder' => 'Seleccione Tipo de IVA ...',
                'attr' => ["class" => "form-control"]])
            ->add('Guardar', SubmitType::class, [
                "attr" => ["class" => "btn btn-t btn-success"
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TipoTratamiento::class,
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'formTipoTratamiento';
    }
}
