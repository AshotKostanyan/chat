<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;


class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }
    public function store()
    {
        $attributes = request()->validate([
            'name'=>['required', 'max:255'],
            'username'=>['required', 'max:255','min:2',Rule::unique('users', 'username')],
            'email'=>['required', 'email','max:255',Rule::unique('users', 'email')],
            'password'=>['required','min:7','max:255']
        ]);

        $user = User::create($attributes);
        auth()->login($user);


        return redirect('/');
    }
}
