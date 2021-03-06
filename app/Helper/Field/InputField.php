<?php

namespace App\Helper\Field;

use App\Helper\Tag;

class InputField extends Field
{

   public function tag()
   {
      $tag = new Tag('input');

      $tag
         ->setAttr('class', 'form-control')
         ->setAttr('type', 'text')
         ->setAttr('name', $this->getName())
         ->setAttr('id', 'field_'.$this->getName())
         ->setAttr('value', $this->getValue());

      $tag->openTag();

      return $tag->render();

      //return "<input type=\"text\" name=\"{$this->getName()}\" id=\"field_{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttrsFormated()}>";
   }

}
