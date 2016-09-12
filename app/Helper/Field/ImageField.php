<?php

namespace App\Helper\Field;

use App\Helper\Tag;

use Storage;

class ImageField extends Field
{

   public function tag()
   {
      /*
      $tag = new Tag('input');

      $tag
         ->setAttr('type', 'file')
         ->setAttr('name', $this->getName())
         ->setAttr('id', 'field_'.$this->getName())
         ->setAttr('value', $this->getValue());

      $tag->openTag();

      if ( $this->getValue() )
      {
         $a = new Tag('a');
         $a
            ->setAttr('href', '#')
            ->setAttr('class', 'thumbnail');

         $img = new Tag('img');
         $img
            ->setAttr('src', config('app.url').Storage::url(sprintf('app/public/%s', $this->getValue())));

         $a->setTagChild($img);

      }
      */

      $html[] = "<input type=\"file\" name=\"{$this->getName()}\" id=\"field_{$this->getName()}\" class=\"form-control\" value=\"{$this->getValue()}\" {$this->getAttrsFormated()}>";

      if ( $this->isRow() && $this->getRow()->avatar )
      {
         $html[] = '<a href="#" class="thumbnail" style="width: 100px;">';
            $html[] = "<img src=\"{$this->getRow()->avatar}\">";
         $html[] = '</a>';

         $html[] = '<div class="checkbox">';
            $html[] = '<label>';
               $html[] = "<input type=\"checkbox\" name=\"destroy_{$this->getName()}\"> Remover {$this->getLabel()}.";
            $html[] = '</label>';
         $html[] = '</div>';
      }

      return implode('', $html);

      //return "<input type=\"text\" name=\"{$this->getName()}\" id=\"field_{$this->getName()}\" value=\"{$this->getValue()}\" {$this->getAttrsFormated()}>";
   }

}
