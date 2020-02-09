<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Ticket;
//use App\Contact;
use App\Rules\Captcha;
use App\ContactForm;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\mailController;
class newticketController extends Controller
{ 
      public function index()
      {
         // return view('new-ticket');
         return view('theme1.contactus.contactform');
      }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:contact_forms,email',
            'mobile' => 'required',
            'subject' => 'required',
            'g-recaptcha-response' => new Captcha(),           
        ]);    

        //$password = Hash::make('password');
        //$userinfo = array('name'=>$request->name,'lname'=>$request->lname,           'email'=>$request->email,'password'=>$password ,'mobile'=>$request->mobile,'user_type'=>'user',         'user_type'=>'user','privilege'=>'agent','department'=>'19',         'login_status'=>'1','delete_status'=>'1');
        $visitor =request()->server('SERVER_ADDR');
        $userinfo = array('firstname'=>$request->name,'lastname'=>$request->lname,'email'=>$request->email,'mobile'=>$request->mobile,'subject'=>$request->subject,'description'=>$request->description,'visitor'=>$visitor,'source'=>'contact_form');



        $userid = ContactForm::create($userinfo);
        $unique_ticket =  rand(100000,999999);
        $ticketinfo = array('contact_id' =>  $userid->firstname.' ' .$userid->lastname, 
        'unique_ticket'=>$unique_ticket, 
        'subject' => $request->subject,
        'questiontype_id' =>  '6', 
        'status_id'=>'1',
        'priority_id' => '4',
        'department_id' => '19',    
        'resource' => 'contact_form',      
        'cus_id' => $userid->id,
        'description' => $request->description);         
         Ticket::create($ticketinfo);
        // return redirect()->back()->with('success','Your ticket is created successfully. Our agent will contact soon.');
        return redirect()->back()->with('success','Thank you for contacting us.');
         
    }

     

    public function ticketwidget(Request $request){
        //dd($request->all());
       //return json_encode('hello');
    $useremail = ContactForm::where('email','=',$request->email)->count();
    if($useremail == 1){
        $users = ContactForm::where('email','=',$request->email)->first();
        $unique_ticket =  rand(100000,999999);         
        $ticketinfo = array('contact_id' =>  $userid->firstname.' ' .$userid->lastname, 
        'unique_ticket'=>$unique_ticket, 
        'subject' => $request->subject,
        'questiontype_id' =>  '6', 
        'status_id'=>'1',
        'priority_id' => '4',
        'department_id' => '19',        
        'cus_id' => $users->id,
        'description' => $request->description);        
         $tickets = Ticket::create($ticketinfo);
         $message = "Ticket post successfully, our agent will contact soon.";
         return json_encode($message );
        // return json_encode($message );
    }else{
        $visitor =request()->server('SERVER_ADDR');
        $userinfo = array('firstname'=>$request->name,'lastname'=>$request->lname,'email'=>$request->email,'mobile'=>$request->mobile,'subject'=>$request->subject,'description'=>$request->description,'visitor'=>$visitor,'source'=>'widget_form');

        $userid = ContactForm::create($userinfo);
        $insertedId = $userid->id;
        $unique_ticket =  rand(100000,999999);         
        $ticketinfo = array('contact_id' =>  $userid->firstname.' ' .$userid->lastname, 
        'unique_ticket'=>$unique_ticket, 
        'subject' => $request->subject,
        'questiontype_id' =>  '6', 
        'status_id'=>'1',
        'priority_id' => '4',
        'department_id' => '19',        
        'cus_id' => $insertedId,
        'description' => $request->description);         
         $tickets = Ticket::create($ticketinfo);
         $message = "Ticket post successfully, our agent will contact soon.";
         return json_encode($message );
        }   
        
        //return redirect()->back()->with('message','Your ticket is created successfully. Our agent will contact soon.');
        // return response()->json(['status'=>true,'message'=>"Ticket post successfully, our agent will contact soon."]);   
         
    }
}
