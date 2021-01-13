<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterOwnerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     

    * @return void
    */
   public function __construct()
   {
       $this->middleware('auth');
   }


     public function create(){
         return view('registerOwner');
     }
    
    public function store(request $request)
    {
        $this->validateUser($request);
        
        $users = new User();

        $users->name = request('name');
        $users->email = request('email');
        $users->password = Hash::make(request ('password'));
        $users->role = User::OWNER;

        $users->save();

        return redirect('/');
    }

    protected function validateUser(request $request)
    {
        return $request->validate([ 
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
