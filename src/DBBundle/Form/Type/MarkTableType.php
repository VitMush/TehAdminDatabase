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

class MarkTableType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        /*$resolver->setDefaults(array(
            'textHello' => 'hello'
            'label' => null,
            'label_render' => null,
            'sonata_field_description' => null
            'template' => 'DBBundle:mark_table.html.twig'
        ));*/
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$options = array('textHello' => 'hello');
        $builder->addEventListener(Form\FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $marksTable = $form->getData();
            $view = $form->getViewData();

            //throw new Exception($event->getForm()->isSubmitted() ? 'true' : 'false');
            //throw new Exception(implode('  ', array_keys($event->getData()['marks']['Vit'])));
            //throw new Exception($event->getData()['marks']['Vit']['Астро']);
            
            return;
            if(is_array($view)){
                throw new Exception(implode(' ', array_keys($view['marks'])));
            }
            else throw new Exception(get_class($marksTable));
        });
    }

    public function getParent()
    {
        return CollectionType::class;
    }

    public function getName(){
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix(){
        return 'mark_table';
    }
}