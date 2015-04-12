<?php

    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    $public_data = get_full_author_profile($curauth->ID);
    $public_data->template = 'author';

    apply_filters( 'apply-main-menu', $public_data );
    apply_filters( 'apply-site-settings', $public_data );
    apply_filters( 'apply-page-meta', $public_data);
    send_json($public_data);
