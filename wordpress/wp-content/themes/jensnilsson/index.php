<?php

    $public_data = new stdClass();
    $public_data->template = 'index';
 	$public_data->posts = array();

    if (have_posts()) {
        while ( have_posts() ) {
            the_post();
            //setup_postdata( $post );
            $public_post = apply_filters( 'post-filter', $post );
            array_push($public_data->posts, $public_post);
        }

        $data = new stdClass();
        $data->nextUrl = get_next_posts_link();
        $data->prevUrl = get_previous_posts_link();
    }

    apply_filters( 'apply-main-menu', $public_data );
    apply_filters( 'apply-site-settings', $public_data );

    send_json($public_data);
