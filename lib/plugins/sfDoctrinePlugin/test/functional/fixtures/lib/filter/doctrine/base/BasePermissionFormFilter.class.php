<?php

/**
 * Permission filter form base class.
 *
 * @author     Your name here
 */
abstract class BasePermissionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(['name'        => new sfWidgetFormFilterInput(), 'users_list'  => new sfWidgetFormDoctrineChoice(['multiple' => true, 'model' => 'User']), 'groups_list' => new sfWidgetFormDoctrineChoice(['multiple' => true, 'model' => 'Group'])]);

    $this->setValidators(['name'        => new sfValidatorPass(['required' => false]), 'users_list'  => new sfValidatorDoctrineChoice(['multiple' => true, 'model' => 'User', 'required' => false]), 'groups_list' => new sfValidatorDoctrineChoice(['multiple' => true, 'model' => 'Group', 'required' => false])]);

    $this->widgetSchema->setNameFormat('permission_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addUsersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = [$values];
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.UserPermission UserPermission')
      ->andWhereIn('UserPermission.user_id', $values)
    ;
  }

  public function addGroupsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = [$values];
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.GroupPermission GroupPermission')
      ->andWhereIn('GroupPermission.group_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Permission';
  }

  public function getFields()
  {
    return ['id'          => 'Number', 'name'        => 'Text', 'users_list'  => 'ManyKey', 'groups_list' => 'ManyKey'];
  }
}
