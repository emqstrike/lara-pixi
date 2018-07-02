<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PixiController extends Controller
{
    public function index() {
    	$fontNames = $this->getStoredFonts();	
    	return view('pages.home', compact('fontNames'));
    }

    public function upload(Request $request) {
    	$file = $request->file('font');
    	// $fileName = $request->file('font')->getClientOriginalName();
    	// $file->storeAs('fonts', $fileName, 'public');
  		return $this->getStoredFonts();
    }

    public function getStoredFonts() {
    	$getFonts = Storage::disk('public')->files('fonts');
    	$fonts = [];

    	foreach($getFonts as $font) {
    		$font = preg_split('/[.\/-]/' , $font);
    		$fonts[] = preg_replace('/([a-z])([A-Z 1-9])/s','$1 $2', $font[1]);
    		
    	}

    	return $fonts;
    }

}
