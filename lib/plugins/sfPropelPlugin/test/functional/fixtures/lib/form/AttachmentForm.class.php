<?php

/**
 * Attachment form.
 *
 */
class AttachmentForm extends BaseAttachmentForm
{
    public function configure()
    {
        $this->widgetSchema['file'] = new sfWidgetFormInputFile();
        $this->validatorSchema['file'] = new sfValidatorFile(['path' => sfConfig::get('sf_cache_dir'), 'mime_type_guessers' => []]);
    }
}
