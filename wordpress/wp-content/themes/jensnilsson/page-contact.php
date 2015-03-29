<?php

    /**
     * Template Name: Contact
     **/

    $public_data = apply_filters( 'page-filter', $post );
    apply_filters( 'apply-main-menu', $public_data );
    apply_filters( 'apply-site-settings', $public_data );
    $public_data->template = 'contact';
    send_json($public_data);
