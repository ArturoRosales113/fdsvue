<div class="col-md-12">

   {!! Form::open(['route' => ['category.store'], 'method' => 'POST', 'class' => 'form-horizontal row justify-content-center']) !!}
   <div class="col-md-6">
    <div class="card">
    <div class="card-header">
     <h5 class="card-title text-center">Detalles de la categoría</h5>
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
     </div>

     <div class="card-footer">
      <div class="row justify-content-center">
       <div class="col-md-">
         {!! Form::submit('Crear',array('class' => 'btn btn-primary btn-fill')) !!}
       </div>
      </div>
     </div>
    </div>
   </div>

   {!! Form::close() !!}
</div>
