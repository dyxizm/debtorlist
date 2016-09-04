<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostFormRequest;
use App\Http\Controllers\Controller;
use App\user;

use Redirect;
use Response;
use Hashids\Hashids;

class userController extends Controller
{
    public function show($slug)
	{
		$user = user::where('slug', '=', $slug, 'and', 'status', '=', '0')->firstOrFail(); 
		if($user->audioTalk){
			$audioTalk = explode(", ", $user->audioTalk);
			foreach($audioTalk as &$item){
				$item = array('track'=>$item);
			}
			$user->audioTalk = $audioTalk;
		}
		return view('user', ['user' => $user] ); 
	}
	
	
    public function searchShow(Request $request)
	{
		$phone = $request->get('phone');
		$slug = self::id2Slug($phone);
		$user = user::where('slug', '=', $slug, 'and', 'status', '=', '0')->firstOrFail(); 
		return redirect('user/'.$slug);
	}	
	
	
	public function store(PostFormRequest $request, $token=false)
	{
		if($token==env('APP_PASS')){
			$user = new user();
			$user->name = $request->get('name');
			$user->phone = $request->get('phone');
			$user->slug = self::id2Slug($user->phone);
			$user->debt = $request->get('debt');   
			$user->textTalk = $request->get('textTalk');
			
			
			$audioTalk = array();		
			$files = $request->file('audioTalk');
			$i=1;
			foreach($files as $file) {
				$uploadsPath = 'uploads';
				$filename = $user->slug."_{$i}_".$file->getClientOriginalName();
				if($file->move($uploadsPath, $filename))
				{
					$audioTalk[] = $filename;
				}
				$i++;
			}
			$user->audioTalk = implode(", ", $audioTalk);			
						
			if($request->has('paid')){
				$user->status = 1;
			}else{
				$user->status = 0;
			}
			$user->created_at = new \DateTime;
			$user->updated_at = new \DateTime;
			
			$user->save();
					
			return redirect('user/'.$user->slug.'/edit/'.$token)->withMessage('add user');
		}else{
			return redirect('/')->withMessage('not access');
		}
	}
	
	
	public function create(Request $request, $token=false)
	{
		if($token==env('APP_PASS')){
			return view('add',['token' => $token]);
		}else{
			return redirect('/')->withMessage('not access');
		}
	}
		
	
	public function edit(Request $request, $slug, $token=false)
	{
		if($token==env('APP_PASS')){
			$user = user::where('slug',$slug)->first();
			return view('edit',['token' => $token, 'user' => $user]);
		}else{
			return redirect('/')->withMessage('not access');
		}		
	}
	
	
	public function update(PostFormRequest $request, $token=false)
	{
		if($token==env('APP_PASS')){		
			$id = $request->input('id');
			$name = $request->input('name');
			
			$user = user::find($id);   
			$user->name = $name;
			$user->phone = $request->input('phone'); 
			$user->debt = $request->input('debt');   
			$user->slug = self::id2Slug($user->phone);
			$user->textTalk = $request->input('textTalk');
			$user->audioTalk = $request->input('audioTalk');
			if($request->has('status')){
				$user->status = 1;
			}else{
				$user->status = 0;
			}	
			$user->updated_at = new \DateTime;
			$user->save();
			$message = 'Post updated successfully';	
			return redirect('user/'.$user->slug.'/edit/'.$token)->withMessage($message);
		}else{
			return redirect('/')->withMessage('not access');
		}		
	}
  	
	
	public function destroy(Request $request, $id, $token=false)
	{	
		if($token==env('APP_PASS')){		  
			$user = user::find($id);
			$user->delete();
			return redirect('/')->withMessage('User deleted Successfully');
		}else{
			return redirect('/')->withMessage('not access');
		}			
	}  	


	public function searchQuery($query)
    {
		try {
			$res = user::where('phone', 'LIKE', "%{$query}%")->get();
		} catch (Exception $e) {
			$res = array('results'=> $e->getMessage());
		}
				
		return Response::json($res);
    }


	public function paid(Request $request)
    {
		//https://money.yandex.ru/myservices/online.xml
		$secret_key = 'Ml/siZ3DiRDEO3vKWBXlBfEv';
		$sha1 = sha1( $request->get('notification_type') . '&'. $request->get('operation_id'). '&' . $request->get('amount') . '&643&' . $request->get('datetime') . '&'. $request->get('sender') . '&' . $request->get('codepro') . '&' . $secret_key. '&' . $request->get('label') );
		
		if ($sha1 != $_POST['sha1_hash'] ) {
			return Response::json(array('paid'=> 'not check'), 404);
		}
		$phone = $request->get('phone');
		$sum = $request->get('amount');
		$slug = self::id2Slug($phone);
		$user = user::where('slug', '=', $slug, 'and', 'status', '=', '0')->firstOrFail();
		$debt = $user->debt - $sum;
		if($debt > 0){
			$user->debt = $debt;
		}else{
			$user->debt = $debt;
			$user->status = 1;
		}
		$user->save();
		
		return Response::json(array('paid'=> 'check'));
	}

	static protected function slug2Id($slug) 
	{
		$hashids = new Hashids(env('APP_PASS'));
		$id = $hashids->decode($slug);
		return $id;
	}
	
	
	static protected function id2Slug($id) 
	{
		$hashids = new Hashids(env('APP_PASS'));
		$slug = $hashids->encode($id);
		return $slug;
	}	
  		
}
