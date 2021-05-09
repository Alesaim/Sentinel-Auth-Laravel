<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Reminder;
use Mail;
use Sentinel;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
    	return view('authentication.forgot-password');
    }

    public function postForgotPassword(Request $request)
    {
    	$user = User::whereEmail($request->email)->first();
    	$sentinelUser = Sentinel::findById($user->id);
    	
    	if(!$user)
    		return redirect()->back()->with([
    			'success' => 'Reset code was sent to your email.'
    			]);
    		$reminder = Reminder::exists($sentinelUser) ?: Reminder::create($sentinelUser);
    		$this->sendEmail($user, $reminder->code);

    		return redirect()->back()->with([
    			'success' => 'Reset code wass sent to your email.'
    			]);
    }

    public function resetPassword($email, $resetCode)
    {        
        $user = User::whereEmail($email)->first();
        $sentinelUser = Sentinel::findById($user->id);

        if(!$user){
            abort(404);
        }   
      /*  1st condition which from you can work
       Your code is working with below  codietion
       if ($sentinelUser) {
           ($reminder = Reminder::exists($sentinelUser));
           return 1;
       } else {
        return 0;
       }*/

       //  2nd condition which from you can work
       if ($sentinelUser) {
           $reminder = Reminder::where('user_id', $user->id)->first();
           if ($resetCode == $reminder->code) {
               return view('authentication.reset-password');
           } else {
            return redirect('/');
           }
       } 
    }

    public function postResetPassword(Request $request, $email, $resetCode)
    {
      $this->validate($request, [
          'password' => 'confirmed|required|min:5|max:10',
          'password_confirmation' => 'required|min:5|max:10'
        ]);
      $user = User::whereEmail($email)->first();
        $sentinelUser = Sentinel::findById($user->id);

        if(!$user){
            abort(404);
        }   

       if ($sentinelUser) {
           $reminder = Reminder::where('user_id', $user->id)->first();
           if ($resetCode == $reminder->code) {
              Reminder::complete($sentinelUser, $resetCode, $request->password);
              return redirect('/login')->with('success', 'Please login with your new password.');
           } else {
            return redirect('/');
           }
       } 
    }

    private function sendEmail($user, $code)
    {
        Mail::send('emails.forgot-password',[
                'user' => $user,
                'code' => $code
            ], function($message) use ($user) {
                $message->to($user->email);

                $message->subject("Hello $user->first_name,
                        reset your password.");

            });
    }
}
