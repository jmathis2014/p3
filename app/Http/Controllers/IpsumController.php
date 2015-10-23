<?php
namespace App\Http\Controllers;

use View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IpsumController extends BaseController {

	// check f0r errors //
	public function showPost() {
		if((isset($_POST['Size'])) && ($_POST['Size'] > 0) && ($_POST['Size'] <= 99)) 
			return View::make('ipsum')->with('ipsum', $this->getIpsum($_POST['Size']));
		else 
			return View::make('ipsum')->with('ipsum', 'Please choose a value between 1 - 99');
	}

	// Get ipsum text function //
	public function getIpsum($size) {

		// ipsum web generator URL //
		$url = "http://www.lipsum.com/feed/xml?amount=1&what=paras&start=0";
		
		// init ipsum variable //
		$ipsumText = "";

		// loop for selected amount //
		for($x = 0; $x < $size; $x++) {
			// get ipsum text for our URL //
			$ipsumText .= simplexml_load_file($url)->lipsum;
			// add linefeeds for next line //
			$ipsumText .= "<br><br>";
		}

		// return text to our view //
		return $ipsumText;
	}

}
