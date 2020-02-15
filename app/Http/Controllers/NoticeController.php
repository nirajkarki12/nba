<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Validator;
use App\Notice;

class NoticeController extends Controller
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
        $notices = Notice::paginate($perPage = 25);
        return view('admin.notice.list', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notice.create');
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
                   'description' => 'required',
                    'file' => 'required|mimes:jpeg,jpg,png',
                )
            );
       
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$file = Helper::uploadImage($request->file('file'), 'notice')) throw new \Exception("Cannot upload image", 1);

            $request->request->add(['image' => $file]);

            if(!Notice::create($request->all())) throw new \Exception("Something Went Wrong, Try Again!", 1);

            return back()->with('flash_success', 'Notice added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
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
            
            if(!$notice = Notice::find($id)) throw new \Exception("Record(s) not found", 1);

            return view('admin.notice.edit', compact('notice'));
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
                   'description' => 'required',
                    'file' => 'mimes:jpeg,jpg,png',
                )
            );
       
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$notice = Notice::find($id)) throw new \Exception("Notice not found", 1);
            $data = [
                'title' => $request->title,
                'description' => $request->description
            ];
            
            if($request->file('file'))
            {
                $file = Helper::uploadImage($request->file('file'), 'notice');
                Helper::deleteImage($notice->image, 'notice');
                $data['image'] = $file;
            }

            if(!$notice->update($data)) throw new \Exception("Error Processing Request", 1);
           
            return redirect()->route('admin.notice')->with('flash_success', 'Notice updated Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
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
            if(!$id) throw new \Exception("Notice not found", 1);

            if(!$notice = Notice::find($id)) throw new \Exception("Notice not found", 1);
            Helper::deleteImage($notice->image, 'notice');

            if(!$notice::destroy($id)) throw new \Exception("Error Processing Request", 1);
            
            return back()->with('flash_success', 'Notice Deleted Successfully');
               
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}
