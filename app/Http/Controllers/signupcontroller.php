<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class signupcontroller extends Controller
{
    public function sendinvitaion(Request $request){

$userjson[]=array(
       "status" => true,
        "message" => "User Already Exist"
    );

return response()->json($userjson);
    }

   public function user_registration(){
return view('registration');

   }


   public function regdatapost(Request $request){


   }
   
}
