<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Validator;
use App\Staff;

class StaffController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::paginate($perPage = 25);
        return view('admin.staff.list', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make( $request->all(), array(
                   'name' => 'required|max:255',
                   'designation' => 'required|max:255',
                   'section' => 'required|max:255',
                   'phone' => 'required|max:255',
                   'email' => 'max:255',
                   'room_no' => 'required|max:255',
                    'file' => 'mimes:jpeg,jpg,png',
                )
            );
       
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$file = Helper::uploadImage($request->file('file'), 'staff')) throw new \Exception("Cannot upload photo", 1);

            $request->request->add(['photo' => $file]);

            if(!Staff::create($request->all())) {
                throw new \Exception("Something Went Wrong, Try Again!", 1);
            }

            return back()->with('flash_success', 'Staff added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($request->except('file'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            if(!$id) throw new \Exception("Error Processing Request", 1);
            
            if(!$staff = Staff::find($id)) throw new \Exception("Record(s) not found", 1);

            return view('admin.staff.edit', compact('staff'));
         } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make( $request->all(), array(
                   'name' => 'required|max:255',
                   'designation' => 'required|max:255',
                   'section' => 'required|max:255',
                   'phone' => 'required|max:255',
                   'email' => 'max:255',
                   'room_no' => 'required|max:255',
                    'file' => 'mimes:jpeg,jpg,png',
                )
            );
       
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$staff = Staff::find($id)) throw new \Exception("Staff not found", 1);
            $data = [
                'name' => $request->name,
                'designation' => $request->designation,
                'section' => $request->section,
                'phone' => $request->phone,
                'email' => $request->email,
                'room_no' => $request->room_no,
            ];
            
            if($request->file('file'))
            {
                $file = Helper::uploadImage($request->file('file'), 'staff');
                Helper::deleteImage($staff->photo, 'staff');
                $data['photo'] = $file;
            }

            if(!$staff->update($data)) throw new \Exception("Error Processing Request", 1);
           
            return redirect()->route('admin.staff')->with('flash_success', 'Staff updated Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($request->except('file'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(!$id) throw new \Exception("Staff not found", 1);

            if(!$staff = Staff::find($id)) throw new \Exception("Staff not found", 1);
            Helper::deleteImage($staff->photo, 'staff');

            if(!$staff::destroy($id)) throw new \Exception("Error Processing Request", 1);
            
            return back()->with('flash_success', 'Staff Deleted Successfully');
               
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}
