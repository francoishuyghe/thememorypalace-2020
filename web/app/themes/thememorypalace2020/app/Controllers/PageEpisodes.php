<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class PageEpisodes extends Controller
{

    public function episodes() {
	    $args = array(
	    	'post_type' => 'post',
			'posts_per_page' => -1,
			'cat' => 249,
			'post_status' => 'publish'
	    );
	    $the_query = new WP_Query( $args );
	    return $the_query->posts;
	}
}
