<?php

namespace App\Helper\Field;

class TextareaField extends Field
{

    public function tag()
    {
        return "<textarea name=\"{$this->getName()}\" id=\"field_{$this->getName()}\" {$this->getAttrsFormated()}>{$this->getValue()}</textarea>";
    }

}