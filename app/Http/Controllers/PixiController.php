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
    	$fileName = $request->file('font')->getClientOriginalName();
    	$file->storeAs('fonts', $fileName, 'public');
  		return $this->getStoredFonts();
    }

    public function getStoredFonts() {
    	$getFonts = Storage::disk('public')->files('fonts');
    	$fonts = [];
    	$paths = [];

    	foreach($getFonts as $font) {
    		$paths[] =  $font;
    		$font = preg_split('/[.\/-]/' , $font);
    		$fonts[] = preg_replace('/([a-z])([A-Z 1-9])/s','$1 $2', $font[1]);
    		
    	}
    	return array_combine($paths, $fonts);
    }

    public function pdfTestView($text, $image) {
    	$textData = [];
    	$imageData = [];

    	$textData[] = $this->parseStringQuery($text);
		$imageData[] = $this->parseStringQuery($image);

		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML(View('pages.pdf-view', 
            [
                'textData' => $textData[0], 
                'imageData' => $imageData[0]
            ])->render());
		return $pdf->stream();
    }

    public function parseStringQuery($queryString) {
    	$data = [];
    	foreach(explode("&", $queryString) as $i) {
    		foreach(preg_split('/[=]/' , $i) as $d) {
    			$data[explode('=', $i)[0]] = $d;
    		}
    	}
    	return $data;
    }

}
