<?php namespace App\Http\Requests;
use App\Http\Requests\Request;
use App\user;

class PostFormRequest extends Request {
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
   public function authorize()
   {
		return true;
   }
  
  public function rules()
  {
    $rules = [
      'name' => 'required|max:255',
      'phone' => 'required|max:20',
      'phone' => array('Regex:/^[0-9]+$/'),
      'debt' => 'required',
      'debt' => array('Regex:/^[0-9]+$/'),
      //'audioTalk' => 'required|mimes:audio/*',
    ];
    
	
	return $rules;
  }    
}
