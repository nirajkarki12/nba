<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Notice;
use App\Service;
use App\Staff;
use App\Settings;

class FrontController extends Controller
{
		
	public function __construct() {
		//
	}

   public function index() {

      $staffs1 = Staff::where('employee_type', '1')
                  ->orderBy('created_at', 'asc')
                  ->get();
      $staffs2 = Staff::where('employee_type', '2')
                  ->orderBy('created_at', 'asc')
                  ->get();
      $staffs3 = Staff::where('employee_type', '3')
                  ->orderBy('created_at', 'asc')
                  ->get();
      $staffs = Staff::orderBy('created_at', 'asc')
                  ->get();
      $videos = Video::pluck('videoId');
      $notices = Notice::orderBy('created_at', 'desc')
      					->get();
      $services = Service::orderBy('created_at', 'asc')
                  ->get();

      $news = Settings::where('key', 'news')->firstOrFail();

   	return view('home', compact('staffs1', 'staffs2', 'staffs3', 'staffs', 'news', 'videos', 'notices', 'services'));
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
