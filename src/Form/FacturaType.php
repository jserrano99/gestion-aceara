<?php

namespace App\Form;

use App\Entity\Factura;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FacturaType extends AbstractType
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
            ->add('numero', TextType::class, [
                "label" => 'Número',
                "required" => true,
                'disabled' => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('serie', TextType::class, [
                "label" => 'Serie',
                "required" => true,
                'disabled' => false,
                "attr" => ["class" => "form-control"
                ]])
            ->add('fechaFactura', DateType::class, [
                "label" => 'Fecha Factura',
                "required" => true,
                "disabled" => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'data-date-format' => 'dd-mm-yyyy',
                    'data-class' => 'string']])
            ->add('deleteFactura', ButtonType::class, [
                'label' => 'Eliminar ',
                "attr" => ["class" => "btn btn-t btn-danger"]])
            ->add('imprimirFactura', ButtonType::class, [
                'label' => 'Imprimir ',
                "attr" => ["class" => "btn btn-t btn-info"]])
            ->add('Guardar', SubmitType::class, [
                "attr" => ["class" => "btn btn-t btn-success"
                ]]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Factura::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'formFactura';
    }
}
