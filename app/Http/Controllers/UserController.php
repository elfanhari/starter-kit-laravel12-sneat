<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $user = User::query();
    if (request()->ajax()) {
      foreach (['jk', 'role', 'is_verified'] as $filter) {
        if ($request->$filter) {
          if ($filter == 'is_verified') {
            $request->$filter == 'true'
              ? $user->whereNotNull('email_verified_at')
              : $user->whereNull('email_verified_at');
          } else {
            $user->where($filter, $request->$filter);
          }
        }
      }
      return DataTables::of($user)
        ->addIndexColumn()
        ->editColumn('jk', function ($user) {
          return $user->jenis_kelamin;
        })
        ->editColumn('verified', function ($user) {
          return view('components.partials.badge', [
            'class' => $user->email_verified_at ? 'bg-label-success fs-10' : 'bg-label-danger fs-10',
            'text' => $user->email_verified_at ? 'Verified' : 'Non-Verified'
          ])->render();
        })
        ->addColumn('aksi', function ($user) {
          return view('pages.user._aksi', compact('user'));
        })
        ->rawColumns(['jk', 'verified', 'aksi'])
        ->make(true);
    }
    return view('pages.user.index', [
      'user' => $user
    ]);
  }

  public function index2(Request $request)
  {
    $users = User::query();

    foreach (['jk', 'role', 'is_verified'] as $filter) {
      if ($request->$filter) {
        if ($filter == 'is_verified') {
          $request->$filter == 'true'
            ? $users->whereNotNull('email_verified_at')
            : $users->whereNull('email_verified_at');
        } else {
          $users->where($filter, $request->$filter);
        }
      }
    }

    return view('pages.user.index', [
      'users' => $users->get()
    ]);
  }

  public function create()
  {
    $user = new User();
    return view('pages.user.create', [
      'user' => $user,
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'jk' => 'required',
      'role' => 'required',
      'alamat' => 'nullable',
      'email' => 'required|unique:users,email',
      'password' => 'required',
    ]);

    try {
      DB::beginTransaction();
      User::create($request->all());
      DB::commit();
      return redirect(route('user.index'))->with([
        'success' => 'Data berhasil ditambahkan!'
      ]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
    }
  }
  public function show(User $user)
  {
    return $user;
  }

  public function edit(User $user)
  {
    return view('pages.user.edit', compact('user'));
  }

  public function update(Request $request, User $user)
  {
    $request->validate([
      'name' => 'required',
      'jk' => 'required',
      'role' => 'required',
      'alamat' => 'nullable',
      'email' => 'required|unique:users,email,' . $user->id,
      'password' => 'nullable',
    ]);

    try {
      DB::beginTransaction();
      if ($request->password) {
        $user->update($request->all());
      } else {
        $user->update($request->except('password'));
      }
      DB::commit();
      return redirect(route('user.index'))->with([
        'success' => 'Data berhasil diperbarui!'
      ]);
    } catch (\Throwable $th) {
      DB::rollBack();
      return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
    }
  }

  public function destroy(User $user)
  {
    try {
      DB::beginTransaction();
      $message =  $user->name . ' berhasil dihapus!';
      $user->delete();
      DB::commit();
      // return response()->json(['success' => $message]); // yajra
      return back()->with([
        'success' => $message
      ]);
    } catch (\Throwable $th) {
      DB::rollBack();
      // return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()]); // yajra
      return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
    }
  }

  public function deleteMultiple(Request $request)
  {
    $ids = $request->ids;

    try {
      DB::beginTransaction();
      User::whereIn('id', $ids)->delete();
      DB::commit();
      return response()->json(['success' => count($ids) . ' data berhasil dihapus!']);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['error' => 'Terjadi kesalahan: ' . $th->getMessage()]);
    }
  }
}
