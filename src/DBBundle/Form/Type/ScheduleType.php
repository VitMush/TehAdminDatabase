<?php

namespace DBBundle\Form\Type;

use Doctrine\DBAL\Types\ArrayType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Deprecated\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form;

class ScheduleType extends AbstractType
{
    /*public function configureOptions(OptionsResolver $resolver)
    {
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }*/

    public function getParent()
    {
        return CollectionType::class;
    }

    public function getName(){
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix(){
        return 'schedule_table';
    }
}