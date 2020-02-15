<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Video;

class VideoController extends Controller
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
        $videos = Video::paginate($perPage = 25);
        return view('admin.video.list', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
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
                   'url' => 'url',
                   'videoId' => 'required|unique:videos',
                )
            );
       
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            $video = Video::create($request->all());
            if(!$video) throw new \Exception("Error Processing Request", 1);
           
            return back()->with('flash_success', 'Video added Successfully');

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
            
            if(!$video = Video::find($id)) throw new \Exception("Record(s) not found", 1);

            return view('admin.video.edit', compact('video'));
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
                   'url' => 'url',
                   'videoId' => 'required|unique:videos,videoId, '.$id,
                )
            );
       
            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!Video::whereId($id)->update($request->except('_token'))) throw new \Exception("Error Processing Request", 1);
           
            return redirect()->route('admin.video')->with('flash_success', 'Video updated Successfully');

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
            if(!$id) throw new \Exception("Video not found", 1);
            
            if(!Video::destroy($id)) throw new \Exception("Error Processing Request", 1);
            
            return back()->with('flash_success', 'Video Deleted Successfully');
               
        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}
