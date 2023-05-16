<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Music;

class AnalyticsController extends Controller
{
  public function index()
  {
    $male_account = User::where('gender', '=', 'male')->count();
    $female_account = User::where('gender', '=', 'female')->count();
    $music = Music::count(); 
    return view('content.dashboard.dashboards-analytics' , compact('male_account', 'female_account', 'music'));
  }
}
