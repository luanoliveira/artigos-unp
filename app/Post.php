<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $table = 'posts';

   //$related, $table = null, $foreignKey = null, $otherKey = null, $relation = null
   //return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
   public function tags()
   {
      return $this->belongsToMany('App\Tag', 'posts_has_tags', 'posts_id', 'tags_id');
   }

   public function user()
   {
      return $this->hasOne('App\User', 'id', 'user_created');
   }
}
