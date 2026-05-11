<?php
/**
 * Register Artists Custom Post Type, Taxonomy, and ACF Fields
 */

function spinunderground_register_artist_cpt() {
    $labels = array(
        'name'                  => _x( 'Artists', 'Post Type General Name', 'spinunderground' ),
        'singular_name'         => _x( 'Artist', 'Post Type Singular Name', 'spinunderground' ),
        'menu_name'             => __( 'Artists', 'spinunderground' ),
        'name_admin_bar'        => __( 'Artist', 'spinunderground' ),
        'archives'              => __( 'Artist Archives', 'spinunderground' ),
        'attributes'            => __( 'Artist Attributes', 'spinunderground' ),
        'parent_item_colon'     => __( 'Parent Artist:', 'spinunderground' ),
        'all_items'             => __( 'All Artists', 'spinunderground' ),
        'add_new_item'          => __( 'Add New Artist', 'spinunderground' ),
        'add_new'               => __( 'Add New', 'spinunderground' ),
        'new_item'              => __( 'New Artist', 'spinunderground' ),
        'edit_item'             => __( 'Edit Artist', 'spinunderground' ),
        'update_item'           => __( 'Update Artist', 'spinunderground' ),
        'view_item'             => __( 'View Artist', 'spinunderground' ),
        'view_items'            => __( 'View Artists', 'spinunderground' ),
        'search_items'          => __( 'Search Artist', 'spinunderground' ),
        'not_found'             => __( 'Not found', 'spinunderground' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'spinunderground' ),
        'featured_image'        => __( 'Featured Image', 'spinunderground' ),
        'set_featured_image'    => __( 'Set featured image', 'spinunderground' ),
        'remove_featured_image' => __( 'Remove featured image', 'spinunderground' ),
        'use_featured_image'    => __( 'Use as featured image', 'spinunderground' ),
        'insert_into_item'      => __( 'Insert into artist', 'spinunderground' ),
        'uploaded_to_this_item' => __( 'Uploaded to this artist', 'spinunderground' ),
        'items_list'            => __( 'Artists list', 'spinunderground' ),
        'items_list_navigation' => __( 'Artists list navigation', 'spinunderground' ),
        'filter_items_list'     => __( 'Filter artists list', 'spinunderground' ),
    );
    $args = array(
        'label'                 => __( 'Artist', 'spinunderground' ),
        'description'           => __( 'Artists and Producers', 'spinunderground' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true, // Enables Gutenberg editor
    );
    register_post_type( 'artist', $args );
}
add_action( 'init', 'spinunderground_register_artist_cpt', 0 );

function spinunderground_register_artist_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Genres', 'Taxonomy General Name', 'spinunderground' ),
        'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'spinunderground' ),
        'menu_name'                  => __( 'Genres', 'spinunderground' ),
        'all_items'                  => __( 'All Genres', 'spinunderground' ),
        'parent_item'                => __( 'Parent Genre', 'spinunderground' ),
        'parent_item_colon'          => __( 'Parent Genre:', 'spinunderground' ),
        'new_item_name'              => __( 'New Genre Name', 'spinunderground' ),
        'add_new_item'               => __( 'Add New Genre', 'spinunderground' ),
        'edit_item'                  => __( 'Edit Genre', 'spinunderground' ),
        'update_item'                => __( 'Update Genre', 'spinunderground' ),
        'view_item'                  => __( 'View Genre', 'spinunderground' ),
        'separate_items_with_commas' => __( 'Separate genres with commas', 'spinunderground' ),
        'add_or_remove_items'        => __( 'Add or remove genres', 'spinunderground' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'spinunderground' ),
        'popular_items'              => __( 'Popular Genres', 'spinunderground' ),
        'search_items'               => __( 'Search Genres', 'spinunderground' ),
        'not_found'                  => __( 'Not Found', 'spinunderground' ),
        'no_terms'                   => __( 'No genres', 'spinunderground' ),
        'items_list'                 => __( 'Genres list', 'spinunderground' ),
        'items_list_navigation'      => __( 'Genres list navigation', 'spinunderground' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'artist_genre', array( 'artist' ), $args );
}
add_action( 'init', 'spinunderground_register_artist_taxonomy', 0 );

/**
 * Register ACF Fields for Artists
 */
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_artist_details',
        'title' => 'Artist Details',
        'fields' => array(
            array(
                'key' => 'field_artist_general_tab',
                'label' => 'General Info',
                'name' => '',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_artist_producer_name',
                'label' => 'Real Name / Producer Name',
                'name' => 'producer_name',
                'type' => 'text',
                'instructions' => 'Enter the real name of the producer if different from the stage name.',
            ),
            array(
                'key' => 'field_artist_photo',
                'label' => 'Additional Photo',
                'name' => 'artist_photo',
                'type' => 'image',
                'instructions' => 'You can also use the standard WordPress Featured Image for the main photo.',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_artist_booking_email',
                'label' => 'Booking Email',
                'name' => 'booking_email',
                'type' => 'email',
            ),
            array(
                'key' => 'field_artist_socials_tab',
                'label' => 'Social Media',
                'name' => '',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_artist_instagram',
                'label' => 'Instagram URL',
                'name' => 'instagram_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_artist_facebook',
                'label' => 'Facebook URL',
                'name' => 'facebook_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_artist_youtube',
                'label' => 'YouTube URL',
                'name' => 'youtube_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_artist_soundcloud',
                'label' => 'SoundCloud URL',
                'name' => 'soundcloud_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_artist_streaming_tab',
                'label' => 'Streaming',
                'name' => '',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_artist_spotify',
                'label' => 'Spotify URL',
                'name' => 'spotify_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_artist_deezer',
                'label' => 'Deezer URL',
                'name' => 'deezer_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_artist_amazon',
                'label' => 'Amazon Music URL',
                'name' => 'amazon_music_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_artist_stores_tab',
                'label' => 'MP3 Stores',
                'name' => '',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_artist_beatport',
                'label' => 'Beatport URL',
                'name' => 'beatport_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_artist_traxsource',
                'label' => 'Traxsource URL',
                'name' => 'traxsource_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_artist_juno',
                'label' => 'Juno Download URL',
                'name' => 'juno_download_url',
                'type' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'artist',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
    
endif;
