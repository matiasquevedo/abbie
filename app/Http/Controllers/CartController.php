<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use Illuminate\Support\Collection as Collection;

class CartController extends Controller
{
    //
    public function __construct(){
    	if(!\Session::has('cart')) \Session::put('cart',array());
    }

    //mostrar carrito
    public function show(){
    	$cart = \Session::get('cart');
        $total = 0;
        //dd($cart);
        foreach ($cart as $item) {
            $total = $total + $item['costo'];
            # code...
        }
        //dd($total);
    	return view('admin.cart.cart')->with("cart",$cart)->with("total",$total);
    }

    public function add($id){
    	$actividad = Actividad::find($id);
    	$cart = \Session::get('cart');

    	$cart[$actividad->id] = $actividad;
    	\Session::put('cart',$cart);
        return redirect()->route('cart.show');

    }

    public function destroy($item){
        //        dd($item);
        $cart = \Session::pull('cart',[]);
        foreach ($cart as $key => $id) {
            //dd($id["id"]);
            if ($id["id"] == $item) {
                # code...
                unset($cart[$key]);
                //dd("todo okd",$key,$cart);
            }
        }
        \Session::put('cart',$cart);
        return redirect()->route('cart.show');
    }

    public function trash(){
        \Session::forget('cart');
        return redirect()->route('cart.show');
    }

    public function store(Request $request){
        if ($request->fecha) {
             $actividad = Actividad::find($request->actividad);
             
             $costo = $request->pasajeros * $actividad->precioPublico;
             //dd($costo);

             \Session::push('cart', [
                 'id' => $actividad->id,
                 'actividad' => $actividad,
                'cantidad' => $request->pasajeros,
                'fecha' => $request->fecha,
                'costo' => $costo
             ]);
            $cart = \Session::get('cart');
             //dd($cart);
            return redirect()->route('cart.show');
        } else {
            flash('Ingrese una fecha valida')->error();
            return redirect()->route('actividad.public',$request->actividad);
        }

    }

    
}


//dd($cart,Milkshake96,skinny);
