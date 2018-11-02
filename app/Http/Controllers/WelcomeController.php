<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class WelcomeController extends Controller
{
    public function index() {
	    $uc = User::count();
	    $pc = 0; // Project::count();
	    $tc = 0; // Task::count();

	    $total = ['user'=>$uc, 'project'=>$pc, 'task'=>$tc];
	    return view('welcome')->with('total', $total);
	}
}
