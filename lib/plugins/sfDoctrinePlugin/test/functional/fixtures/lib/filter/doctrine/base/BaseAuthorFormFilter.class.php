<?php

/**
 * Author filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseAuthorFormFilter extends BaseFormFilterDoctrine
{
    public function setup()
    {
        $this->setWidgets([
            'name' => new sfWidgetFormFilterInput(),
            'type' => new sfWidgetFormFilterInput(),
        ]);

        $this->setValidators([
            'name' => new sfValidatorPass(['required' => false]),
            'type' => new sfValidatorPass(['required' => false]),
        ]);

        $this->widgetSchema->setNameFormat('author_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'Author';
    }

    public function getFields()
    {
        return [
            'id' => 'Number',
            'name' => 'Text',
            'type' => 'Text',
        ];
    }
}
