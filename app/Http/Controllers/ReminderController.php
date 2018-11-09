<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class ReminderController extends Controller
{
    public function sendEmailReminder($id, $dueInDays = 7) {

    	$user = \App\User::findOrFail($id);

    	$tasks = $user->tasks()->dueInDays($dueInDays)->get();

    	$data = [
    		'user' => $user,
    		'dueInDays' => $dueInDays,
    		'tasks' => $tasks,
    	];

    	Mail::send('emails.reminder', $data, function($m) use($user){
    		$m->from('scpark@mailgun.org', 'todolog Application');
    		$m->to('scpark@yju.ac.kr', $user->name)->subject('태스크 만료 알림');
    	});
    }
}
