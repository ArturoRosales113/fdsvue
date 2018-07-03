<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
 protected $fillable = [
     'name', 'description','category_id', 'price', 'deliverable', 'available', 'img_path'
 ];

 public function category()
 {
  return $this->belongsTo('App\Category');
 }//
}
