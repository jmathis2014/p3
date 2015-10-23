<?php
namespace App\Http\Controllers;

use View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UsersController extends BaseController {

	public function showPost() {
		if((isset($_POST['Size'])) && ($_POST['Size'] > 0) && ($_POST['Size'] <= 10)) 
			return View::make('users')->with('users', $this->getUsers($_POST['Size']));
		else 
			return View::make('users')->with('users', 'Please choose a value between 1 - 10');
	}

	public function getUsers($size) {

		// set constant variable //
		$max_users = 317;

		// check and load users database //
        	if($users_list = file('users.db')) {

                	// init random users variable //
                	$random_users = "";

			// create our random user string for view //
                	for($i = 0; $i < $size; $i++) {

				// get random number for index into database //
                        	$rand = rand(1, $max_users);
				// index into database with random number //
                        	$user = $users_list[$rand];

				// add user name to string //
				$random_users .= "<b><u>Username:</u></b><br>";
				$random_users .= chop($user, "\n") . "<br>";

				// check for birthday //
				if(isset($_POST['date']))
					// add birthday into our string // 
					$random_users .= $this->getDate();

                                // check for profile //
                                if(isset($_POST['profile']))
                                        // add profile into our string // 
                                        $random_users .= $this->getProfile();

                                // check for password //
                                if(isset($_POST['password']))
                                        // add password into our string // 
                                        $random_users .= $this->getPassword();

				// add linefeed //
				$random_users .= "<br>"; 
                	}

			// return random user string //
			return $random_users;
		}

		// return error message //
		return "Error: could not open users database!\n";

	}

	public function getDate() {

		// set constant variables //
                $max_month = 12;
                $max_day = 7;
                $max_year = 90;

		// return birthday as a string for view //
		return (1958 + rand(1, $max_year)) . "-" . (rand(1, $max_month)) . "-" . (rand(1, $max_day)) . "<br>";		
	}

	public function getProfile() {
		// return ipsum string //
		$url = "http://www.lipsum.com/feed/xml?amount=8&what=words&start=0";
                return simplexml_load_file($url)->lipsum . "<br>";

	}

	public function getPassword() {

		$pwd_size = 5;

	        // check if dictonary file, and load //
        	if($words = file('words.db')) {

                        $max_words = count($words) - 1;

                	// password //
                	$password = "";

                	// symbols arrays //
                	$symbols = ["!", "@", "#", "$", "%", "&", "*"];

                	// numbers array //
                	$numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

			// loop for password size //			
                	for($i = 0; $i < $pwd_size; $i++) {

				// random generator for switches //
				$num_switch = rand(0, 1);
				$sym_switch = rand(0, 1);
				$cap_switch = rand(0, 1);

				// get max word count //
                        	$max = count($words) - 1;

				// get random index based on size of words //
                        	$rand = rand(0, $max_words);
	
				// index into words table & chop linefeeds //
                        	$word = chop($words[$rand], "\n");

				// test which switches was set //
				if($cap_switch)
					$word = ucwords($word);

                                if($num_switch)  
                                        $word .= $numbers[rand(0, 9)];

                                if($sym_switch)
                                        $word = $symbols[rand(0, 6)] . $word;

				// set password value //
				$password .= $word;

				// add x amount of dashes based on size //
				if($i != ($pwd_size - 1))
                                        $password .= "-";

			}
			// return password //
			return $password .= "<br>";
		}

	}

}
