<?php

namespace App\Helper\Field;

class EditorField extends TextareaField
{

    public function __construct($name, $label, $value=null)
    {
        parent::__construct($name, $label, $value);
        $this->setAttr('class', 'ckeditor');
    }

}