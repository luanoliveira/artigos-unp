<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TagsController extends GestorController
{
   public function index()
   {
      $this->ui->setTitle('Tags');

      $this->ui
      ->setPageAction('Nova Tag', route('gestor.tags.create'), ['class' => 'btn btn-primary btn-lg']);

      $this->ui->setMenuActive('gestor.tags');

      $table = new \App\Helper\Table('\App\Tag');
      $table->setColumn('name', 'Nome', function($data) {
         return $data->name;
      });
      $table->setColumn('created_at', 'Criado em', function($data) {
         return date_format(date_create($data->created_at), 'd/m/Y H:i:s');
      });
      $table->setColumn('updated_at', 'Atualizado em', function($data) {
         return date_format(date_create($data->updated_at), 'd/m/Y H:i:s');
      });

      $table->setAction('pencil-square-o', function($data) {
         return route('gestor.tags.edit', ['tag' => $data->id]);
      }, ['class' => 'btn btn-default']);

      $table->setAction('trash-o', function($data) {
         return route('gestor.tags.destroy', ['tag' => $data->id]);
      }, ['class' => 'btn btn-danger confirm']);

      return $this->viewTable($table);
   }

   public function create()
   {
      $this->ui->setTitle('Nova Tag');

      $this->ui->setMenuActive('gestor.tags');

      $formulario = new \App\Helper\Form;
      $formulario->setAction(route('gestor.tags.store'));
      $formulario->setActionBack(route('gestor.tags'));

      $name = new \App\Helper\Field\InputField('name', 'Título');
      $name->setAttr('class', 'form-control');

      $formulario->setField($name);

      return $this->viewForm($formulario);
   }

   public function store(Request $request)
   {
      $validator = $this->validator($request);

      if ($validator->fails()) {
         return redirect(route('gestor.tags.create'))
         ->withErrors($validator)
         ->withInput();
      }

      $tag = new \App\Tag;
      $tag->name = $request->name;
      $tag->save();

      $request->session()->flash('alert.success', 'Tag cadastrada com sucesso.');
      return redirect()->route('gestor.tags');
   }

   public function edit(Request $request, $tag)
   {
      $this->ui->setTitle('Editar Tag');

      $tag = \App\Tag::find($tag);

      $formulario = new \App\Helper\Form;
      $formulario->setAction(route('gestor.tags.update', ['tag' => $tag]));
      $formulario->setMethod('PUT');
      $formulario->setActionBack(route('gestor.tags'));

      $name = new \App\Helper\Field\InputField('name', 'Título', $tag->name);
      $name->setAttr('class', 'form-control');

      $formulario->setField($name);

      return $this->viewForm($formulario);
   }

   public function update(Request $request, $tag)
   {
      $validator = $this->validator($request);

      if ($validator->fails()) {
         return redirect(route('gestor.tags.edit', ['tag' => $tag]))
         ->withErrors($validator)
         ->withInput();
      }

      $tag = \App\Tag::find($tag);
      $tag->name = $request->name;
      $tag->save();

      $request->session()->flash('alert.success', 'Tag atualizado com sucesso.');
      return redirect()->route('gestor.tags');
   }

   public function destroy(Request $request, $tag)
   {
      $tag = \App\Tag::find($tag);

      $tag->delete();

      $request->session()->flash('alert.success', 'Tag deletada com sucesso.');
      return redirect()->route('gestor.tags');
   }

   protected function validator($request)
   {
      return \Validator::make($request->all(), [
         'name' => 'required|max:255'
      ]);
   }
}
