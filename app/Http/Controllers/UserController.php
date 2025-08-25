<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function showRegister(Request $request)
    {
        return view("users.register");
    }

    public function showLogin(Request $request)
    {
        return view("users.login");
    }

    public function showPasswordReset(Request $request)
    {
        return view("users.password-reset");
    }

    public function index(Request $request)
    {
        $users = User::paginate(10);
        return view("admin.users.index", compact("users"));
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()
                ->route("dashboard.users.index")
                ->with("error", "Потребителят не беше намерен.");
        }

        return view("admin.users.show", compact("user"));
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('dashboard.users.index')
                ->with('error', 'Потребителят не е намерен.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->route("dashboard.users.index")
                ->with("error", "Потребителят не е намерен.");
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/users'), $imageName);
            $user->image_url = '/images/users/' . $imageName;
        }

        $user->name = $request->name;
        $user->save();

        if ($request->input('action') === 'save_and_index') {
            return redirect()->route('dashboard.users.index')
                ->with('success', 'Данните на потребителт са актуализирани успешно.');
        }

        return redirect()->back()->with('success', 'Данните на потребителт са актуализирани успешно.');
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

    public function passwordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Моля, въведете имейл адрес.',
            'email.email' => 'Въведеният имейл е невалиден.',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Изпратихме ви линк за смяна на паролата на посочения имейл адрес.');
        }

        return back()->with('error', 'Не успяхме да намерим потребител с този имейл адрес.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Успешен изход!');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route("dashboard.categories.index")
                ->with("error", "Категорията не е намерена.");
        }

        if (Auth::user()->id === $user->id) {
            return redirect()->route("dashboard.users.index")
                ->with("error", "Не можете да изтриете себе си.");
        }

        if ($user->image_url) {
            $imagePath = public_path($user->image_url);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($user->delete()) {
            return redirect()->route("dashboard.users.index")
                ->with("success", "Потребителят беше изтрит успешно.");
        }

        return redirect()->route("dashboard.users.index")
            ->with("error", "Възникна грешка при изтриване на потребителя.");
    }
}
