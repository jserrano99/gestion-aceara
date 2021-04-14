<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConceptoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('unidades', NumberType::class, [
                'label' => 'Unidades',
                'required' => true,
                'attr' => ["class" => "form-control"]
            ])
            ->add('tipoTratamiento', EntityType::class, [
                'label' => 'Tipo de Tratamiento',
                'class' => 'App\Entity\TipoTratamiento',
                'required' => true,
                'placeholder' => 'Seleccione Tipo Tratamiento ...',
                'attr' => ["class" => "form-control"]])
            ->add('Guardar', SubmitType::class, [
                "attr" => ["class" => "btn btn-t btn-success"
                ]])
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
        return 'formConcepto';
    }
}
