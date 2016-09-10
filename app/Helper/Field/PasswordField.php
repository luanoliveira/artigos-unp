<?php

namespace App\Helper\Field;

class PasswordField extends Field
{

   public function tag()
   {
      return "<input type=\"password\" name=\"{$this->getName()}\" id=\"field_{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttrsFormated()}>";
   }

}
