<?php

namespace DBBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class TableType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'DBBundle:mark_table.html.twig'
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("Table", 'SONATA_TYPE_MODEL');
    }

    public function getParent()
    {
        return ChoiceType;
    }
}