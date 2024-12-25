<?php

/**
 * Attachment filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseAttachmentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(['file_path' => new sfWidgetFormFilterInput()]);

    $this->setValidators(['file_path' => new sfValidatorPass(['required' => false])]);

    $this->widgetSchema->setNameFormat('attachment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Attachment';
  }

  public function getFields()
  {
    return ['id'        => 'Number', 'file_path' => 'Text'];
  }
}
