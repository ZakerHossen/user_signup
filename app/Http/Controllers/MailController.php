<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\userinfo;
use App\registerpin_info;

class MailController extends Controller {

   public function invitation_email(Request $request) {



$name=$request->name;
//$message->
$inv_email=$request->inv_email;

$sender=$request->sender;

$sendermail=$request->sendermail;

//$reg_link=$reques->reg_link;
//$inv_email='zakir041@gmail.com';

      $data = array('name'=>$name);
   
      Mail::send('mail', $data, function($message) use($name,$inv_email,$sender,$sendermail) {
         $message->to($inv_email, $name)->subject
            ('Invitation Mail for registration');
         $message->from($sendermail,$sender);
      });
      $userjson[]=array(
       "status" => true,
        "message" => "Email Sent. Check your inbox."
    );

return response()->json($userjson);

   }
   

public function regdatapost(Request $request){

$requestdata= new userinfo();
$requestdata1=new registerpin_info();
$nfname=$request->name;
$username=$request->username;
$email=$request->email;

$requestdata->name=$nfname;
$requestdata->user_name=$username;
$requestdata->email=$email;
$requestdata->user_role='user';
$requestdata->save();

$name=$nfname;

$inv_email=$email;

$sender='admin';
$sendermail='admin@gmail.com';
///curdate = date("mds");
$regpin=substr(str_shuffle("0123456789"), 0, 6);

$requestdata1->pin_email=$email;
$requestdata1->pin_no=$regpin;
$requestdata1->pin_status='N';
$requestdata1->save();
$data = array('name'=>$name,'regpin'=>$regpin);
   
      Mail::send('mailpin', $data, function($message) use($name,$inv_email,$sender,$sendermail) {
         $message->to($inv_email, $name)->subject
            ('Registration Pin');
         $message->from($sendermail,$sender);
      });

$userjson[]=array(
       "status" => true,
        "message" => "Data saved."
    );

return response()->json($userjson);
   }


public function pin_verification(Request $request){

$requestdata =new registerpin_info();
$useremail=$request->useremail;
$userpin=$request->userpin;

$dcount=$requestdata
->where('pin_email',$useremail)
->Where('pin_no',$userpin)
->Where('pin_status','N')
->count();

if($dcount==0){

$userjson[]=array(
       "status" => false,
        "result" => "Incorrect Pin",
        "message" => "Please put correct pin no.."
    );

return response()->json($userjson);

}else{

$requestdata->where('pin_email',$useremail)
->Where('pin_no',$userpin)
->Where('pin_status','N')
->update(['pin_status'=>'Y']);
   $userjson[]=array(
       "status" => true,
        "result" => "Pin Verified",
        "message" => "Thank you for registration"
    );

return response()->json($userjson);
}
}

   public function html_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}
