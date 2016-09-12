<?php

namespace App\Helper;

class Form {

   protected $action;

   protected $method;

   protected $actionBack;

   protected $view;

   protected $data;

   protected $fields;

   protected $enctype = 'application/x-www-form-urlencoded';

   public function setAction($action)
   {
      $this->action = $action;
   }

   public function getAction()
   {
      return $this->action;
   }

   public function setEnctype($enctype)
   {
      $this->enctype = $enctype;
   }

   public function getEnctype()
   {
      return $this->enctype;
   }

   public function setMethod($method)
   {
      $this->method = strtoupper($method);
   }

   public function getMethod()
   {
      return $this->method;
   }

   public function isPUT()
   {
      if ( $this->method == 'PUT' )
      {
         return true;
      }

      return false;
   }

   public function setActionBack($action)
   {
      $this->actionBack = $action;
   }

   public function getActionBack()
   {
      return $this->actionBack;
   }

   public function isBack()
   {
      return $this->getActionBack() ? true : false;
   }

   public function setView($view)
   {
      $this->view = $view;
   }

   public function getView()
   {
      return $this->view;
   }

   public function setData($data)
   {
      $this->data = $data;
   }

   public function getData()
   {
      return $this->data;
   }

   public function setField($field)
   {
      $this->fields[] = $field;

      return $this;
   }

   public function getFields()
   {
      return $this->fields;
   }

}
