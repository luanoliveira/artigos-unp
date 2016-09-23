<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;

use Storage;

class UsersController extends GestorController
{
   public function index()
   {
      $this->ui->setTitle('Usuários');

      $this->ui
      ->setPageAction('Novo Usuário', route('gestor.users.create'), ['class' => 'btn btn-primary btn-lg']);

      $this->ui->setMenuActive('gestor.users');


      $table = new \App\Helper\Table('\App\User');

      $table->setColumn('avatar', 'Avatar', function($data) {
         return sprintf('<img src="%s" width="50px">', $data->avatar ? $data->avatar : \App\User::getAvatar(true));
      });

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
      $formulario->setEnctype('multipart/form-data');
      $formulario->setAction(route('gestor.users.store'));
      $formulario->setActionBack(route('gestor.users'));

      $name = new \App\Helper\Field\InputField('name', 'Nome');
      $name->setAttr('class', 'form-control');

      $formulario->setField($name);

      $email = new \App\Helper\Field\InputField('email', 'E-mail');
      $email->setAttr('class', 'form-control');

      $formulario->setField($email);

      $password = new \App\Helper\Field\PasswordField('password', 'Password');
      $password->setAttr('class', 'form-control');

      $formulario->setField($password);

      $password_confirmation = new \App\Helper\Field\PasswordField('password_confirmation', 'Confirme Password');
      $password_confirmation->setAttr('class', 'form-control');

      $formulario->setField($password_confirmation);

      $formulario->setField(new \App\Helper\Field\ImageField('avatar', 'Avatar'));

      return $this->viewForm($formulario);
   }

   public function store(Request $request)
   {
      $validator = $this->validator($request);

      if ($validator->fails()) {
         return redirect(route('gestor.users.create'))
            ->withErrors($validator)
            ->withInput();
      }

      $user = new \App\User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->avatar = $this->file($request->avatar);
      $user->save();

      $request->session()->flash('alert.success', 'Usuário cadastrado com sucesso.');
      return redirect()->route('gestor.users');
   }

   protected function file($file)
   {
      if ( $file )
      {
			$filename = strtolower(
					pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
					.'-'
					.uniqid()
					.'.'
					.$file->getClientOriginalExtension()
			);

			$path = Storage::putFileAs('public', $file, $filename);

         $image = new \Eventviva\ImageResize(storage_path('app/public').'/'.$filename);
         $image
            ->resizeToHeight(100)
            ->crop(100, 100)
            ->save(storage_path('app/public').'/'.$filename);

         return $filename;
      }
   }

   public function destroy(Request $request, $user)
   {
      $user = \App\User::find($user);

      $user->delete();

      $request->session()->flash('alert.success', 'Usuário deletado com sucesso.');
      return redirect()->route('gestor.users');
   }

   public function edit(Request $request, $user)
   {
      $this->ui->setTitle('Editar Usuário');

      $user = \App\User::find($user);

      $formulario = new \App\Helper\Form;
      $formulario->setEnctype('multipart/form-data');
      $formulario->setAction(route('gestor.users.update', ['user' => $user]));
      $formulario->setMethod('PUT');
      $formulario->setActionBack(route('gestor.users'));

      $name = new \App\Helper\Field\InputField('name', 'Nome', $user->name);
      $name->setAttr('class', 'form-control');

      $formulario->setField($name);

      $email = new \App\Helper\Field\InputField('emaildisabled', 'E-mail', $user->email);
      $email->setAttr('class', 'form-control');
      $email->setAttr('disabled');

      $formulario->setField($email);

      $avatar = new \App\Helper\Field\ImageField('avatar', 'Avatar');
      $avatar->setRow($user);

      $formulario->setField($avatar);

      /*if ( $user->avatar ) {
         //$remover = new \App\Helper\Field\CheckboxField('remover_avatar', 'Remover Avatar.');
         //$formulario->setField($remover);
         $user->avatar = config('app.url').Storage::url(sprintf('app/public/%s', $user->avatar));
      }*/

      return $this->viewForm($formulario);
   }

   public function update(Request $request, $user)
   {
      $validator = $this->validatorUpdate($request);

      if ($validator->fails()) {
         return redirect(route('gestor.users.edit', ['user' => $user]))
            ->withErrors($validator)
            ->withInput();
      }

      $user = \App\User::find($user);

      $user->name = $request->name;

      if ( $request->destroy_avatar && $user->avatar )
      {
         //Storage::delete(storage_path(sprintf('app/public/%s', $user->avatar)));
         $user->avatar = null;
      }

      if ( $request->avatar )
      {
         $user->avatar = $this->file($request->avatar);
      }

      $user->save();

      $request->session()->flash('alert.success', 'Usuário atualizado com sucesso.');
      return redirect()->route('gestor.users');
   }

   protected function validator($request)
   {
      return \Validator::make($request->all(), [
         'name' => 'required|min:3|max:32',
         'email' => 'required|email|unique:users',
         'password' => 'required|min:3|confirmed',
         'password_confirmation' => 'required|min:3'
      ]);
   }

   protected function validatorUpdate($request)
   {
      return \Validator::make($request->all(), [
         'name' => 'required|min:3|max:32',
         //'email' => 'required|email|unique:users',
         //'password' => 'required|min:3|confirmed',
         //'password_confirmation' => 'required|min:3'
      ]);
   }
}
