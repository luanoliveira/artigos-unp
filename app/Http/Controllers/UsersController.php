<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends GestorController
{
   public function index()
   {
      $this->ui->setTitle('Usuários');

      $this->ui
      ->setPageAction('Novo Usuário', route('gestor.users.create'), ['class' => 'btn btn-primary btn-lg']);

      $this->ui->setMenuActive('gestor.users');


      $table = new \App\Helper\Table('\App\User');
      $table->setColumn('name', 'Nome', function($data) {
         return $data->name;
      });
      $table->setColumn('email', 'E-mail', function($data) {
         return $data->email;
      });
      $table->setColumn('created_at', 'Criado em', function($data) {
         return date_format(date_create($data->created_at), 'd/m/Y H:i:s');
      });
      $table->setColumn('updated_at', 'Atualizado em', function($data) {
         return date_format(date_create($data->updated_at), 'd/m/Y H:i:s');
      });

      $table->setAction('pencil-square-o', function($data) {
         return route('gestor.users.edit', ['tag' => $data->id]);
      }, ['class' => 'btn btn-default']);

      $table->setAction('trash-o', function($data) {
         return route('gestor.users.destroy', ['tag' => $data->id]);
      }, ['class' => 'btn btn-danger confirm']);

      return $this->viewTable($table);
   }

   public function create()
   {
      $this->ui->setTitle('Novo Usuário');

      $this->ui->setMenuActive('gestor.users');

      $formulario = new \App\Helper\Form;
      $formulario->setAction(route('gestor.users.store'));
      $formulario->setActionBack(route('gestor.users'));

      $name = new \App\Helper\Field\InputField('name', 'Título');
      $name->setAttr('class', 'form-control');

      $formulario->setField($name);

      $email = new \App\Helper\Field\InputField('email', 'E-mail');
      $email->setAttr('class', 'form-control');

      $formulario->setField($email);

      return $this->viewForm($formulario);
   }
}
