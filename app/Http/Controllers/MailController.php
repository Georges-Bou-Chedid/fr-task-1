<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PurchaseReceived;
use App\Models\User;
use DB;

class MailController extends Controller
{
    public function store(){

        $total_price = auth()->user()->cart->sum('Price');

        Notification::send(request()->user(), new PurchaseReceived($total_price));

        return redirect('/cart')->with('message' , 'An Email was sent to you! Thank you for your purchase');
       
    }

    public function show(){
 
        $notifications = auth()->user()->unreadNotifications;

        $notifications->markAsRead();

        return view('notifications.showpurchase', [
            'notifications' => $notifications
        ]);
    }
}