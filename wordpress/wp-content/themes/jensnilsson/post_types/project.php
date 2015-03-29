<?php

    $labels = array(
        'name'                => 'Projects',
        'singular_name'       => 'Project',
        'menu_name'           => 'Projects',
        'parent_item_colon'   => 'Parent project:',
        'all_items'           => 'All Projects',
        'view_item'           => 'View project',
        'add_new_item'        => 'Add New project',
        'add_new'             => 'New project',
        'edit_item'           => 'Edit project',
        'update_item'         => 'Update project',
        'search_items'        => 'Search projects',
        'not_found'           => 'No projects found',
        'not_found_in_trash'  => 'No projects found in Trash'
    );

    $args = array(
        'label'               => 'project',
        'description'         => 'project information',
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
        'rewrite' => array( 'slug' => 'project' ),
    );

    register_post_type( 'project', $args );
