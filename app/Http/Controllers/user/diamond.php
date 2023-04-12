<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Diamond extends Controller
{
  public function index()
  {
    return view('content.user.diamond');
  }
}
