<?php

/**
 * ResourceType filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseResourceTypeFormFilter extends BaseFormFilterDoctrine
{
    public function setup()
    {
        $this->setWidgets([
            'name' => new sfWidgetFormFilterInput(),
        ]);

        $this->setValidators([
            'name' => new sfValidatorPass(['required' => false]),
        ]);

        $this->widgetSchema->setNameFormat('resource_type_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'ResourceType';
    }

    public function getFields()
    {
        return [
            'id' => 'Enum',
            'name' => 'Text',
        ];
    }
}
