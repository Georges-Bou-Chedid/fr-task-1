<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailing;
use App\Models\User;

class MailController extends Controller
{
    public function store($email, $id){

        $users=User::find($id);
        Mail::to($email)->send(new Mailing());

        return view('Purchase\purchase', ['users' => $users]);
       
    }
}
