<?php

namespace App\Http\Controllers\apps\income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Income extends Controller
{
  public function index()
  {
    return view('content.incomes.index');
  }
}
