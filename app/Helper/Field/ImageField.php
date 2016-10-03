<?php

namespace App\Helper\Field;

use App\Helper\Tag;

use Storage;

class ImageField extends Field
{

   protected $callbackImageField;

   public function setCallbackImageField($callbackImageField)
   {
      if ( is_callable($callbackImageField) )
      {
         $this->callbackImageField = $callbackImageField;
      }

      return $this;
   }

   public function tag()
   {
      $name = $this->getName();

      $html[] = "<input type=\"file\" name=\"{$this->getName()}\" id=\"field_{$this->getName()}\" class=\"form-control\" value=\"{$this->getValue()}\" {$this->getAttrsFormated()}>";

      if ( $this->isRow() && $this->getRow()->$name )
      {
         $image = is_callable($this->callbackImageField) ? call_user_func_array($this->callbackImageField, [$this->getRow()]) : $this->getRow()->avatar;


         $html[] = '<a href="'.$image.'" target="_blank" class="thumbnail" style="width: 100px;">';
            $html[] = sprintf('<img src="%s">', $image);
         $html[] = '</a>';

         $html[] = '<div class="checkbox">';
            $html[] = '<label>';
               $html[] = "<input type=\"checkbox\" name=\"destroy_{$this->getName()}\"> Remover {$this->getLabel()}.";
            $html[] = '</label>';
         $html[] = '</div>';
      }

      return implode('', $html);
   }

}
