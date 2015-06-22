<?php

    $labels = array(
        'name'                => 'How-to',
        'singular_name'       => 'How-tos',
        'menu_name'           => 'How-tos',
        'parent_item_colon'   => 'Parent how-to:',
        'all_items'           => 'All How-tos',
        'view_item'           => 'View how-to',
        'add_new_item'        => 'Add New how-to',
        'add_new'             => 'New how-to',
        'edit_item'           => 'Edit how-to',
        'update_item'         => 'Update how-to',
        'search_items'        => 'Search how-to',
        'not_found'           => 'No how-tos found',
        'not_found_in_trash'  => 'No how-tos found in Trash'
    );

    $args = array(
        'label'               => 'how-to',
        'description'         => 'how-to information',
        'labels'              => $labels,
        'supports'            => array(),
        'taxonomies'          => array('post_tag'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'rewrite' => array( 'slug' => 'how-to' ),
    );

    register_post_type( 'how-to', $args );
