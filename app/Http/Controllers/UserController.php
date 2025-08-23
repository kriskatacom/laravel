<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showRegister(Request $request)
    {
        return view("users.register");
    }

    public function register(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Моля, въведете вашето име и фамилия.',
            'name.max' => 'Името не може да е повече от 255 символа.',
            'email.required' => 'Моля, въведете имейл адрес.',
            'email.email' => 'Въведеният имейл е невалиден.',
            'email.unique' => 'Този имейл вече е регистриран.',
            'password.required' => 'Моля, въведете парола.',
            'password.min' => 'Паролата трябва да е поне 6 символа.',
            'password.confirmed' => 'Паролите не съвпадат.',
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => password_hash($request->password, PASSWORD_DEFAULT),
        ]);

        return redirect("/users/login")->with("success", "Създаването на профила беше успешно!");
    }

    public function showLogin(Request $request)
    {
        return view("users.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Моля, въведете имейл адрес.',
            'email.email' => 'Въведеният имейл е невалиден.',
            'password.required' => 'Моля, въведете парола.',
            'password.min' => 'Паролата трябва да е поне 6 символа.',
        ]);

        $credentials = $request->only("email", "password");

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Успешен вход!');
        }

        return back()->withErrors([
            "email" => "Грешен имейл или парола.",
        ])->withInput($request->except("password"));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Успешен изход!');
    }
}