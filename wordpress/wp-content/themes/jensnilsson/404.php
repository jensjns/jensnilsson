<?php
    /**
     * Template Name: 404
     */

    $public_data = apply_filters( 'page-filter', $post );
    apply_filters( 'apply-main-menu', $public_data );
    apply_filters( 'apply-site-settings', $public_data );
    $public_data->template = '404';
    send_json($public_data);
