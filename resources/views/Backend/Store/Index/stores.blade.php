@foreach ($stores as $st)
<div class="col-md-6">
 <div class="card">
  <div class="card-header">
   <h4 class="card-title">{{ $st -> display_name }}</h4>
  </div>
  <div class="card-body">
   <div class="image">
    <img src="{{ url($st->img_path) }}" alt="">
   </div>
   <hr>
   <p>
    <i class="fa fa-map-marker-alt"></i>&nbsp; {{ $st -> address }}
   </p>
   <div class="row justify-content-start">
    <div class="col-md-5 text-left">
     <h6>Teléfono</h6>
     <span>{{$st -> phone}}</span>
    </div>
    <div class="col-md-5 text-left">
     <h6>Email</h6>
     <span>{{$st -> email}}</span>
    </div>
   </div>
  </div>
  <div class="card-footer d-flex justify-content-around">
   <a href="{{ route('store.show',$st->id) }}" class="btn btn-info"><i class="fa fa-edit"></i>&nbsp; Ver</a>
   <a href="{{ route('store.edit',$st->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i>&nbsp; Editar</a>
   {{ Form::open(array('route' => ['store.destroy', $st->id], 'class' => 'm-0 pull-right hidden')) }}
       {{ Form::hidden('_method', 'DELETE') }}
       {{ Form::button(' <i class="fa fa-times"></i>&nbsp;Eliminar', array('type' => 'submit','class' => 'btn btn btn-danger','rel' => 'tooltip','data-original-title' => 'Eliminar', 'title' => 'Eliminar')) }}
   {{ Form::close() }}
  </div>
 </div>
</div>
@endforeach
