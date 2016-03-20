<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class BlogPostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->tab('Main')
                    ->with('Content', array ('class' => 'col-md-9'))
                    ->add('title', 'text')
                    ->add('body', 'textarea')
                    ->end()
                    ->with('Meta Data', array ('class' => 'col-md-3'))
                    ->add('category', 'sonata_type_model', array(
                        'class' => 'AppBundle\Entity\Category',
                        'property' => 'name',
                        'required' => false
                        ))
                    ->end()
                ->end()
                ->tab("Extended")
                ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('title')
                ->add('body')
                ->add('category');
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper
                ->add('title')
                ->add('category', null, array(), 'entity', array(
                    'class' => 'AppBundle\Entity\Category',
                    'property' => 'name'
                ));
    }
    
    public function toString($object) {
        return $object instanceof \AppBundle\Entity\BlogPost 
                ? $object->getTitle() 
                : '_some_ BlogPost';
    }
}
