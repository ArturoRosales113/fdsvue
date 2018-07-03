<div class="row d-flex justify-content-center">
 <div class="col-12 p-0">
  <!-- Links de las tabs -->
  <ul class="nav nav-pills justify-content-center bg-2 py-0 py-sm-2" id="pills-tab" role="tablist">
   @foreach ($categories as $cat)
   <li class="nav-item d-none d-md-flex">
    <a class="nav-link text-white font2 one__em @if ($loop -> first) active @endif" id="home-tab" data-toggle="tab" href="#tab-{{ $cat -> name }}" role="tab" aria-controls="home" aria-selected="true">{{ $cat->display_name }}</a>
   </li>
   @endforeach
   <li class="nav-item dropdown d-md-none flex-fill">
    <a class="nav-link btn btn-lg bg-2 text-white dropdown-toggle font2" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">CATEGORÍAS</a>
    <div class="dropdown-menu">
     @foreach ($categories as $cat)
     <a class="dropdown-item font2 one__half__em" id="pills-{{ $cat -> name }}-tab" data-toggle="pill" href="#tab-{{ $cat -> name }}" role="tab" aria-controls="pills-home" aria-selected="true"> {{ $cat -> display_name }} </a> @endforeach
    </div>
   </li>
  </ul>
 </div>

 <div class="col-12 p-0">
  <!-- Contenido de las tabs -->
  <div class="tab-content" id="pills-tabContent">
   @foreach ($categories as $cat)
   <div class="tab-pane fade show @if ($loop -> first) active @endif" id="tab-{{ $cat -> name }}" role="tabpanel" aria-labelledby="pills-{{ $cat -> name }}-tab">
     <!-- Carousel de platillos -->
     <div id="carousel_{{ $cat -> name }}" class="carousel carousel_carta slide row carousel-fade" data-ride="carousel" data-keyboard="true" data-interval"false">
      <!-- navegador de platillos -->
      <div class="col-12 col-lg-2">
       <div class="carta_markers_container d-flex flex-row flex-lg-column">
        @foreach ($cat->dishes as $cat_di)
        <a href="#!" data-target="#carousel_{{ $cat -> name }}" data-slide-to="{{$loop->index}}" class="d-flex align-items-center justify-content-center p-5 font1 carta_markers @if ($loop -> first) active @else mt-lg-1  @endif" style="background-image:url('{{ Voyager::image($cat_di->thumbnail('small','img_path')) }}');">
         <span>{{ $cat_di -> name }} </span>
        </a>
        @endforeach
       </div>
      </div>
      <div class="col-12 col-lg-10">
       <div class="carousel-inner">
        @foreach ($cat->dishes as $cat_di)
        <div class="carousel-item @if ($loop -> first) active @endif">
         <div class="row d-flex align-items-end align-items-lg-center justify-content-center">

          <div class="col-10 col-lg-8 texto_carta mb-5 mb-sm-0">
           <div class="row d-flex h-100 justify-content-center align-items-center">
           <div class="col-11">
            <div class="row d-flex  justify-content-between align-items-center pt-5">
             <div class="col text-center">
              <a class="c-1" href="#carousel_{{ $cat -> name }}" role="button" data-slide="prev"><i class="fa fa-chevron-circle-left"></i>
               </a>
               </div>
             <div class="col-8 text-center">
              <h2 class="font1 two__em">{{ $cat_di -> name }}</h2>
             </div>
             <div class="col text-center">
              <a class="c-1" href="#carousel_{{ $cat -> name }}" role="button" data-slide="next"><i class="fa fa-chevron-circle-right"></i></a>
             </div>
            </div>
            <div class="row d-flex justify-content-center">
             <div class="col-10">
              <p class="text-center" style="min-height:130px;">{{ $cat_di -> description  }}</p>
             </div>
            </div>
            <div class="row d-flex align-items-center pb-5">
             <div class="col">
              <h4 class="font2">${{ $cat_di -> price }}.00</h4>
             </div>
             <div class="col text-right">
              <a href="#!" data-url="{{ route('shoppingcart.addToCart',$cat_di->id) }}" class="btn text-body addToCart"><i class="fa fa-plus"></i>&nbsp;Comprar</a>
             </div>
            </div>
           </div>
           </div>
          </div>
          <div class="col-12 col-lg-4 imagen_carta"  style=" background-image:url('{{Voyager::image($cat_di->img_path)}}');">
          </div>
         </div>
          </div>
        @endforeach
       </div>
      </div>
     </div>
   </div>
   @endforeach
  </div>

 </div>
</div>
