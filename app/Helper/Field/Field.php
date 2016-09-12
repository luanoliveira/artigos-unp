<?php

namespace App\Helper\Field;

abstract class Field
{
   protected $label;

   protected $name;

   protected $value;

   protected $attrs;

   protected $row;

   public function __construct($name, $label, $value=null)
   {
      $this->setName($name);

      $this->setLabel($label);

      $this->setValue($value);
   }

   public function setRow($row)
   {
      $this->row = $row;
      return $this;
   }

   public function isRow()
   {
      return !is_null($this->row);
   }

   public function getRow()
   {
      return $this->row;
   }

   public function setLabel($label)
   {
      $this->label = $label;
   }

   public function getLabel()
   {
      return $this->label;
   }

   public function setName($name)
   {
      $this->name = $name;
   }

   public function getName()
   {
      return $this->name;
   }

   public function setValue($value)
   {
      if ( old($this->getName()) ) {
         $this->value = old($this->getName());
         return;
      }

      $this->value = $value;
   }

   public function getValue()
   {
      return $this->value;
   }

   public function tag()
   {
      return $this->getName();
   }

   public function setAttr($attr, $value=null)
   {
      $this->attrs[$attr] = $value;

      return $this;
   }

   public function getAttrsFormated()
   {
      if ( $this->attrs )
      {
         $attrs = array_map(function($value, $key) {
            return !is_null($value) ? sprintf("%s=\"%s\"", $key, $value) : $key;
         }, $this->attrs, array_keys($this->attrs));

         return implode(' ', $attrs);
      }

   }
}
