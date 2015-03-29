<?php

    $public_data = apply_filters( 'post-filter', $post );
    apply_filters( 'apply-main-menu', $public_data );
    apply_filters( 'apply-site-settings', $public_data );
    send_json($public_data);
