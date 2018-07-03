<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Illuminate\Support\Facades\Input;
use Image;
use File;

use App\Store;

class StoreController extends Controller
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
        $stores = Store::all();
        return view('Backend.Store.index', ['stores' => $stores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Store.create');//
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
         'name' => 'required|unique:stores|max:255',
         'address' => 'required',
         'email' => 'required|email',
         'phone' => 'required|numeric',
         'store_pic' => 'required|image|max:150'
        ];
        $messages = [
            'name.required' => 'El campo "Nombre" es obligatorio',
            'address.required' => 'El campo "Dirección" es obligatorio',
            'store_pic.required' => 'Debes subir una foto',
            'phone.required' => 'El campo teléfono es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'phone.numeric' => 'El campo Teléfono no es un número',
            'email.email' => 'La dirección de correo no es válida',
            'store_pic.max' => 'La imagen no debe pesar más de 150KB'
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('store.create')
                   ->withErrors($validator)
                   ->withInput();
        } else {
            //dd($input);
            //  Crear Imagen
            $file = Input::file('store_pic');
            $name = str_replace(' ', '', strtolower($input['name']));
            $file_name = $name.'.'.$file->getClientOriginalExtension();
            $url ='stores/'.$file_name;
            $request->store_pic->move('stores/', $file_name);
            $store = Store::create([
             'name' => $name,
             'display_name' => $input['name'],
             'address' => $input['address'],
             'img_path' => $url,
             'phone' => $input['phone'],
             'email' => $input['email'],
             'lat' => $input['latitude'],
             'lng' => $input['longitude']
            ]);
          return redirect()->route('store.index');
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
        $store = Store::find($id);
        return view('Backend.Store.show',['store' => $store]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        return view('Backend.Store.edit',['store' => $store]);
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
     $rules = [
      'display_name' => 'required|max:255',
      'address' => 'required',
      'email' => 'required|email',
      'phone' => 'required|numeric',
      'store_pic' => 'image|max:150'
     ];
     $messages = [
         'display_name.required' => 'El campo "Nombre" es obligatorio',
         'address.required' => 'El campo "Dirección" es obligatorio',
         'phone.required' => 'El campo teléfono es obligatorio',
         'email.required' => 'El campo email es obligatorio',
         'phone.numeric' => 'El campo Teléfono no es un número',
         'email.email' => 'La dirección de correo no es válida',
         'store_pic.max' => 'La imagen no debe pesar más de 150KB'
     ];

     $validator = Validator::make($input, $rules, $messages);
     if ($validator->fails()) {
         return redirect()->route('store.edit',$id)
                ->withErrors($validator)
                ->withInput();
     } else {

         $store = Store::find($id);
         $name = str_replace(' ', '', strtolower($input['display_name']));
         $store->name = $name;
         $store->display_name = $input['display_name'];
         $store->address = $input['address'];
         $store->lat = $input['latitude'];
         $store->lng = $input['longitude'];
         $store->phone = $input['phone'];
         $store->email = $input['email'];

        if ($request->hasFile('store_pic')) {
         // Borrar imagen antigua
         $old_file= $store->img_path;
         $old_filename = public_path($old_file);
         File::delete($old_filename);
         // Crear nueva imagen
         $file = Input::file('store_pic');
         $file_name = $name.'.'.$file->getClientOriginalExtension();
         $url ='stores/'.$file_name;
         $request->store_pic->move('stores/', $file_name);
         $store->img_path = $url;
        }
        $store->save();
       return redirect()->route('store.index');
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
     $store = Store::find($id);
     if ($store->img_path != null) {
      $file = $store->img_path;
      $filename = public_path($file);
      File::delete($filename);
     }
     $store->delete();
     return redirect()->route('store.index');
    }
}
