<?php

/**
 * Setting filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseSettingFormFilter extends BaseFormFilterDoctrine
{
    public function setup()
    {
        $this->setWidgets(['name'       => new sfWidgetFormFilterInput(['with_empty' => false]), 'value'      => new sfWidgetFormFilterInput(), 'weight'     => new sfWidgetFormFilterInput(), 'created_at' => new sfWidgetFormFilterDate(['from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false])]);

        $this->setValidators(['name'       => new sfValidatorPass(['required' => false]), 'value'      => new sfValidatorPass(['required' => false]), 'weight'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(['required' => false])), 'created_at' => new sfValidatorDateRange(['required' => false, 'from_date' => new sfValidatorDateTime(['required' => false, 'datetime_output' => 'Y-m-d 00:00:00']), 'to_date' => new sfValidatorDateTime(['required' => false, 'datetime_output' => 'Y-m-d 23:59:59'])])]);

        $this->widgetSchema->setNameFormat('setting_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'Setting';
    }

    public function getFields()
    {
        return ['id'         => 'Number', 'name'       => 'Text', 'value'      => 'Text', 'weight'     => 'Number', 'created_at' => 'Date'];
    }
}
