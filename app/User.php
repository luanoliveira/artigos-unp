<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Storage;

class User extends Authenticatable
{
   use Notifiable;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
      'name', 'email', 'password',
   ];

   /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
   protected $hidden = [
      'password', 'remember_token',
   ];

   /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
   public function getAvatarAttribute($value)
   {
      if ( $value )
      {
         return asset('/storage/'.$value);
      }
   }

   static function getAvatar($default=false, $asset='images/perfil.gif')
   {
      //$user = self::find(\Auth::user()->id);
      if ( \Auth::user()->avatar && !$default )
      {
         return \Auth::user()->avatar;
      }

      return asset($asset);
   }
}
