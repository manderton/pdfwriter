<?php
use mikehaertl\pdftk\Pdf;

use Illuminate\Http\Request;
use Pdfwriter\Http\Controllers\Controller;

View::share('sitename', 'PDF Writer');

Route::get('/', function () {
    return view('form');
});

Route::post('/writer', function(Request $request)
{
	// dd($request->all());

	$ein = str_replace(["-","."], "", $request->input('ein'));

	switch ($request->input('classification')) {
		case 's-corp':
			$field = "1";
			break;
		case 'c-corp': 
			$field = "2";
			break;
		case 'partnership':
			$field = "3";
			break;
		case 'trust': 
			$field = "4";
			break;
		default:
			$field = "0";
	}
	
	$data = [
		'topmostSubform[0].Page1[0].f1_1[0]' 			=> $request->input('name'),
		'topmostSubform[0].Page1[0].f1_2[0]' 			=> $request->input('business_name'),
		'topmostSubform[0].Page1[0].Address[0].f1_7[0]' => $request->input('address'),
		'topmostSubform[0].Page1[0].Address[0].f1_8[0]' => $request->input('city_state_zip'),
		"topmostSubform[0].Page1[0].FederalClassification[0].c1_1[{$field}]" => 'On',
	];

	if ($request->has('ssn')) {
		$ssn = str_replace(["-","."], "", $request->input('ssn'));
		$ssn1 = substr($ssn, 0, 3);
		$ssn2 = substr($ssn, 3, 2);
		$ssn3 = substr($ssn, -4);	
		$data['topmostSubform[0].Page1[0].SSN[0].f1_11[0]']   = $ssn1;
		$data['topmostSubform[0].Page1[0].SSN[0].f1_12[0]']   = $ssn2;
		$data['topmostSubform[0].Page1[0].SSN[0].f1_13[0]']   = $ssn3;
	} else if ($request->has('ein')) {
		$ein = str_replace(["-","."], "", $request->input('ein'));
		$ein1 = substr($ein, 0, 2);
		$ein2 = substr($ein, -7);
		$data['topmostSubform[0].Page1[0].EmployerID[0].f1_14[0]'] = $ein1;
		$data['topmostSubform[0].Page1[0].EmployerID[0].f1_15[0]'] = $ein2;
	}

	$pdf = new Pdf(storage_path('app/fw9.pdf'));
	$filled_name = "filled_" . time() . ".pdf";
	$pdf->fillForm($data)->flatten()->saveAs(public_path($filled_name));

	return view('writer')->with('filename', $filled_name);
});
