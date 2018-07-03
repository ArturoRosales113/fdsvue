@extends('Frontend.Layouts.app')

@section('content')
<div class="row d-flex justify-content-center align-items-center one__vh" style="background-image:url('https://img.jakpost.net/c/2017/02/28/2017_02_28_22453_1488267265._large.jpg');">
    <div class="col-10 col-sm-6 col-lg-4">
     <div class="card rounded bg-1">
      <div class="card-body">
       <div class="row d-flex align-items-center justify-content-around">

        <div class="col-12 col-md-12">
         <form class="form-horizontal" method="POST" action="{{ route('login') }}">
             {{ csrf_field() }}

             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                 <label for="email" class="col-md-12 text-center text-md-left control-label font1 one__half__em text-white">Dirección de Correo</label>

                 <div class="col-md-12">
                     <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                     @if ($errors->has('email'))
                         <span class="help-block">
                             <strong>{{ $errors->first('email') }}</strong>
                         </span>
                     @endif
                 </div>
             </div>

             <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                 <label for="password" class="col-md-12 control-label text-center text-md-left font1 one__half__em text-white">Contraseña</label>

                 <div class="col-12">
                     <input id="password" type="password" class="form-control" name="password" required>

                     @if ($errors->has('password'))
                         <span class="help-block">
                             <strong>{{ $errors->first('password') }}</strong>
                         </span>
                     @endif
                 </div>
             </div>

             <div class="form-group">
                 <div class="col-12 text-center">
                     <div class="checkbox">
                         <label class="text-white">
                             <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar Datos
                         </label>
                     </div>
                 </div>
             </div>

             <div class="form-group">
                 <div class="col-md-12 text-center">
                     <button type="submit" class="btn btn-lg bg-2 text-white font1">
                         Iniciar Sesión
                     </button>
                 </div>
                 <div class="col-12 text-center">
                  <a class="btn btn-link font2 text-white" href="{{ route('password.request') }}">
                     Olvidé mi contraseña
                  </a>
                 </div>
             </div>
         </form>
        </div>

       </div>
      </div>
     </div>
    </div>
</div>

@endsection
