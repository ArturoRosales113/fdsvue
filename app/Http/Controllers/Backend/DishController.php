<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Illuminate\Support\Facades\Input;
use Image;
use File;

use App\Dish;
use App\Category;

class DishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();
        return view('Backend.Dish.index', ['dishes' => $dishes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Backend.Dish.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $input = $request->all();

        $rules = [
         'name' => 'required|unique:dishes|max:255',
         'description' => 'required',
         'price' => 'required|numeric',
         'dish_pic' => 'required|image|max:150'
        ];
        $messages = [
            'name.required' => 'El campo "Nombre" es obligatorio',
            'description.required' => 'El campo "Descripción" es obligatorio',
            'price.required' => 'El campo "Precio" es obligatorio',
            'price.numeric' => 'El campo "Precio" debe ser un  número',
            'dish_pic.required' => 'Debes subir una foto',
            'dish_pic.max' => 'La imagen no debe pesar más de 150KB'
        ];

       $validator = Validator::make($input, $rules, $messages);
       if ( $validator->fails() ) {
       return redirect()->route('dish.create')
                   ->withErrors( $validator )
                   ->withInput();
       } else {
        //  Crear Imagen
         $file = Input::file('dish_pic');
         $name = str_replace(' ', '', strtolower($input['name']));
         $file_name = $name.'.'.$file->getClientOriginalExtension();
         $url ='dishes/'.$file_name;
         $request->dish_pic->move('dishes/', $file_name);

         if (isset($input['available'])) {
          $av = 1;
         } else {
          $av = 0;
         }
         if (isset($input['deliverable'])) {
          $del = 1;
         } else {
          $del = 0;
         }
         //  Crear Platillo
         $dish = Dish::create([
          'name' => $input['name'],
          'description' => $input['description'],
          'category_id' => $input['category_id'],
          'price' => $input['price'],
          'available' => $av,
          'deliverable' => $del,
          'img_path' => $url
         ]);

         return redirect()->route('dish.index');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::find($id);
        return view('Backend.Dish.show', ['dish' => $dish]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = Dish::find($id);
        $categories = Category::all();
        return view('Backend.Dish.edit' , [
         'dish' => $dish,
         'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $input = $request->all();
       //dd($input);
       $rules = [
        'name' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'dish_pic' => 'max:150'
       ];
       $messages = [
           'name.required' => 'El campo "Nombre" es obligatorio',
           'description.required' => 'El campo "Descripción" es obligatorio',
           'price.required' => 'El campo "Precio" es obligatorio',
           'price.numeric' => 'El campo "Precio" debe ser un  número',
           'dish_pic.max' => 'La imagen no debe pesar más de 150KB'
       ];

      $validator = Validator::make($input, $rules, $messages);
      if ( $validator->fails() ) {
      return redirect()->route('dish.edit',$id)
                  ->withErrors( $validator )
                  ->withInput();
      } else {

       //dd($input);
       if (isset($input['available'])) {
        $av = 1;
       } else {
        $av = 0;
       }
       if (isset($input['deliverable'])) {
        $del = 1;
       } else {
        $del = 0;
       }
        $dish = Dish::find($id);
        $dish->name = $input['name'];
        $dish->description = $input['description'];
        $dish->category_id = $input['category_id'];
        $dish->price = $input['price'];
        $dish->available = $av;
        $dish->deliverable = $del;

        if ($request->hasFile('dish_pic')) {
         // Borrar imagen antigua
         $old_file= $dish->img_path;
         $old_filename = public_path($old_file);
         File::delete($old_filename);
         // Crear nueva imagen
         $file = Input::file('dish_pic');
         $name = str_replace(' ', '', strtolower($input['name']));
         $file_name = $name.'.'.$file->getClientOriginalExtension();
         $request->dish_pic->move('dishes/', $file_name);
         $url ='dishes/'.$file_name;
         $dish->img_path = $url;
        }
        $dish->save();
        return redirect()->route('dish.index');


       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);
        if ($dish->img_path != null) {
         $file = $dish->img_path;
         $filename = public_path($file);
         File::delete($filename);
        }
        $dish->delete();
        return redirect()->route('dish.index');
    }
}
