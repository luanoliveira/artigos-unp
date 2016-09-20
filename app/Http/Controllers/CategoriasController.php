<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use App\Categoria;

use Validator;

use App\Helper\Form;

class CategoriasController extends GestorController
{
   public function index()
   {
      $this
         ->ui
         ->setTitle('Categorias');

      $this
         ->ui
         ->setPageAction('Novo Categoria', route('gestor.categorias.create'), ['class' => 'btn btn-primary btn-lg']);

      $this->ui->setMenuActive('gestor.categorias');

      $table = new \App\Helper\Table('App\Categoria');

      $table->setColumn('name', 'Título', function($data) {
         return $data->name;
      });

      $table->setColumn('created_at', 'Criado em', function($data) {
         return date_format(date_create($data->created_at), 'd/m/Y H:i:s');
      });

      $table->setColumn('updated_at', 'Atualizado em', function($data) {
         return date_format(date_create($data->updated_at), 'd/m/Y H:i:s');
      });

      $table->setAction('external-link', function($data) {
         return '#';
      }, ['class' => 'btn btn-primary']);

      $table->setAction('pencil-square-o', function($data) {
         return route('gestor.categorias.edit', ['tag' => $data->id]);
      }, ['class' => 'btn btn-default']);

      $table->setAction('trash-o', function($data) {
         return route('gestor.categorias.destroy', ['tag' => $data->id]);
      }, ['class' => 'btn btn-danger confirm']);

      return $this->viewTable($table);
   }

   public function create()
   {
      $this->ui->setTitle('Nova Categoria');

      $this->ui->setMenuActive('gestor.categorias');

      $formulario = new Form;
      $formulario->setAction(route('gestor.categorias.store'));
      $formulario->setActionBack(route('gestor.categorias'));

      $name = new \App\Helper\Field\InputField('name', 'Título');
      $name->setAttr('class', 'form-control');

      $formulario->setField($name);

      return $this->viewForm($formulario);
   }

   public function store(Request $request)
   {
      $validator = $this->validator($request);

      if ($validator->fails()) {
         return redirect(route('gestor.categorias.create'))
         ->withErrors($validator)
         ->withInput();
      }

      $categoria = new Categoria;
      $categoria->name = $request->name;
      $categoria->save();

      $request->session()->flash('alert.success', 'Categoria cadastrada com sucesso.');
      return redirect()->route('gestor.categorias');
   }

   public function edit(Request $request, $categoria)
   {
      $this->ui->setTitle('Editar Categoria');

      $categoria = Categoria::find($categoria);

      $formulario = new Form;
      $formulario->setAction(route('gestor.categorias.update', ['categoria' => $categoria->id]));
      $formulario->setMethod('PUT');
      $formulario->setActionBack(route('gestor.categorias'));

      $name = new \App\Helper\Field\InputField('name', 'Título', $categoria->name);
      $name->setAttr('class', 'form-control');

      $formulario->setField($name);

      return $this->viewForm($formulario);
   }

   public function update(Request $request, $categoria)
   {
      $validator = $this->validator($request);

      if ($validator->fails()) {
         return redirect(route('gestor.categorias.edit', ['categoria' => $categoria]))
         ->withErrors($validator)
         ->withInput();
      }

      $categoria = Categoria::find($categoria);
      $categoria->name = $request->name;
      $categoria->save();

      $request->session()->flash('alert.success', 'Categoria atualizada com sucesso.');
      return redirect()->route('gestor.categorias');
   }

   public function destroy(Request $request, $categoria)
   {
      $categoria = Categoria::find($categoria);

      $categoria->delete();

      $request->session()->flash('alert.success', 'Categoria deletada com sucesso.');
      return redirect()->route('gestor.categorias');
   }

   protected function validator($request)
   {
      return Validator::make($request->all(), [
         'name' => 'required|max:255',
      ]);
   }

}
