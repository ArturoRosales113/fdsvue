<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 protected $fillable = [
     'name', 'display_name', 'description',
 ];
 public function dishes()
 {
  return $this->hasMany('App\Dish');
 }
}
