<?php
	/**
     * Template Name: Posts
     **/

	function renderCategory($cat){
	    $args = array(
	    'numberposts' => '',
	    'offset' => 0,
	    'category'=> "$cat",
	    'orderby' => 'post_date',
	    'order' => 'DESC',
	    'post_type' => 'post',
	    'post_status' => 'publish',
	    'suppress_filters' => true );
		$posts = new stdClass();
	    $posts->posts = get_posts( $args);
	    $posts->module = 'blog';
	    $posts->menu = get_menu_json('main');
	    $allCategories = array();

	    $index = 0;
	    foreach( $posts->posts as $item ){
	    	$item->excerpt = get_field('excerpt',$item->ID);
	    	$item->index = $index;
	    	$item->img = get_field('images',$item->ID);
	    	$item->permalink = get_permalink($item->ID);

	    	$categories = get_the_category($item->ID);
	    	$item->catNames = array();
	    	$item->catId = array();
	    	foreach ($categories as $cat) {
	    		array_push($item->catNames,$cat->name);
	    		array_push($allCategories,$cat->name);
	    		array_push($item->catId,$cat->cat_ID);

	    	}

		 	$index++;
		};
		$allCategories = array_unique($allCategories);
		$posts->categories = array_values($allCategories);
		apply_filters( 'apply-page-meta', $posts );
	    send_json($posts);
	};
	renderCategory();
