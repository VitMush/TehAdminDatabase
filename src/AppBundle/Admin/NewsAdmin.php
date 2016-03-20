<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class NewsAdmin extends Admin
{
    protected $parentAssociationMapping = 'blogpost';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('title', 'text')
                ->add('body', 'textarea');
    }


    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('title')
                ->add('body')
                ->addIdentifier('category.name');
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
