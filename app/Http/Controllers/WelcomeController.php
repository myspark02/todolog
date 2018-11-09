<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Task;

class WelcomeController extends Controller
{
    public function index() {
    	/*
	    $uc = User::count();
	    $pc = Project::count();
	    $tc = Task::count();
		*/

	    $drv = \Config::get('cache.default');

	    if ($drv == 'redis') {
	    	$uc = \Redis::get('user:count');
	    	$pc = \Redis::get('project:count');
	    	$tc = \Redis::get('task:count');
	    }else {
		    $uc = User::count();
		    $pc = Project::count();
		    $tc = Task::count();	    	
	    }

	    $total = ['user'=>$uc, 'project'=>$pc, 'task'=>$tc];
	    return view('welcome')->with('total', $total);
	}
}
