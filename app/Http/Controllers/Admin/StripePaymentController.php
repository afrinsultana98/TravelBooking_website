<?php

namespace App\Http\Controllers\Admin;

use Session;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class StripePaymentController extends Controller
{
    public function stripePost(Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $user = Auth::user();
            $charge = Charge::create([
                'amount' => $request->price * 100, // Amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Booking charge for ' . $user->name,
                'receipt_email' => $user->email, // Pass email for receipt
                'metadata' => [
                    'name' => $user->name,
                    'address' => [
                        'city' => null,
                        'country' => null,
                        'line1' => null,
                        'line2' => null,
                        'postal_code' => null,
                        'state' => null,
                    ],
                    // 'phone' => null,
                ]
            ]);
            Cache::set('charge', $charge);
            return response()->json($charge);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
}
