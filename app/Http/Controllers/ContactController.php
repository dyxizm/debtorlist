<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ContactFormRequest;
use App\Http\Controllers\Controller;

use Redirect;
use Response;

class ContactController extends Controller
{
    public function store(ContactFormRequest $request)
	{
		$send = \Mail::send('emails.contact',
				array(
					'name' => $request->get('name'),
					'email' => $request->get('email'),
					'phone' => $request->get('phone'),
					'user_message' => $request->get('message')
				),
				function($message){
					$message->from('wj@wjgilmore.com');
					$message->to('wj@wjgilmore.com', 'Admin')->subject('TODOParrot Feedback');
		});
		if($send){
			$res = array('send'=> 'ok');
		}else{
			$res = array('send'=> 'fail');		
		}
		
		return Response::json($res);   
	}
	  		
}
