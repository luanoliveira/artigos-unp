<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use App\Categoria;

use Validator;

use App\Helper\Form;

class PostsController extends GestorController
{
   public function index()
   {
      $this
         ->ui
         ->setTitle('Artigos');

      $this
         ->ui
         ->setPageAction('Novo Artigo', route('gestor.posts.create'), ['class' => 'btn btn-primary btn-lg']);

      $this->ui->setMenuActive('gestor.posts');

      $this->setBusca('post_title', '%{field}%');

      $table = new \App\Helper\Table('App\Post', function($Query) {
         if ( $this->isBusca() )
         {
            foreach ($this->getBusca() as $name => $like) {
               $Query->where($name, 'like', $like);
            }
         }
      });

      $table->setColumn('post_title', 'Título', function($data) {
         return $data->post_title;
      });
      $table->setColumn('post_tags', 'Tags', function($data) {
         $tags = array_map(function($tag) {
            return sprintf('<span class="label label-primary">%s</span>', $tag['name']);
         }, $data->tags->toArray());

         return implode(', ', $tags) ? implode(', ', $tags) : '-';
      });

      $table->setColumn('categorias_id', 'Categoria', function($data) {
         return $data->categoria ? $data->categoria->name : 'Não informado.';
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
         return route('gestor.posts.edit', ['tag' => $data->id]);
      }, ['class' => 'btn btn-default']);

      $table->setAction('trash-o', function($data) {
         return route('gestor.posts.destroy', ['tag' => $data->id]);
      }, ['class' => 'btn btn-danger confirm']);

      return $this->viewTable($table);
   }

   public function create()
   {
      $this->ui->setTitle('Novo Artigo');

      $this->ui->setMenuActive('gestor.posts');

      $formulario = new Form;
      $formulario->setAction(route('gestor.posts.store'));
      $formulario->setActionBack(route('gestor.posts'));

      $post_title = new \App\Helper\Field\InputField('post_title', 'Título');
      $post_title->setAttr('class', 'form-control');

      $formulario->setField($post_title);

      $post_content = new \App\Helper\Field\EditorField('post_content', 'Texto');

      $formulario->setField($post_content);

      $options = array_map(function($tag) {
         return $tag['name'];
      }, \App\Tag::all()->keyBy('id')->toArray());

      $tags = new \App\Helper\Field\SelectField('post_tags', 'Tags', $options);
      $tags->setMultiple();
      $tags->setAttr('class', 'form-control');

      $formulario->setField($tags);


      $options = array_map(function($categoria) {
         return $categoria['name'];
      }, \App\Categoria::all()->keyBy('id')->toArray());

      $categoria = new \App\Helper\Field\SelectField('categorias_id', 'Categoria', $options);
      $categoria
         ->setAttr('class', 'form-control');

      $formulario->setField($categoria);

      return $this->viewForm($formulario);
   }

   public function store(Request $request)
   {
      $validator = $this->validator($request);

      if ($validator->fails()) {
         return redirect(route('gestor.posts.create'))
         ->withErrors($validator)
         ->withInput();
      }

      $post = new Post;
      $post->post_title = $request->post_title;
      $post->post_content = $request->post_content;
      $post->user_created = \Auth::user()->id;
      $post->user_updated = \Auth::user()->id;
      if ( $request->categorias_id )
      {
         $post->categorias_id = $request->categorias_id;
      }
      
      $post->save();

      if ( $request->post_tags )
      {
         foreach($request->post_tags as $id)
         {
            $tag = \App\Tag::find($id);
            $post->tags()->save($tag);
         }
      }

      $request->session()->flash('alert.success', 'Post cadastrado com sucesso.');
      return redirect()->route('gestor.posts');
   }

   public function edit(Request $request, $post)
   {
      $this
         ->ui
         ->setMenuActive('gestor.posts')
         ->setTitle('Editar Artigo');

      $post = Post::find($post);

      $formulario = new Form;
      $formulario->setAction(route('gestor.posts.update', ['post' => $post]));
      $formulario->setMethod('PUT');
      $formulario->setActionBack(route('gestor.posts'));

      $post_title = new \App\Helper\Field\InputField('post_title', 'Título', $post->post_title);
      $post_title->setAttr('class', 'form-control');

      $formulario->setField($post_title);

      $post_content = new \App\Helper\Field\EditorField('post_content', 'Texto', $post->post_content);

      $formulario->setField($post_content);

      $options = array_map(function($tag) {
         return $tag['name'];
      }, \App\Tag::all()->keyBy('id')->toArray());

      $optionsSelected = array_map(function($tag) {
         return $tag['id'];
      }, $post->tags->toArray());

      $tags = new \App\Helper\Field\SelectField('post_tags', 'Tags', $options, $optionsSelected);
      $tags->setMultiple();
      $tags->setAttr('class', 'form-control', $post->tags());

      $formulario->setField($tags);




      $options = array_map(function($categoria) {
         return $categoria['name'];
      }, \App\Categoria::all()->keyBy('id')->toArray());

      $optionsSelected = $post->categorias_id;

      $categoria = new \App\Helper\Field\SelectField('categorias_id', 'Categoria', $options, $optionsSelected);
      $categoria->setAttr('class', 'form-control');

      $formulario->setField($categoria);




      return $this->viewForm($formulario);
   }

   public function update(Request $request, $post)
   {
      $validator = $this->validator($request);

      if ($validator->fails()) {
         return redirect(route('gestor.posts.edit', ['post' => $post]))
         ->withErrors($validator)
         ->withInput();
      }

      $post = Post::find($post);
      $post->post_title = $request->post_title;
      $post->post_content = $request->post_content;
      $post->user_updated = \Auth::user()->id;
      $post->categorias_id = null;
      if ( $request->categorias_id )
      {
         $post->categorias_id = $request->categorias_id;
      }
      
      $post->save();

      if ( $request->post_tags )
      {

         $post->tags()->detach();

         foreach($request->post_tags as $id)
         {
            $tag = \App\Tag::find($id);
            $post->tags()->save($tag);
         }
      }

      $request->session()->flash('alert.success', 'Post atualizado com sucesso.');
      return redirect()->route('gestor.posts');
   }

   public function destroy(Request $request, $post)
   {
      $post = Post::find($post);

      $post->tags()->detach();

      $post->delete();

      $request->session()->flash('alert.success', 'Post deletado com sucesso.');
      return redirect()->route('gestor.posts');
   }

   protected function validator($request)
   {
      return Validator::make($request->all(), [
         'post_title' => 'required|max:255',
         'post_content' => 'required',
      ]);
   }

}
