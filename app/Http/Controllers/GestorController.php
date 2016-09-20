<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helper\Ui;

class GestorController extends Controller
{
   protected $ui;

   protected $request;

   protected $busca;

   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct(Request $request)
   {
      $this->middleware('auth');

      $this->request = $request;

      $this->ui = new Ui;

      $this
         ->ui
         ->setBuscaAction(route('gestor.posts'));

      $this
         ->ui
         ->addMenu('gestor.dashboard', 'Dashboard', route('gestor.dashboard'))
         ->addMenu('gestor.posts', 'Artigos', route('gestor.posts'))
         ->addMenu('gestor.tags', 'Tags', route('gestor.tags'))
         ->addMenu('gestor.categorias', 'Categorias', route('gestor.categorias'))
         ->addMenu('gestor.users', 'Usuários', route('gestor.users'));
   }

   public function view($view, array $data=[])
   {
      $dataContent['Ui'] = $this->ui;
      $dataContent['view'] = $view;
      $dataContent['data'] = $data;
      return view('gestor.content', $dataContent);
   }

   public function viewForm(\App\Helper\Form $formulario)
   {
      $dataContent['Ui'] = $this->ui;
      $dataContent['view'] = 'gestor.form';;
      $dataContent['form'] = $formulario;
      $dataContent['data'] = [];
      return view('gestor.content', $dataContent);
   }

   public function viewTable(\App\Helper\Table $table)
   {
      $dataContent['Ui'] = $this->ui;
      $dataContent['view'] = 'gestor.table';
      $dataContent['table'] = $table;
      $dataContent['data'] = [];
      return view('gestor.content', $dataContent);
   }

   public function dashboard()
   {
      $data['posts'] = \App\Post::orderBy('created_at', 'desc')->take(5)->get();
      $this->ui->setMenuActive('gestor.dashboard');
      return $this->view('gestor.dashboard', $data);
   }

   public function setBusca($name, $like)
   {
      if ( $this->request->input('s') )
      {
         $this->busca[$name] = str_replace('{field}', $this->request->input('s'), $like);
      }
   }

   public function getBusca()
   {
      return $this->busca;
   }

   public function isBusca()
   {
      return is_array($this->busca);
   }
}
