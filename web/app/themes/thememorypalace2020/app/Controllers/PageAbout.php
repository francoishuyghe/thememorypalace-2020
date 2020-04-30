<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class PageAbout extends Controller
{

    public function data() {
		$data['intro'] = get_field('intro');
		$data['links'] = get_field('links');
		
	    return $data;
	}
}
