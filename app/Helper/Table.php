<?php

namespace App\Helper;

class Table
{
   protected $model;

   protected $columns=[];

   protected $actions=[];

   protected $data;

   protected $Query;

   protected $limit = 15;

   public function __construct($model, $callback=null)
   {
      $this->setModel($model);

      //$data = $model::orderBy('created_at', 'desc')->paginate(15);

      $this->Query = $model::select('*');

      if ( is_callable($callback) )
      {
         call_user_func_array($callback, [$this->Query]);
      }

      $this->data = $this
                        ->Query
                        ->orderBy('created_at', 'desc')
                        ->paginate($this->limit);

      //$this->setData($data);
   }

   public function setModel($model)
   {
      $this->model = $model;
   }

   public function getModel()
   {
      return $this->model;
   }

   public function setData($data)
   {
      $this->data = $data;
   }

   public function getData()
   {
      return $this->data;
   }

   public function setColumn($id, $name, $callback=null)
   {
      $this->columns[$id] = [
         'name' => $name,
         'callback' => $callback
      ];
   }

   public function getColumns()
   {
      return $this->columns;
   }

   public function setAction($icon, $linkCallback=null, array $attrs=[])
   {
      $this->actions[] = [
         'icon' => $icon,
         'linkCallback' => $linkCallback,
         'attrs' => $attrs
      ];

      return $this;
   }

   public function getActions()
   {
      return $this->actions;
   }
}
