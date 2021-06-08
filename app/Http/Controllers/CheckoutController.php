<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Cart;
use Session;
use Mail;

class CheckoutController extends Controller
{
    //
    public function index(){

    	if(Cart::content()->count() == 0){
    		Session::flash('info', 'Your cart is still empty');
    		return redirect()->back();
    	}
    	return view('checkout');
    }

    public function pay() {
    	//dd(request()->all());

    	Stripe::setApiKey('sk_test_EbKl73aOsQHOmzPAaUGMCahC00OmVNcwCB');
    	$token = request()->stripeToken;
    	$charge = Charge::create([
    		'amount'	=> ceil(Cart::total()*100/14000),
    		'currency'	=> 'usd',
    		'description'	=> 'udemy online books selling',
    		'source'	=> $token
    	]);

    	//dd('your card was charged successfully');
    	Session::flash('success', 'Purchase successfull. wait for email');
    	Cart::destroy();

    	Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccessfull);
    	return redirect()->route('index');
    }
}
