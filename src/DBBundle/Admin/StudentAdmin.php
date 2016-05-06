<?php
namespace DBBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class StudentAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('name', 'text', array())
                ->add("number", 'text')
                ->add('bk', 'text')
                ->add('birth', 'date', array('years' => range(1990, date('Y'))))
                ->add('personCertificate', 'text')
                ->add('inn', 'text')
                ->add('gender', 'text')
                ->add('recordbook', 'text')                
                ->add('status', 'text')
                ->add('address', 'text')
                ->add('parents', 'text')
                ->add('notation', 'text', array())
                ->add('group', 'sonata_type_model', array('class' => 'DBBundle\Entity\Group', 'required' => false));

        $subject = $this->getSubject();
        $creation = $subject && $subject->getId() ? false : true;

        /*if(!$creation) {
            if (!is_null($subject->getGroup()))
                $this->log(implode($subject->getGroup()->getValues()));
            else $this->log('No Groups');
        }*/
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('name')
                ->add("number")
                ->add('bk')
                ->add('birth', 'doctrine_orm_date', array('input_type' => 'timestamp', 'years' => range(1990, date('Y'))))
                ->add('gender')
                ->add('recordbook')    
                ->add('status')
                ->add('address');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->add('id')
                ->addIdentifier('name')
                ->add("number")
                ->add('bk')
                ->add('birth')
                ->add('personCertificate')
                ->add('inn')
                ->add('gender')
                ->add('recordbook')                
                ->add('status')
                ->add('address')
                ->add('parents')
                ->add('notation');
    }
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
           ->add('id')
           ->add('name');
    }

    /**
     * @param mixed $message
     */
    private function log($message){
        $this->getConfigurationPool()->getContainer()->get('Logger')->debug($message);
    }
    
    public function toString($object) {
        //return $object->getName();
        return $object instanceof \DBBundle\Entity\Student
                ? $object->getName() 
                : '_some_ Category';
    }
}