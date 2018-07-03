<div class="col-md-12">

   {!! Form::open(['route' => ['dish.store'], 'method' => 'POST', 'class' => 'form-horizontal row justify-content-center','files' => 'true']) !!}
   <div class="col-md-6">
    <div class="card">
    <div class="card-header">
     <h5 class="card-title">Crear del Platillo</h5>
    </div>
    <div class="card-body">
     <div class="row justify-content-center ">
      <div class="col-lg-10">
       <div class="form-group my-3">
        {!! Form::label('name','Nombre') !!}
        {!! Form::text('name',old('name'),array('class' => 'form-control')) !!}
        @if ($errors->has('name'))
            <span class="help-block">
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </span>
        @endif
       </div>
       <div class="form-group my-3">
        {!! Form::label('description','Descripción') !!}
        {!! Form::textarea('description' , old('description'),array('class' => 'form-control')) !!}
        @if ($errors->has('description'))
            <span class="help-block">
                <small class="text-danger">{{ $errors->first('description') }}</small>
            </span>
        @endif
       </div>
      </div>
      </div>

      <div class="row justify-content-center">
       <div class="col-sm-10">
        <div class="btn-group bootstrap-select form-group my-3">
         <label for="">Selecciona una categoría</label>
         <select class="selectpicker" name="category_id" data-size="7" data-style="btn btn-info" title="Single Select" tabindex="-98">
           <option class="bs-title-option" selected="" value="Default">Categorías</option>
           @foreach ($categories as $cat)
            <option value="{{ $cat -> id }}">{{ $cat -> name}}</option>
           @endforeach
         </select>
        </div>
       </div>
      </div>

      <div class="row justify-content-center">
       <div class="col-sm-12 col-lg-5">
        <div class="form-group my-3">
         {!!Form::label('price','Precio')!!}
         {!! Form::text('price',old('price'),array('class' => 'form-control', 'placeholder' => '$00.00')) !!}
         @if ($errors->has('price'))
             <span class="help-block">
                 <small class="text-danger">{{ $errors->first('price') }}</small>
             </span>
         @endif
        </div>
       </div>
       <div class="col-sm-12 col-lg-5">
        <div class="form-group mt-5">
         <div class="custom-control custom-checkbox">
           <input type="checkbox" class="custom-control-input" name="available" id="available">
           <label class="custom-control-label" for="available">Disponible en inventario</label>
         </div>
         <div class="custom-control custom-checkbox">
           <input type="checkbox" class="custom-control-input" name="deliverable" id="deliverable">
           <label class="custom-control-label" for="deliverable">Disponible para envio a domicilio</label>
         </div>
        </div>
       </div>
      </div>
     </div>

     <div class="card-footer">
      <div class="row justify-content-center">
       <div class="col-md-">
         {!! Form::submit('Enviar',array('class' => 'btn btn-primary btn-fill')) !!}
       </div>
      </div>
     </div>
    </div>
     </div>
     <div class="col-md-4">
      <div class="card">
       <div class="card-header">
        <h5 class="card-title">Foto del Platillo</h5>
       </div>
       <div class="card-body">
        <div class="row justify-content-center">
         <div class="col-md-6" id="dish_photos_container">
          <div class="fileinput fileinput-new text-center" data-provides="fileinput">
           {!! Form::file('dish_pic') !!}
           @if ($errors->has('dish_pic'))
               <span class="help-block">
                   <small class="text-danger">{{ $errors->first('dish_pic') }}</small>
               </span>
           @endif
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
   {!! Form::close() !!}
</div>
