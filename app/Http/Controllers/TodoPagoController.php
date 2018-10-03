<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TodoPago\Sdk;
use App\Pedido;
use App\Item;
use Illuminate\Support\Collection;

class TodoPagoController extends Controller
{
    //

    public function generarPago()
    {
        $total = 0;
        $pedido = new Pedido();
        $pedido->user_id = \Auth::user()->id;
        $pedido->precioTotal = $total;
        $pedido->save();
        $cart = \Session::get('cart');
        //dd($cart);
        foreach ($cart as $item) {
            $i = new Item();
            $i->pedido_id = $pedido->id;
            $i->actividad_id = $item['id'];
            $i->fecha = $item['fecha'];
            $i->cantidad = $item['cantidad'];
            $i->costo = $item['costo'];
            $i->save();
            $total = $total + $item['costo'];
            # code...
        }
        $pedido->precioTotal = $total;
        //dd($pedido);
        if(count($pedido->items)==0){
            $pedido->delete();
            return redirect()->route('principal');
        } else {


        $mode = "test";
        $http_header = array('Authorization'=>'TODOPAGO 35f388c45e0a41a89f5f45c05f28a9a7');
        $connector = new Sdk($http_header, $mode);
        $optionsSAR_comercio = array (
            'Security'=> '35f388c45e0a41a89f5f45c05f28a9a7',
            'EncodingMethod'=>'XML',
            'Merchant'=>511872,
            'URL_Request'=>route('efectuar.pago')
        );
        $optionsSAR_operacion = array(
            'CSBTCITY'=>'Villa General Belgrano', //Ciudad de facturación, REQUERIDO.
            'CSBTCOUNTRY'=>'AR', //País de facturación. REQUERIDO. Código ISO.
            'CSBTCUSTOMERID'=>'234234', //Identificador del usuario al que se le emite la factura. REQUERIDO. No puede contener un correo electrónico.
            'CSBTIPADDRESS'=>'192.0.0.4', //IP de la PC del comprador. REQUERIDO.
            'CSBTEMAIL'=>'decidir@hotmail.com', //Mail del usuario al que se le emite la factura. REQUERIDO.
            'CSBTFIRSTNAME'=>'Juan' ,//Nombre del usuario al que se le emite la factura. REQUERIDO.
            'CSBTLASTNAME'=>'Perez', //Apellido del usuario al que se le emite la factura. REQUERIDO.
            'CSBTPHONENUMBER'=>'541160913988', //Teléfono del usuario al que se le emite la factura. No utilizar guiones, puntos o espacios. Incluir código de país. REQUERIDO.
            'CSBTPOSTALCODE'=>' C1010AAP', //Código Postal de la dirección de facturación. REQUERIDO.
            'CSBTSTATE'=>'B', //Provincia de la dirección de facturación. REQUERIDO. Ver tabla anexa de provincias.
            'CSBTSTREET1'=>'Cerrito 740', //Domicilio de facturación (calle y nro). REQUERIDO.
            'CSBTSTREET2'=>'Piso 8', //Complemento del domicilio. (piso, departamento). OPCIONAL.
            'CSPTCURRENCY'=>'ARS', //Moneda. REQUERIDO.
            'CSPTGRANDTOTALAMOUNT'=>125.15, //Con decimales opcional usando el punto como separador de decimales. No se permiten comas, ni como separador de miles ni como separador de decimales. REQUERIDO. (Ejemplos:$125,38-> 125.38 $12-> 12 o 12.00)
            'CSMDD7'=>'', // Fecha registro comprador(num Dias). OPCIONAL.
            'CSMDD8'=>'Y', //Usuario Guest? (Y/N). En caso de ser Y, el campo CSMDD9 no deberá enviarse. OPCIONAL.
            'CSMDD9'=>'', //Customer password Hash: criptograma asociado al password del comprador final. OPCIONAL.
            'CSMDD10'=>'', //Histórica de compras del comprador (Num transacciones). OPCIONAL.
            'CSMDD11'=>'', //Customer Cell Phone. OPCIONAL.
            'CSSTCITY'=>'rosario', //Ciudad de envío de la orden. REQUERIDO.
            'CSSTCOUNTRY'=>'AR', //País de envío de la orden. REQUERIDO.
            'CSSTEMAIL'=>'jose@gmail.com', //Mail del destinatario, REQUERIDO.
            'CSSTFIRSTNAME'=>'Jose', //Nombre del destinatario. REQUERIDO.
            'CSSTLASTNAME'=>'Perez', //Apellido del destinatario. REQUERIDO.
            'CSSTPHONENUMBER'=>'541155893737', //Número de teléfono del destinatario. REQUERIDO.
            'CSSTPOSTALCODE'=>'1414', //Código postal del domicilio de envío. REQUERIDO.
            'CSSTSTATE'=>'D', //Provincia de envío. REQUERIDO. Son de 1 caracter
            'CSSTSTREET1'=>'San Martín 123', //Domicilio de envío. REQUERIDO.
            'CSMDD12'=>'',//Shipping DeadLine (Num Dias). NO REQUERIDO.
            'CSMDD13'=>'',//Método de Despacho. NO REQUERIDO.
            'CSMDD14'=>'',//Customer requires Tax Bill ? (Y/N). NO REQUERIDO.
            'CSMDD15'=>'',//Customer Loyality Number. NO REQUERIDO.
            'CSMDD16'=>'',//Promotional / Coupon Code. NO REQUERIDO.
            //Retail: datos a enviar por cada producto, los valores deben estar separados con #:
            'CSITPRODUCTCODE'=>'electronic_good', //Código de producto. REQUERIDO. Valores posibles(adult_content;coupon;default;electronic_good;electronic_software;gift_certificate;handling_only;service;shipping_and_handling;shipping_only;subscription)
            'CSITPRODUCTDESCRIPTION'=>'NOTEBOOK L845 SP4304LA DF TOSHIBA', //Descripción del producto. REQUERIDO.
            'CSITPRODUCTNAME'=>'NOTEBOOK L845 SP4304LA DF TOSHIBA', //Nombre del producto. REQUERIDO.
            'CSITPRODUCTSKU'=>'LEVJNSL36GN', //Código identificador del producto. REQUERIDO.
            'CSITTOTALAMOUNT'=>125.15, //CSITTOTALAMOUNT=CSITUNITPRICE*CSITQUANTITY "999999[.CC]" Con decimales opcional usando el punto como separador de decimales. No se permiten comas, ni como separador de miles ni como separador de decimales. REQUERIDO.
            'CSITQUANTITY'=>'1', //Cantidad del producto. REQUERIDO.
            'CSITUNITPRICE'=>125.15, //Formato Idem CSITTOTALAMOUNT. REQUERIDO.
            'AMOUNT'=>$total,
            'MERCHANT'=> "511872",


            );

        $values = $connector->sendAuthorizeRequest($optionsSAR_comercio, $optionsSAR_operacion);
        $methodPay = collect((object) $connector->discoverPaymentMethods());
        //dd($values,$methodPay);
        return view('public.pago')->with("pedido",$pedido)->with("methodPay",$methodPay);
        }
        
        
    }

    public function pagar(){
        //dd($request);
        $total = 0;
        $pedido = new Pedido();
        $pedido->user_id = \Auth::user()->id;
        $pedido->precioTotal = $total;
        $pedido->save();
        $cart = \Session::get('cart');
        //dd($cart);
        foreach ($cart as $item) {
            $i = new Item();
            $i->pedido_id = $pedido->id;
            $i->actividad_id = $item['id'];
            $i->fecha = $item['fecha'];
            $i->cantidad = $item['cantidad'];
            $i->costo = $item['costo'];
            $i->save();
            $total = $total + $item['costo'];
            # code...
        }
        $pedido->precioTotal = $total;
        //dd($pedido);
        if(count($pedido->items)==0){
            $pedido->delete();
            return redirect()->route('principal');
        }
        return view('public.pago')->with("pedido",$pedido);
    }


    
}
