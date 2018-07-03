<div class="col-md-12">

 {!! Form::open(['route' => ['dish.store'], 'method' => 'POST', 'class' => 'form-horizontal row justify-content-center','files' => 'true']) !!}
 <div class="col-md-8">
  <div class="card">
   <div class="card-header">
    <h5 class="card-title">Crear del Usuario</h5>
   </div>
   <div class="card-body">
    <div class="row justify-content-center ">
     <div class="col-lg-5">
      <div class="form-group my-3">
       {!! Form::label('name','Nombre') !!} {!! Form::text('name',old('name'),array('class' => 'form-control')) !!}
       @if ($errors->has('name'))
       <span class="help-block">
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </span>
       @endif
      </div>

     </div>
     <div class="col-lg-5">
      <div class="form-group my-3">
       {!! Form::label('lastname','Apellido') !!} {!! Form::text('lastname' , old('lastname'),array('class' => 'form-control')) !!}
       @if ($errors->has('lastname'))
       <span class="help-block">
                <small class="text-danger">{{ $errors->first('lastname') }}</small>
            </span>
       @endif
      </div>
     </div>
    </div>

    <div class="row justify-content-center">
     <div class="col-sm-12 col-lg-10">
      <div class="form-group mt-5">
       <h5>Selecciona los roles del usuario</h5>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="available" id="available">
        <label class="custom-control-label" for="available">Disponible en inventario</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="deliverable" id="deliverable">
        <label class="custom-control-label" for="deliverable">Disponible para envio a domicilio</label>s
       </div>
      </div>
     </div>
    </div>
   </div>


  <div class="card-footer">
   <div class="row justify-content-center">
    <div class="col-md-">
     {!! Form::submit('Enviar',array('class' => 'btn btn-info btn-fill')) !!}
    </div>
   </div>
  </div>
 </div>
</div>
{!! Form::close() !!}
</div>
