<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PixiController extends Controller
{
    public function index() {
    	$fonts = Storage::disk('public')->files('fonts');
    	$fontNames = [];

    	foreach($fonts as $font) {
    		$font = preg_split('/[.\/-]/' , $font);
    		$fontNames[] = strtolower($font[1]);
    	}
    	return view('pages.home', compact('fontNames'));
    }

    public function upload(Request $request) {
    	$file = $request->file('font');
    	$fileName = $request->file('font')->getClientOriginalName();

    	// $request->file('font')->store('fonts');

    	$file->storeAs('fonts', $fileName, 'public');
    	return back();
    }
}
