<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        /*Valadation */
       $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|string|email|max:255',
        'password'=>'required'],
    
    [
        'name.required'=> 'please Enter Name',
        'email.required'=> 'please Enter Email',
        'password.required'=> 'please Enter Password',
        

    ]);
    if ($validator ->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ]);
    }
    /*./Valadation */ 
    else 
    {
        $user=User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt(value:$request->password)
          ]);
    
         $token= $user->createToken('auth_token')->plainTextToken;
    
         return response()->json([
            'status' => 200,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    }

    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'email' => 'required|string|email',
            'password'=>'required',
 
       
        ],
        [
          
            'email.required'=> 'please Enter Email',
        'password.required'=> 'please Enter Password',
            
 
        ]);
        if ($validator->fails()) {
            $response=[
                'status' => 'error',
                'errors' => $validator->errors(),
                
            ];
            return response()->json($response,400);
        }


        if(!$token=Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return response()->json(data:[
                'status' => '401',
                'message' => 'Uanthorized',


            ]);
        }
        else {
            $user=$request->user();
        $token= $user->createToken('auth_token')->plainTextToken;
        return response()->json(data:[
            'status' => 200,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => "تم الدخول بنجاح",
        ]);

        }
        



    }


    public function logout(Request $request)
    {
      //  $request->user()->currentAccessToken()->delete();
        $request->user()->tokens()->delete();
   
      
        return response()->json(data:[
            'status' => 200,
            'message' => 'Tokens Revoked',
        ]);


    }

    public function resetPassword(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'email' => 'required|string|email',
                 
        ],
        [
 
            'email.required'=> 'please Enter Email',
      
            
 
        ]);
        if ($validator->fails()) {
            $response=[
               // 'status' => 'error',
                'errors' => $validator->errors(),
                'message' => 'invaild email format',
                
            ];
            return response()->json($response,400);
        }
        $user=User::where('email',$request->email)->first();// التحقق من الاميل موجود 

        if(!$user){
            return response()->json([
              'message'=>'we cant find a user with that e-mail address.',
            ]);
        }
        
            $token= $user->createToken('auth_token')->plainTextToken;//نأخذ التوكن 
            $to_email=$request->email;
            $subject='Reset Password Natification';
            $from_email='app@gmail.com';
            $name=$user->name;
            $data=array('name'=>$name,'token'=>$token);
            Mail::send(view:'emails.mail',data:$data,callback:function ($message) use($to_email,$subject,$from_email)
            {    $message->to($to_email)->subject($subject);
                $message->from($from_email);
               
            });
            return response()->json(data:[
                'status' => 200,
                'message' => 'email sent',
            ]);

       


    }

    // get UserName
    public function user(Request $request)
    {
        $user=$request->user();
        return response()->json(data:[
            'status' => 200,
            'user' =>$user
            
        ]);
        

        



    }

    public function UserUpdate(Request $request)
    {
       
   
        $id=$request->user()->id;
         /*Valadation */
       $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|string|email|max:255',
         Rule::unique('users')->ignore($id,'id'),
    ],
    
    [
        'name.required'=> 'please Enter Name',
     'email.required'=> 'please Enter Email',
               

    ]);
    if ($validator ->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ]);
    }

        $user=User::find($id)->update([
            'name' =>$request->name,
            'email'=>$request->email,
           
        ]);
        
    
         return response()->json([
            'status' => 200,
             'message' => 'user update',
        ]);
    }

   


}
