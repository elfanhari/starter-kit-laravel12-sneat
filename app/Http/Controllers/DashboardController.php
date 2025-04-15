<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $data = [];
    return view('pages.dashboard.index', compact('data'));
  }
}
