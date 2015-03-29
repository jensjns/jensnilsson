<?php

function e($data, $echo = false) {
    if( $echo ) {
        echo "<pre>" . print_r($data, true) . "</pre>";
    }
    else {
        error_log(print_r($data, true));
    }
}

function send_json($data) {
    header("content-type: application/json");
    echo json_encode($data);
}

function init() {

    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page();
    }

    register_nav_menus(
        array(
          'main' => 'Main menu',
        )
    );

    include 'post_types/project.php';
}
add_action('init', 'init');

function jensnilsson_theme_setup() {
    add_image_size( 'wide', 1080, 300, true ); // cropped, wide
    add_image_size( 'square', 640, 640, true ); // cropped square
    add_image_size( '1080', 1080 ); // site width
    add_image_size( '1080.16/9', 1080, 607, true); // site width 16/9
    add_image_size( '1280', 1280); // 1280
}
add_action( 'after_setup_theme', 'jensnilsson_theme_setup' );

// Clear cache on save
function clear_node_cache( $post_id ) {
    // If this is just a revision, don't clear
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    file_get_contents(PUBLIC_URL . '/clear-cache');
}
add_action( 'save_post', 'clear_node_cache' );

function get_full_author_profile( $authorId ) {
    $author = new stdClass();

    $fields = array(
        array('display_name', 'displayName'),
    );

    $custom_fields = array(
        array('profile_image', 'profileImage')
    );

    foreach( $fields as $field ) {
        $author->$field[1] = get_the_author_meta( $field[0], $authorId );
    }

    foreach( $custom_fields as $field ) {
        $author->$field[1] = get_field( $field[0], 'user_' . $authorId );
    }

    return $author;
}

// filter post post-type
function filter_post( $post ) {
    $public_post = new stdClass();

    $public_attr = array(
        array('ID', 'id'),
        array('post_date', 'postDate'),
        array('post_date_gmt', 'postDateGMT'),
        array('post_title', 'postTitle'),
        array('post_status', 'postStatus'),
        array('post_name', 'postName'),
        array('post_modified', 'postModified'),
        array('post_modified_gmt', 'postModifiedGMT'),
        array('post_parent', 'postParent'),
        array('guid', 'guid'),
        array('post_type', 'postType'),

        array(null, 'permalink', get_permalink( $post->ID )),
        array(null, 'content', get_field( 'content', $post->ID )),
        array(null, 'contentBlocks', get_field( 'content_blocks', $post->ID )),
        array(null, 'intro', get_field( 'intro', $post->ID )),
        array(null, 'contentType', 'markdown'),
        array(null, 'heroImage', get_field( 'hero_image', $post->ID )),
        array(null, 'title', get_the_title()),
        array(null, 'author', get_full_author_profile( $post->post_author )),
        array(null, 'category', get_the_category( $post->ID )),
        array(null, 'template', 'post')
    );

    // filter down the post attributes
    foreach( $public_attr as $attr ) {
        if( $attr[0] == null ) {
            $public_post->$attr[1] = $attr[2];
        }
        else {
            $public_post->$attr[1] = $post->$attr[0];
        }
    }

    //$public_post->menu = get_menu_json('main');
    return $public_post;
}
add_filter( 'post-filter', 'filter_post', 10, 1 );

// filter project post-type
function filter_project( $post ) {
    $public_post = new stdClass();

    $public_attr = array(
        array('ID', 'id'),
        array('post_date', 'postDate'),
        array('post_date_gmt', 'postDateGMT'),
        array('post_title', 'postTitle'),
        array('post_status', 'postStatus'),
        array('post_name', 'postName'),
        array('post_modified', 'postModified'),
        array('post_modified_gmt', 'postModifiedGMT'),
        array('post_parent', 'postParent'),
        array('guid', 'guid'),
        array('post_type', 'postType'),

        array(null, 'permalink', get_permalink( $post->ID )),
        array(null, 'content', get_field( 'content', $post->ID )),
        array(null, 'contentType', 'markdown'),
        array(null, 'title', get_the_title()),
        array(null, 'author', get_full_author_profile( $post->post_author )),
        array(null, 'category', get_the_category( $post->ID )),
        array(null, 'template', 'project')
    );

    // filter down the post attributes
    foreach( $public_attr as $attr ) {
        if( $attr[0] == null ) {
            $public_post->$attr[1] = $attr[2];
        }
        else {
            $public_post->$attr[1] = $post->$attr[0];
        }
    }

    //$public_post->menu = get_menu_json('main');
    return $public_post;
}
add_filter( 'project-filter', 'filter_project', 10, 1 );

// filter pages
function filter_page( $post ) {
    $public_post = new stdClass();
    return $public_post;
}
add_filter( 'page-filter', 'filter_page', 10, 1 );


// filter for content_blocks field
function filter_content_blocks( $value, $post_id, $field ) {
    if( is_array($value) ) {
        foreach($value as $index => $block) {
            // decorate each block with a more logical name (frontend-wise) for the acf_fc_layout
            $block['blockType'] = $block['acf_fc_layout'];
            $value[$index] = $block;
        }
    }
    return $value;
}
add_filter('acf/load_value/name=content_blocks', 'filter_content_blocks', 10, 3);

/* decorates the passed obj with the main menu */
function apply_main_menu( $obj ) {
    $obj->menu = new stdClass();
    $obj->menu->data = 'hej';
}
add_filter( 'apply-main-menu', 'apply_main_menu', 10, 1 );

function apply_site_settings( $obj ) {
    $obj->siteSettings = array(
        'googleAnalytics' => get_field( 'google_analytics_tracking_code', 'options' ),
        'disqusShortname' => get_field( 'disqus_shortname', 'options' ),
        'backgroundImage' => get_field( 'background_image', 'options' ),
    );
}
add_filter( 'apply-site-settings', 'apply_site_settings', 10, 1 );
