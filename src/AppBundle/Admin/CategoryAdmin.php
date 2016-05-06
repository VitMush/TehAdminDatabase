<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CategoryAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text')->add("number", 'integer')
            ->add('blogposts', 'sonata_type_model', array(
                        'class' => 'AppBundle\Entity\BlogPost',
                        'property' => 'title',
                        'required' => false,
                        'multiple' => true
                        ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('name')
                ->add('id')
                ->add('blogPosts')
                ->add('number');
    }
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('number');
    }
    
        public function toString($object) {
        //return $object->getName();
        return $object instanceof \AppBundle\Entity\Category
                ? $object->getName() 
                : '_some_ Category';
    }
}