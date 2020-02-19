<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Hash;
use App\Settings;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = Settings::where('key', 'news')->firstOrFail();

        return view('admin.dashboard', compact('news'));
    }

    public function profile() {
        $admin = User::first();
        return view('admin.profile')->with('admin' , $admin)->withPage('profile')->with('sub_page','');
    }

    public function profileSave(Request $request) {

        $validator = Validator::make( $request->all(),array(
                'name' => 'max:255',
                'email' => 'email|max:255',
                'id' => 'required|exists:users,id'
            )
        );
        
        if($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            return back()->with('flash_errors', $error_messages);
        } else {
            
            $admin = User::find($request->id);
            
            $admin->name = $request->has('name') ? $request->name : $admin->name;

            $admin->email = $request->has('email') ? $request->email : $admin->email;

            $admin->save();

            return back()->with('flash_success', 'Profile updated Successfully');
        }
    
    }

    public function changePassword(Request $request) {

        $old_password = $request->old_password;
        $new_password = $request->password;
        $confirm_password = $request->confirm_password;
        
        $validator = Validator::make($request->all(), [              
                'password' => 'required|min:6',
                'old_password' => 'required',
                'confirm_password' => 'required|min:6',
                'id' => 'required|exists:users,id'
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('flash_errors', $error_messages);

        } else {

            $admin = User::find($request->id);

            if(Hash::check($old_password,$admin->password))
            {
                $admin->password = Hash::make($new_password);
                $admin->save();

                return back()->with('flash_success', "Password Changed successfully");
                
            } else {
                return back()->with('flash_error', "Pasword is mismatched");
            }
        }

        $response = response()->json($response_array,$response_code);

        return $response;
    }

    public function updateNews(Request $request)
    {
        try {
            $validator = Validator::make( $request->all(), array(
                   'news' => 'required',
                )
            );
       
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$news = Settings::where('key', 'news')->firstOrFail()) throw new \Exception("News not found", 1);

            $news->value = $request->news;
            $news->save();
           
            return redirect()->route('admin.dashboard')->with('flash_success', 'Scrolling News updated Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput();
        }

    }
}
