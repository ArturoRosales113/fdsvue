<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
 protected $fillable = [
     'name','display_name','address','email','phone','img_path','lat','lng'
 ];

 public function orders()
 {
  return $this->hasMany('App\Order');
 }

}
