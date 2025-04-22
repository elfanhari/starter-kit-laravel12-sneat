<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
  public function index()
  {
    return view('pages.profile.index', [
      'user' => Auth::user(),
    ]);
  }

  public function update(Request $request)
  {
    // dd($request->all());
    $user = Auth::user();
    $validated = $request->validate([
      'name'     => 'required|string|max:255',
      'jk'       => 'required',
      'alamat'   => 'nullable|string',
      'email'    => 'required|email|unique:users,email,' . $user->id,
      'password' => 'nullable|string|min:6',
      'avatar'   => 'nullable|image|max:2048',
    ]);

    $data = $validated;

    if (!$request->filled('password')) {
      unset($data['password']);
    }

    try {
      DB::beginTransaction();
      if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $filename = 'img' . time() . Auth::id() . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img/avatar'), $filename);

        if ($user->avatar != 'avatar.jpg') {
          $oldPath = public_path('img/avatar/' . $user->avatar);
          if (File::exists($oldPath)) {
            File::delete($oldPath);
          }
        }
        $data['avatar'] = $filename;
      }

      // dd($data);
      $user->update($data);

      DB::commit();
      return back()->with('success', 'Profile berhasil diperbarui!');
    } catch (\Throwable $th) {
      // dd($data);
      DB::rollBack();
      return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
    }
  }
}
