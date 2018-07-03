<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Dish;
use App\Category;

class FrontController extends Controller
{
    //Index
    public function index()
    {

     return view('Frontend.Index.index');
    }
    //Carta
    public function carta()
    {
     $categories = Category::all()->except(1);
     return view('Frontend.Carta.carta',[
      'categories' => $categories
     ]);
    }
    //reservaciones
    public function reservaciones()
    {
     return view('Frontend.Reservaciones.reservaciones');
    }
    //Contacto
    public function contacto()
    {
     return view('Frontend.Contacto.contacto');
    }
    //Pureba de email
    public function send_email()
    {
     Mail::to('arispero0990@gmail.com')->send(new NewUser());
      return redirect()->route('front.index');
    }
    public function show_category($id)
    {
     $category = Category::find($id);
     return view('Frontend.Carta.Category.category',[
      'category' => $category
     ]);
    }
    public function show_dish($id)
    {
     $dish = Dish::find($id);
     return view('Frontend.Carta.Platillo.platillo',[
      'dish' => $dish
     ]);
    }
}
