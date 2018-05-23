<?php

namespace App\Http\Controllers\API;

use App\Suggestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;




class SuggestionController extends Controller
{
    public function index()
    {
        $suggestions = Suggestion::all();
        $suggestion = array();

        foreach ($suggestions as $key => $value){
          array_push($suggestion,  [ 
            $value->name, 
            $value->email, 
            $value->message,
          ]);
        }
  
        return $suggestion;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()]);            
        }

        $input = $request->all();
        $suggestion = Suggestion::create($input);
        return $suggestion;

    }
}
