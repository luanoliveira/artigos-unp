<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
   use  AuthenticatesUsers;

   protected $redirectTo = '/gestor';

   public function logout()
   {
      Auth::logout();
      return redirect(route('login'));
   }

}
