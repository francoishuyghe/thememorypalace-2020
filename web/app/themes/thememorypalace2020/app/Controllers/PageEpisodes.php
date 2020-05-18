<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class PageEpisodes extends Controller
{

    public function episodes() {
	    $args = array(
	    	'post_type' => 'post',
	    	//'orderby'	=> 'rand',
			'posts_per_page' => -1,
			'category_name' => 'episodes',
			'post_status' => 'publish'
	    );
	    $the_query = new WP_Query( $args );
	    return $the_query->posts;
	}
}
