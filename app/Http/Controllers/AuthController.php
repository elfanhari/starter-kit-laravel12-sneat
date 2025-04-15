<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AuthController extends Controller
{

  public function login(): View
  {
    return view('pages.auth.login');
  }

  public function storeLogin(Request $request): RedirectResponse
  {
    $input = $request->validate([
      'email' => ['required'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($input)) {
      return redirect(route('dashboard.index'))->withInfo('Anda berhasil masuk!');
    } else {
      return back()->withInput()->withWarning('Email atau password salah!');
    }
  }

  public function register(): View
  {
    return view('pages.auth.register');
  }

  public function storeRegister(Request $request): RedirectResponse
  {
    $input = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'unique:users,email'],
      'jk' => ['required', 'string'],
      'alamat' => ['nullable', 'string'],
      'password' => ['required', 'string', 'min:6'],
    ]);

    $input['role'] = 'customer';

    try {
      DB::beginTransaction();
      User::create($input);
      DB::commit();
      return redirect(route('login'))->withInfo('Akun berhasil dibuat, silahkan login!');
    } catch (\Throwable $th) {
      DB::rollBack();
      return back()->with('failed', 'Terjadi kesalahan: ' . $th->getMessage());
    }
  }

  public function logout()
  {
    Auth::logout();
    return redirect(route('home'));
  }
}
