<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Input;
use Image;

use App\Category;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('Backend.Category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Category.create');
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
          'description' => 'required'
         ];
        $messages = [
          'name.required' => 'El campo "Nombre" es obligatorio',
          'description.required' => 'El campo "Descripción" es obligatorio'
      ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('category.create')
                 ->withErrors($validator)
                 ->withInput();
        } else {
            $name = str_replace(' ', '', strtolower($input['name']));
            $category = Category::create([
          'name' => $name,
          'display_name' => $input['name'],
          'description' => $input['description']
         ]);
            return redirect()->route('category.index');
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
        $category = Category::find($id);
        return view('Backend.Category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('Backend.Category.edit', ['category' => $category]);
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
          'name' => 'required|unique:dishes|max:255',
          'description' => 'required'
         ];
        $messages = [
          'name.required' => 'El campo "Nombre" es obligatorio',
          'description.required' => 'El campo "Descripción" es obligatorio'
      ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('category.edit',$id)
                 ->withErrors($validator)
                 ->withInput();
        } else {
         $category = Category::find($id);
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
        $category = Category::find($id);
        $category->destroy();
    }
}
