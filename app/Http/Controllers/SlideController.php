<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    //
    public function getDanhSach()
    {
    	$slide=Slide::all();
    	return view('admin.slide.danhsach',['slide'=>$slide]);
    }
    public function getThem()
    {
    	return view('admin.slide.them');
    }
    public function postThem()
    {
    		
    }
}
