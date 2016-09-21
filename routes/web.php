<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

//Route::get('/login', 'Controller@login');
//Route::post('/login', 'Controller@checkLogin');

//Route::get('/home', 'HomeController@index');

Route::get('/gestor', 'GestorController@dashboard')->name('gestor.dashboard');

Route::get('/gestor/posts', 'PostsController@index')->name('gestor.posts');
Route::post('/gestor/posts', 'PostsController@store')->name('gestor.posts.store');
Route::get('/gestor/posts/create', 'PostsController@create')->name('gestor.posts.create');
Route::get('/gestor/posts/{post}/edit', 'PostsController@edit')->name('gestor.posts.edit');
Route::put('/gestor/posts/{post}', 'PostsController@update')->name('gestor.posts.update');
Route::get('/gestor/posts/{post}/destroy', 'PostsController@destroy')->name('gestor.posts.destroy');

Route::get('/v1/post/{id}', function($id) {
    return App\Post::select("*")->with('tags')->with('categoria')->find($id);
});

Route::get('/v1/posts/{s?}', function ($s=null) {
   $data = [];

   $model = App\Post::select('*')->with('tags');

   if ( $s )
   {
      $model->where('post_title', 'LIKE', '%'.$s.'%');
      $data['s'] = $s;
   }

   $data = array_merge($data, $model->paginate(15)->toArray());

   return $data;
})->name('v1.posts');

Route::get('/v1/categorias/{categorias_id}/posts/{s?}/', function ($categorias_id, $s=null) {
   $data = [];

   $model = App\Post::select('*')->with('tags')->with('categoria');

   $model->where('categorias_id', $categorias_id);

   if ( $s )
   {
      $model->where('post_title', 'LIKE', '%'.$s.'%');
      $data['s'] = $s;
   }

   $data = array_merge($data, $model->paginate(15)->toArray());

   return $data;
})->name('v1.categorias.posts');

Route::get('/gestor/tags', 'TagsController@index')->name('gestor.tags');
Route::post('/gestor/tags', 'TagsController@store')->name('gestor.tags.store');
Route::get('/gestor/tags/create', 'TagsController@create')->name('gestor.tags.create');
Route::get('/gestor/tags/{tag}/edit', 'TagsController@edit')->name('gestor.tags.edit');
Route::put('/gestor/tags/{tag}', 'TagsController@update')->name('gestor.tags.update');
Route::get('/gestor/tags/{tag}/destroy', 'TagsController@destroy')->name('gestor.tags.destroy');

Route::get('/gestor/categorias', 'CategoriasController@index')->name('gestor.categorias');
Route::post('/gestor/categorias', 'CategoriasController@store')->name('gestor.categorias.store');
Route::get('/gestor/categorias/create', 'CategoriasController@create')->name('gestor.categorias.create');
Route::get('/gestor/categorias/{categoria}/edit', 'CategoriasController@edit')->name('gestor.categorias.edit');
Route::put('/gestor/categorias/{categoria}', 'CategoriasController@update')->name('gestor.categorias.update');
Route::get('/gestor/categorias/{categoria}/destroy', 'CategoriasController@destroy')->name('gestor.categorias.destroy');

Route::get('/v1/categorias', function() {
    return App\Categoria::paginate(15);
})->name('v1.categorias');

Route::get('/v1/tags/{s?}', function ($s=null) {
   $data = [];

   $model = App\Tag::select('*');

   if ( $s )
   {
      $model->where('name', 'LIKE', '%'.$s.'%');
      $data['s'] = $s;
   }

   $data = array_merge($data, $model->paginate(15)->toArray());

   return $data;
})->name('v1.tags');

Route::get('/gestor/users', 'UsersController@index')->name('gestor.users');
Route::post('/gestor/users', 'UsersController@store')->name('gestor.users.store');
Route::get('/gestor/users/create', 'UsersController@create')->name('gestor.users.create');
Route::get('/gestor/users/{tag}/edit', 'UsersController@edit')->name('gestor.users.edit');
Route::put('/gestor/users/{tag}', 'UsersController@update')->name('gestor.users.update');
Route::get('/gestor/users/{tag}/destroy', 'UsersController@destroy')->name('gestor.users.destroy');
