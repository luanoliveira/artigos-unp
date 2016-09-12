<?php

namespace App\Helper;

class Tag
{
   protected $tagName;

   //protected $attrs = [];

   protected $isEmpty;

   protected $attrs = [];

   protected $html = [];

   public function __construct($tagName, $isEmpty=false)
   {
      $this->tagName = $tagName;
      $this->isEmpty = $isEmpty;
   }

   public function setAttr($attr, $value=null)
   {
      $this->attrs[$attr] = $value;

      return $this;
   }

   public function openTag()
   {
      $attrs = array_map(function($attr, $value) {
         return $value ? sprintf('%s="%s"', $attr, $value) : $attr;
      }, array_keys($this->attrs), $this->attrs);

      $this->html[] = sprintf('<%s%s%s>', $this->tagName, ' '.implode(' ', $attrs), $this->isEmpty ? ' /' : null);
   }

   public function closeTag()
   {
      if ( !$this->isEmpty )
      {
         $this->html[] = sprintf('</%s>', $this->tagName);
      }
   }

   public function setTagChild(Tag $tag)
   {
      if ( !$this->isEmpty )
      {
         $this->html[] = $tag->render();
      }
   }

   public function setHtmlChild($html)
   {
      if ( !$this->isEmpty )
      {
         $this->html[] = $html;
      }
   }

   public function render()
   {
      /*
      $this
         ->setAttr('class', 'ola')
         ->setAttr('data-nome', 'Luan Oliveira');

      $this->openTag();
      $this->setHtmlChild('Olá mundo');
      $this->closeTag();
      */
      return implode('', $this->html);
   }

}
