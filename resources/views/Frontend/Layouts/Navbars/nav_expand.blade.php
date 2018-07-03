<nav class="navbar navbar-expand-sm sticky-top" id="g_navbar">
<div class="w-100 d-flex justify-content-center">
<div class="col-12 p-0">
	<ul class="nav nav-pills d-flex align-items-center justify-content-center justify-content-lg-end font1">
			<li class="nav-item text-center">
					<a class="nav-link d-flex flex-column justify-content-center text-center" href="{{route('front.index')}}"><img src="" class="menu-icon" alt="...">
					<span class="d-none d-sm-flex">HOME</span>
				</a>

			</li>
			<li class="nav-item ">
					<a class="nav-link d-flex flex-column justify-content-center text-center" href="{{route('front.carta')}}">
						<span><i class="fa fa-utensils"></i></span>
						<span class="d-none d-sm-flex">CARTA</span>

					</a>
			</li>
			<li class="nav-item">
					<a class="nav-link d-flex flex-column justify-content-center text-center" href="{{route('front.reservaciones')}}">
						<span><i class="fa fa-map-marker-alt"></i></span>
						<span class="d-none d-sm-flex">SUCURSALES</span>

					</a>
			</li>
			<li class="nav-item">
					<a class="nav-link d-flex flex-column justify-content-center text-center" href="{{route('front.contacto')}}">
						<span><i class="fa fa-book"></i></span>
						<span class="d-none d-sm-flex">CONTACTO</span>

					</a>
			</li>
			<li class="nav-item">
					<a class="nav-link d-flex flex-column justify-content-center text-center" href="{{route('shoppingcart.shoppingcart')}}">
						<span><i class="fa fa-shopping-basket"></i>&nbsp;<small id='cantidadKart' class="badge badge-pill bg-2 text-white">{{ Session::has('cart') ? Session::get('cart') -> totalQty:'0'}} </small></span>
						<span class="d-none d-sm-flex align-items-center">CANASTA </span>
					</a>
			</li>
	</ul>
</div>
</div>
</nav>
