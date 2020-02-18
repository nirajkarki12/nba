<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Service;

class ServiceController extends Controller
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
        $services = Service::paginate($perPage = 25);
        return view('admin.service.list', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
                   'title' => 'required|max:255',
                   'detail' => 'required',
                )
            );
       
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            $service = Service::create($request->all());
            if(!$service) throw new \Exception("Error Processing Request", 1);
           
            return back()->with('flash_success', 'Service added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput();
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
            
            if(!$service = Service::find($id)) throw new \Exception("Record(s) not found", 1);

            return view('admin.service.edit', compact('service'));
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
                   'title' => 'required|max:255',
                   'detail' => 'required',
                )
            );
       
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!Service::whereId($id)->update($request->except('_token'))) throw new \Exception("Error Processing Request", 1);
           
            return redirect()->route('admin.service')->with('flash_success', 'Service updated Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput();
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
            if(!$id) throw new \Exception("Service not found", 1);
            
            if(!Service::destroy($id)) throw new \Exception("Error Processing Request", 1);
            
            return back()->with('flash_success', 'Service Deleted Successfully');
               
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}
