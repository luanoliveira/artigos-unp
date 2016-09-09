<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helper\Ui;

class GestorController extends Controller
{
    protected $ui;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->ui = new Ui;

        $this
            ->ui
            ->addMenu('gestor.dashboard', 'Dashboard', route('gestor.dashboard'))
            ->addMenu('gestor.posts', 'Posts', route('gestor.posts'))
            ->addMenu('gestor.tags', 'Tags', route('gestor.tags'))
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
      $this->ui->setMenuActive('gestor.dashboard');
      return $this->view('gestor.dashboard');
   }
}
