<div class="col-md-12">

   {!! Form::model($store, ['route' => ['store.update', $store->id], 'method' => 'PUT','files' => 'true', 'class' => 'row justify-content-center']) !!}
   {!! Form::hidden('latitude',old('latitude'),array('class' => 'form-control' ,'id' => 'latitude')) !!}
   {!! Form::hidden('longitude',old('longitude'),array('class' => 'form-control' ,'id' => 'longitude')) !!}
   <div class="col-md-5">
      <div class="card">
       <div class="card-header"><h5 class="card-title">1) Ubica la Sucursal en el mapa</h5>
       </div>
       <div class="card-body">
        <div id="map"></div>
       </div>
       </div>
      </div>

   <div class="col-md-6">
      <div class="card">
      <div class="card-header">
       <h5 class="card-title">2) Completa la información</h5>
      </div>
      <div class="card-body">
       <div class="row justify-content-center ">
        <div class="col-lg-10">
         <div class="form-group my-3">
          {!! Form::label('display_name','Nombre') !!}
          {!! Form::text('display_name',old('display_name'),array('class' => 'form-control')) !!}
          @if ($errors->has('display_name'))
              <span class="help-block">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
              </span>
          @endif
         </div>
         <div class="form-group my-3">
          {!! Form::label('address','Dirección') !!}
          {!! Form::textarea('address' , old('address'),array('class' => 'form-control')) !!}
          @if ($errors->has('address'))
              <span class="help-block">
                  <small class="text-danger">{{ $errors->first('address') }}</small>
              </span>
          @endif
         </div>
        </div>
        </div>

        <div class="row justify-content-center">
         <div class="col-sm-12 col-lg-5">
          <div class="form-group my-3">
           {!!Form::label('phone','Teléfono')!!}
           {!! Form::text('phone',old('phone'),array('class' => 'form-control')) !!}
           @if ($errors->has('phone'))
               <span class="help-block">
                   <small class="text-danger">{{ $errors->first('phone') }}</small>
               </span>
           @endif

          </div>
         </div>
         <div class="col-sm-12 col-lg-5">
          <div class="form-group my-3">
           {!!Form::label('email','E-mail')!!}
           {!! Form::text('email',old('email'),array('class' => 'form-control')) !!}
           @if ($errors->has('email'))
               <span class="help-block">
                   <small class="text-danger">{{ $errors->first('email') }}</small>
               </span>
           @endif
          </div>
         </div>
       </div>
       <hr>
       <div class="row justify-content-center">
        <div class="col-md-8">
         <div class="image">
          <img src="{{ url($store->img_path) }}" alt="">
         </div>
         <br>
         {!! Form::file('store_pic') !!}
         @if ($errors->has('store_pic'))
             <span class="help-block">
                 <small class="text-danger">{{ $errors->first('dish_pic') }}</small>
             </span>
         @endif
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
   {!! Form::close() !!}
</div>
