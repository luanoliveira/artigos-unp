<?php

namespace App\Helper\Field;

use App\Helper\Tag;

class CheckboxField extends Field
{

   public function tag()
   {
      /*
      $tag = new Tag('input');

      $tag
         ->setAttr('class', 'form-control')
         ->setAttr('type', 'text')
         ->setAttr('name', $this->getName())
         ->setAttr('id', 'field_'.$this->getName())
         ->setAttr('value', $this->getValue());

      $tag->openTag();

      return $tag->render();
*/
      $html[] = '<div class="checkbox">';
         $html[] = '<label>';
            $html[] = "<input type=\"checkbox\" name=\"{$this->getName()}\"> {$this->getLabel()}";
         $html[] = '</label>';
      $html[] = '</div>';

      return implode('', $html);

      //return "<input type=\"text\" name=\"{$this->getName()}\" id=\"field_{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttrsFormated()}>";
   }

}
