<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $table = 'artigos';

   //$related, $table = null, $foreignKey = null, $otherKey = null, $relation = null
   //return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
   public function tags()
   {
      return $this->belongsToMany('App\Tag', 'artigos_has_tags', 'artigos_id', 'tags_id');
   }

   public function user()
   {
      return $this->hasOne('App\User', 'id', 'user_created');
   }

   public function categoria()
   {
      return $this->hasOne('App\Categoria', 'id', 'categorias_id');
   }

   /*
   public static function getImageAttribute($value)
   {
      if ( $value )
      {
         return asset('/storage/'.$value);
      }
   }
   */

}
