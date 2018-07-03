<?php
Route::namespace('Frontend')->group(function () {
    // Controllers Within The "App\Http\Controllers\Frontend" Namespace
    Route::get('/', 'FrontController@index')->name('front.index');
    // Blog
    Route::get('/carta', 'FrontController@carta')->name('front.carta');
    //Reservaciones
    Route::get('/reservaciones', 'FrontController@reservaciones')->name('front.reservaciones');
    //Contacto
    Route::get('/contacto', 'FrontController@contacto')->name('front.contacto');
    //Mail de prueba
    //Route::get('/send_test_email','IndexController@send_email')->name('front.send_email');
    //Platillo Individual
    Route::get('platillo/{id}', 'FrontController@show_dish')->name('front.show_dish');
    //  Añadir a carrito
    Route::get('add-to-cart/{id}', ['uses' => 'CartController@getAddToCart','as' => 'shoppingcart.addToCart']);
    //  Quitar 1 unidad de carrito
    Route::get('reduce-from-cart/{id}', ['uses' => 'CartController@getReduceByOne','as' => 'shoppingcart.reduceFromCart']);
    //  Quitar producto de carrito
    Route::get('remove-from-cart/{id}', ['uses' => 'CartController@getRemoveItem','as' => 'shoppingcart.removeFromCart']);
    // Checkout
    Route::get('checkout', ['uses' => 'CartController@getCheckOut','as' => 'shoppingcart.checkout']);
    //  Ir a carrito
    Route::get('shopping-cart', ['uses' => 'CartController@getCart','as' => 'shoppingcart.shoppingcart']);
    //  Crear orden del carrito
    Route::post('create-order', ['uses' => 'CartController@createOrder','as' => 'shoppingcart.createorder']);
    //  Destruir carrito
    Route::get('deletecart', ['uses' => 'CartController@EmptyCart','as' => 'shoppingcart.deleteCart']);
    // Devolver todas las sucursales
    Route::get('get_stores_location', ['uses' => 'CartController@getStores','as' => 'shoppingcart.getStores']);

});

Route::namespace('Backend')->group(function () {
    Route::prefix('admin')->group(function () {
        //  Home del Dashboard
        Route::get('/',['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);
        //  Resources
        Route::resources([
            'category' => 'CategoryController',
            'dish' => 'DishController',
            'ingredient' => 'IngredientController',
            'order_status' => 'OrderStatusController',
            'order' => 'OrderController',
            'permission' => 'PermissionController',
            'role' => 'RoleController',
            'store' => 'StoreController',
            'user' => 'UserController'
        ]);
    });
});


Auth::routes();
