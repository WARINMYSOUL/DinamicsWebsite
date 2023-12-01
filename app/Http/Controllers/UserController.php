<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Показать форму для регистрации/создания
    public function create() {
        return view('users.register');
    }

    // Создание нового пользователя
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Хеш-пароль
        $formFields['password'] = bcrypt($formFields['password']);

        // Создание пользователя
        $user = User::create($formFields);

        // Вход в систему
        auth()->login($user);

        return redirect('/')->with('message', 'Пользователь создан и авторизован!');
    }

    // Выход пользователя из системы
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Вы вышли из системы!');

    }

    // Показать форму для входа
    public function login() {
        return view('users.login');
    }

    // Аутентификация пользователя
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Вы вошли в систему!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
