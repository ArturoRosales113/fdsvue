<div class="row">
 <div class="col-md-8">
  <div class="card">
   <div class="card-body">
    <h5>Descripcion</h5>
    <p class="descrition">
     {{ $dish -> description }}
    </p>
    <hr>
    <h6>Precio</h6>
    <span>{{$dish -> price}}</span>
   </div>
   <div class="card-footer text-center">
    <a class="btn btn-info" href="{{route('dish.edit',$dish->id)}}">Editar &nbsp;<fa class="fa fa-edit"></fa></a>
   </div>
  </div>
 </div>
 <div class="col-md-4">
  <div class="card">
   <div class="card-body">
    <img src="{{ url($dish -> img_path) }}" alt="">
   </div>
  </div>
 </div>
</div>
