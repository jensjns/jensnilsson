<?php

    query_posts($query_string . "&posts_per_page=-1");

    header("content-type: application/json");

    $data = new stdclass();
    $data->module = 'projects';
    $data->title = "Projekt"; // This should not be hard types but will do for now / Camilo
    $data->amount = 0;
    $data->list = array();

    if (have_posts()) {

        while (have_posts()) {
            the_post();
            $project = new stdclass();
            $project->post_title = $post->post_title;
            $project->post_title = $post->post_title;
            $project->permalink = get_permalink($post->ID);
            $project->usp = get_field( 'usp' );
            $project->project_list_title = get_field('project_list_title');
            $project->images = get_field('images');
            $project->tags = wp_get_post_tags();

            $data->amount++;
            array_push($data->list, $project);
        }

        $data->next_url = get_next_posts_link();
        $data->prev_url = get_previous_posts_link();

    }

    $data->menu = get_menu_json('main');
    apply_filters( 'apply-page-meta', $data );

    send_json($data);
