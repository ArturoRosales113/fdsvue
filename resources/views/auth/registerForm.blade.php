<!-- Nombre -->
 <div class="input-group">

     {!! Form::text('name',old('name'),array('class' => 'form-control', 'placeholder' => 'Nombre...')) !!}

 </div>
 <!-- Email -->
 <div class="input-group">

     {!! Form::email('email', old('email'), array('class' => 'form-control', 'placeholder' => 'E-mail')) !!}

 </div>
 <!-- Password -->
 <div class="input-group">

     {!! Form::password('password',array('class' => 'form-control','placeholder' => 'Contraseña')) !!}

 </div>
 <!-- Confirmación Password -->
 <div class="input-group">

     {!! Form::password('password_confirmation',array('class' => 'form-control','placeholder' => 'Confirma Password')) !!}

 </div>
 <!-- Añadir un checkbox -->
 {{-- <div class="form-check">
     <label class="form-check-label">
         <input class="form-check-input" type="checkbox">
         <span class="form-check-sign"></span>
         Estoy de acuerdo con
         <a href="#something">términos y condiciones</a>.
     </label>
 </div> --}}
 <div class="card-footer text-center">
     <button type="submit" class="btn btn-primary btn-round btn-lg">Registrar</button>
     <br>
     @if ($errors->has('email'))
         <span class="help-block">
             <strong>{{ $errors->first('email') }}</strong>
         </span>
         <br>
     @endif
     @if ($errors->has('name'))
         <span class="help-block">
             <strong>{{ $errors->first('name') }}</strong>
         </span>
         <br>
     @endif
     @if ($errors->has('password'))
         <span class="help-block">
             <strong>{{ $errors->first('password') }}</strong>
         </span>
         <br>
     @endif

 </div>
</form>
