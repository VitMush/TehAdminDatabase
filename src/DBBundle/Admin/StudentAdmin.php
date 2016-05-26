<?php
namespace DBBundle\Admin;

use DBBundle\Form\Type\GenderType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class StudentAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $t = $this->getTranslator();
        $formMapper
                ->with($t->trans('student.mainInfo'), array('class' => 'col-md-4'))
                    ->add('name', 'text', array('label' => $t->trans('student.name')))
                    ->add('bk', 'choice', array(
                        'label' => $t->trans('student.bk'),
                        'expanded' => true,
                        'choices' => array(
                            'b' => $t->trans('student.b'),
                            'k' => $t->trans('student.b')
                        )
                    ))
                    ->add('gender', 'choice', array(
                        'label' => $t->trans('student.gender'), 
                        'expanded' => true,
                        'choices' => array(
                            'm' => $t->trans('student.male'),
                            'f' => $t->trans('student.female')))
                        )
                    ->add('birth', 'date', array(
                        'label' => $t->trans('student.birth'),
                        'years' => range(1990, date('Y'))))
                    ->add('status', 'text', array('label' => $t->trans('student.status')))
                    ->add('group', 'sonata_type_model', array(
                        'label' => $t->trans('student.group'),
                        'class' => 'DBBundle\Entity\Group',
                        'required' => false))
                ->end()

                ->with($t->trans('student.contactInfo'), array('class' => 'col-md-4'))
                    ->add('address', 'text', array('label' => $t->trans('student.address')))
                    ->add("number", 'text', array('label' => $t->trans('student.number')))
                    ->add('parents', 'textarea', array('label' => $t->trans('student.parents')))
                ->end()

            ->with($t->trans('student.adableInfo'), array('class' => 'col-md-4'))
            ->add('notation', 'textarea', array('label' => $t->trans('student.notation')))
            ->end()

                ->with($t->trans('student.personalInfo'), array('class' => 'col-md-5'))
                    ->add('personCertificate', 'text', array('label' => $t->trans('student.personal')))
                    ->add('inn', 'text', array('label' => $t->trans('student.inn')))
                    ->add('recordBook', 'text', array('label' => $t->trans('student.record')))
                ->end();

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
        $t = $this->getTranslator();
        $datagridMapper
                ->add('name', null, array('label' => $t->trans('student.name')))
                ->add("number", null, array('label' => $t->trans('student.number')))
                ->add('bk', null, array('label' => $t->trans('student.bk')))
                //->add('birth', 'doctrine_orm_date', array('input_type' => 'timestamp', 'years' => range(1990, date('Y'))))
                ->add('recordbook', null, array('label' => $t->trans('student.record')));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $t = $this->getTranslator();
        $listMapper
                ->addIdentifier('name', null, array('label' => $t->trans('student.name')))
                ->add('gender', null, array('label' => $t->trans('student.gender')))
                ->add('bk', null, array('label' => $t->trans('student.bk')))
                ->add('birth', null, array('label' => $t->trans('student.birth')))
                ->add("number", null, array('label' => $t->trans('student.number')))
                ->add('recordBook', null, array('label' => $t->trans('student.record')))
                ->add('status', null, array('label' => $t->trans('student.status')))
                ->add('notation', null, array('label' => $t->trans('student.notation')));
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