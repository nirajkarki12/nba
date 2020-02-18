<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Notice;
use App\Service;
use App\Staff;

class FrontController extends Controller
{
		
	public function __construct() {
		//
	}

   public function index() {

      $staffs = Staff::orderBy('created_at', 'asc')
                     ->get();
      $videos = Video::pluck('videoId');
      $notices = Notice::orderBy('created_at', 'desc')
      					->get();
      $services = Service::orderBy('created_at', 'asc')
                  ->get();

   	return view('home', compact('staffs', 'videos', 'notices', 'services'));
   }

   public function getVideos() {
      $videos = Video::pluck('videoId');
      return response()->json(['success' => true, 'videos' => $videos]);
   }

   public function serviceDetail(Request $request) {
      $service = Service::find($request->id);
      if(!$service) return response()->json(['success' => false]);

      return view('modals.service-detail', compact('service'));
   }

}
