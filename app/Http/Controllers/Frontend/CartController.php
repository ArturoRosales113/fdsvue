<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Dish;
use App\Kart;
use App\Order;
use App\Store;
use Session;
use Carbon\Carbon;
use View;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class CartController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('backend.pedidos.pedidos');//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        //return redirect('home/tienda');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    // |--------------------------------------------------------------------------
    // | Carrito
    // |--------------------------------------------------------------------------
    // |
    // |


    public function getAddToCart(request $request, $id) // id of dish
    {
        $product = Dish::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Kart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        $items = $cart->items;

        return response()->json([
         'status' => 'item added',
         'product_id' => $id,
         'items' => $items,
         'totalQty' => $cart->totalQty,
         'totalPrice' => $cart->totalPrice
        ]);
    }


    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('Frontend.Shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Kart($oldCart);
        return view('Frontend.Shop.shopping-cart', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'totalQty' => $cart->totalQty
        ]);
    }
    public function getCheckOut()
    {
        return view('Frontend.Shop.checkout');
    }
				public function getStores()
				{
						$stores = Store::all();
						return response()->json([
								'stores' => $stores
								]);
				}

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Kart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
            $items = $cart->items;
            if (isset($cart->items[$id])) {
             return response()->json([
              'status'=> 'item deleted',
              'product_id' => $id,
              'items' => $items,
              'totalQty' => $cart->totalQty,
              'totalPrice' => $cart->totalPrice
             ]);
            }
            else{
             return response()->json([
              'status' => 'item deleted',
              'product_id' => $id,
              'items' => $items,
              'totalQty' => $cart->totalQty,
              'totalPrice' => $cart->totalPrice
             ]);
            }
        } else {
            Session::forget('cart');
            return response()->json([
             'status' => 'cart_empty',
            ]);

        }

    }
    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Kart($oldCart);
        $cart->removeItem($id);
        $items = $cart->items;
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
            return response()->json([
             'status'=> 'items',
             'product_id' => $id,
             'items' => $items,
             'totalQty' => $cart->totalQty,
             'totalPrice' => $cart->totalPrice
            ]);
        } else {
            Session::forget('cart');
            return response()->json([
             'status' => 'cart_empty',
            ]);

        }

    }

    public function EmptyCart() // Destroy Cart
    {
        Session::forget('cart');
        Session::save();
        return redirect()->back();
    }


    public function createOrder(Request $request) // Save cart as order
    {
        $this->validate($request, [
         'customer_name' => 'required|string|max:255',
         'customer_mail' => 'required|string|email|max:255',
         'customer_phone' => 'required|string|min:7|max:10',
        ]);
        $items = Session::has('cart') ? Session::get('cart') : null;
        if ($items) {
            $order = Order::create($request->all());
            //dd($items);
            foreach ($items->items as $item) {
             $order->dishes()->attach($item['item']['id']);
            }
        } else {
            dd('Cart was empty');
        }
        return redirect()->route('shoppingcart.shoppingcart');
    }
}
