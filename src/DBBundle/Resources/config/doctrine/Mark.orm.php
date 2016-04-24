<?php

use Doctrine\ORM\Mapping\ClassMetadataInfo;

$metadata->setInheritanceType(ClassMetadataInfo::INHERITANCE_TYPE_NONE);
$metadata->customRepositoryClassName = 'DBBundle\Repository\MarkRepository';
$metadata->setChangeTrackingPolicy(ClassMetadataInfo::CHANGETRACKING_DEFERRED_IMPLICIT);
$metadata->mapField(array(
   'fieldName' => 'id',
   'type' => 'integer',
   'id' => true,
   'columnName' => 'id',
  ));
$metadata->mapField(array(
   'fieldName' => 'student',
   'type' => 'string',
   'length' => 10,
   'nullable' => true,
   'columnName' => 'student',
  ));
$metadata->mapField(array(
   'fieldName' => 'subj',
   'type' => 'string',
   'length' => 10,
   'columnName' => 'subj',
  ));
$metadata->mapField(array(
   'fieldName' => 'mark',
   'type' => 'tinyint',
   'columnName' => 'mark',
  ));
$metadata->mapField(array(
   'fieldName' => '--no-interaction',
   'type' => 'string',
   'length' => NULL,
   'columnName' => '--no-interaction',
  ));
$metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);