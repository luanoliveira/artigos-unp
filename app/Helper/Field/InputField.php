<?php

namespace App\Helper\Field;

class InputField extends Field
{

    public function tag()
    {
        return "<input type=\"text\" name=\"{$this->getName()}\" id=\"field_{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttrsFormated()}>";
    }

}