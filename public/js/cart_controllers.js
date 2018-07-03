function addToCart() {
 var url = $(this).attr('data-url');
 $.get(url, function(result) {
  $('#cantidadKart').text(result['totalQty']);
  swal({
   title: '<span class="font1">Producto Agregado!!</span>',
   type: 'success',
   confirmButtonText: '<i class="fa fa-shopping-bag"></i>&nbsp; Continuar comprando',
   confirmButtonAriaLabel: 'Thumbs up, great!',
  });
 });
}
function eraseFromCart() {
 var url = $(this).attr('data-url');
 $.get(url, function(result) {
  if (result['status'] == 'cart_empty') {
   location.reload();
  }else{
   var current_totalPrice = $('#total_cart_price');
   var current_totalQty = $('#total_cart_qty');
   var prod_modif_id = result['product_id'];
   var new_totalPrice = result['totalPrice'];
   var new_totalQty = result['totalQty'];

   $('#cantidadKart').text(new_totalQty);
   var item_row = $('#line_product_' + prod_modif_id);
   TweenMax.to(item_row, 3, {autoAlpha: 0,y: -300});
   item_row.addClass('d-none');
   current_totalPrice.text(new_totalPrice);
   current_totalQty.text(new_totalQty);
   $('#cantidadKart').text(new_totalQty);
   TweenMax.from(current_totalPrice, 1, {autoAlpha: 0,y: -300});
   TweenMax.from(current_totalQty, 1, {autoAlpha: 0,y: -300});

  }
 });
}
function cartAddOne() {
 var item_data_url = $(this).attr('data-url');

 $.get(item_data_url, function(result) {
   var current_totalPrice = $('#total_cart_price');
   var current_totalQty = $('#total_cart_qty');
   var prod_modif_id = result['product_id'];
   var new_totalPrice = result['totalPrice'];
   var new_totalQty = result['totalQty'];
   var prod_current_qty = $('#item_qty_' + prod_modif_id);
   var prod_current_price = $('#item_price_' + prod_modif_id);
   var prod_modif_qty = result['items'][prod_modif_id]['qty'];
   var prod_modif_price = result['items'][prod_modif_id]['price'];

   prod_current_qty.text(prod_modif_qty);
   prod_current_price.text(prod_modif_price);
   current_totalPrice.text(new_totalPrice);
   current_totalQty.text(new_totalQty);
   $('#cantidadKart').text(new_totalQty);
   TweenMax.from(current_totalPrice, 1, {autoAlpha: 0, y: -300});
   TweenMax.from(current_totalQty, 1, {autoAlpha: 0, y: -300});
   TweenMax.from(prod_current_qty, 1, {autoAlpha: 0, y: -300});
   TweenMax.from(prod_current_price, 1, {autoAlpha: 0, y: -300});
   $('#reduce_one_' + prod_modif_id).attr('data-qty', prod_modif_qty);
 });
}
function cartReduceOne() {
 var item_data_url = $(this).attr('data-url');
 var item_data_qty = $(this).attr('data-qty');

 $.get(item_data_url, function(result) {
 if (result['status'] == 'cart_empty') {
  location.reload();
 }else{
  var current_totalPrice = $('#total_cart_price');
  var current_totalQty = $('#total_cart_qty');
  var prod_modif_id = result['product_id'];
  var new_totalPrice = result['totalPrice'];
  var new_totalQty = result['totalQty'];

  if (item_data_qty == 1) {
   var item_row = $('#line_product_' + prod_modif_id);
   TweenMax.to(item_row, 1, {autoAlpha: 0, y: -300});
   item_row.addClass('d-none');
   current_totalPrice.text(new_totalPrice);
   current_totalQty.text(new_totalQty);
   $('#cantidadKart').text(new_totalQty);
   TweenMax.from(current_totalPrice, 1, {autoAlpha: 0, y: -300});
   TweenMax.from(current_totalQty, 1, {autoAlpha: 0, y: -300 });

  } else {
   var prod_current_qty = $('#item_qty_' + prod_modif_id);
   var prod_current_price = $('#item_price_' + prod_modif_id);
   var prod_modif_qty = result['items'][prod_modif_id]['qty'];
   var prod_modif_price = result['items'][prod_modif_id]['price'];

   prod_current_qty.text(prod_modif_qty);
   prod_current_price.text(prod_modif_price);
   current_totalPrice.text(new_totalPrice);
   current_totalQty.text(new_totalQty);
   $('#cantidadKart').text(new_totalQty);
   TweenMax.from(current_totalPrice, 1, {autoAlpha: 0, y: -300});
   TweenMax.from(current_totalQty, 1, {autoAlpha: 0, y: -300 });
   TweenMax.from(prod_current_qty, 1, {autoAlpha: 0, y: -300 });
   TweenMax.from(prod_current_price, 1, {autoAlpha: 0, y: -300});
   $('#reduce_one_' + prod_modif_id).attr('data-qty', prod_modif_qty);
  }
 }

 });
}


$(document).ready(function() {
 $('.addToCart').click(function(e) {
  addToCart.bind(this)(e);
 });
 $('.addOne').click(function(e) {
  cartAddOne.bind(this)(e);
 });
 $('.reduceOne').click(function(e) {
  cartReduceOne.bind(this)(e);
 });
 $('.eraseOne').click(function(e) {
  eraseFromCart.bind(this)(e);
 });
});
