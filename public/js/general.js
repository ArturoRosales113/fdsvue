function addCarritoAjax(){
  var form = $('#formConfigurador');
  var url = form.attr('action');
  var data = form.serialize();

  $.post(url, data,function (result){
    console.log(result['totalQty']);
    var mensajeMezcla ='Fue agregado correctamente al carrito' ;
    $('#cantidadKart').text(result['totalQty']);
    $.confirm({
      animation:'opacity',
      autoClose: 'cancelAction|3000',
      backgroundDismiss: true,
      buttons: {
        Tienda: {
          text:'<span>Seguir comprando</span>'
        },
        Carrito:{
          text:'<span>Ver Carrito</span>',
          action: function(){
            location.href = '{{ route('shoppingcart.getCarrito') }}'
          }
        }
      },
      closeAnimation:'opacity',
      content: mensajeMezcla,
      theme: 'supervan',
      title: 'Café '+ result['product']['mezcla'] + '<br><div class="section"   ><small class="section">Molido para  ' + result['product']['molido']+'</small></div>'
    });
  });
}
