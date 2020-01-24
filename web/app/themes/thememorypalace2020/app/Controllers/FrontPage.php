<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class FrontPage extends Controller
{

    public function latest_episodes() {
	    $args = array(
	    	'post_type' => 'post',
	    	//'orderby'	=> 'rand',
	    	'posts_per_page' => 4,
	    );
	    $the_query = new WP_Query( $args );
	    return $the_query->posts;
	}
}