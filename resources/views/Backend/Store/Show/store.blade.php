<div class="row">
 <div class="col-md-8">
  <div class="card">
   <div class="card-body">
    <div class="row justify-content-center">
     <div class="col-md-12">
      <div id="map"></div>
     </div>
    </div>
    <hr>
    <h5 class="text-center">Dirección</h5>
    <p class="text-center">
     {{ $store -> address }}
    </p>
    <hr>
   <div class="row justify-content-center">
    <div class="col-md-5 text-center">
     <h6>Teléfono</h6>
     <span>{{$store -> phone}}</span>
    </div>
    <div class="col-md-5 text-center">
     <h6>Email</h6>
     <span>{{$store -> email}}</span>
    </div>
   </div>
   </div>
   <div class="card-footer text-center">
    <a class="btn btn-info" href="{{route('store.edit',$store->id)}}">Editar &nbsp;<i class="fa fa-edit"></i></a>
   </div>
  </div>
 </div>
 <div class="col-md-4">
  <div class="card">
   <div class="card-body">
    <img src="{{ url($store -> img_path) }}" alt="">
   </div>
  </div>
 </div>
</div>
