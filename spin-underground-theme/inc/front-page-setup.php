<?php
/**
 * Register ACF Fields for Front Page
 */

if( function_exists('acf_add_local_field_group') ):

    $front_page_fields = array(
        array(
            'key' => 'field_fp_about_tab',
            'label' => 'About Us',
            'name' => '',
            'type' => 'tab',
        ),
        array(
            'key' => 'field_fp_about_us_text',
            'label' => 'About Us Text',
            'name' => 'about_us_text',
            'type' => 'wysiwyg',
            'toolbar' => 'full',
            'media_upload' => 0,
        ),
        array(
            'key' => 'field_fp_releases_tab',
            'label' => 'Featured Releases',
            'name' => '',
            'type' => 'tab',
        ),
    );

    // Generate 6 sets of release fields
    for ( $i = 1; $i <= 6; $i++ ) {
        $front_page_fields[] = array(
            'key' => 'field_fp_release_' . $i . '_image',
            'label' => 'Release ' . $i . ' Image',
            'name' => 'release_' . $i . '_image',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'wrapper' => array('width' => '33'),
        );
        $front_page_fields[] = array(
            'key' => 'field_fp_release_' . $i . '_title',
            'label' => 'Release ' . $i . ' Title',
            'name' => 'release_' . $i . '_title',
            'type' => 'text',
            'wrapper' => array('width' => '33'),
        );
        $front_page_fields[] = array(
            'key' => 'field_fp_release_' . $i . '_link',
            'label' => 'Release ' . $i . ' Beatport Link',
            'name' => 'release_' . $i . '_link',
            'type' => 'url',
            'wrapper' => array('width' => '33'),
        );
    }

    $front_page_fields[] = array(
        'key' => 'field_fp_videos_tab',
        'label' => 'Latest YouTube Videos',
        'name' => '',
        'type' => 'tab',
    );

    // Generate 6 sets of video fields
    for ( $i = 1; $i <= 6; $i++ ) {
        $front_page_fields[] = array(
            'key' => 'field_fp_video_' . $i . '_embed',
            'label' => 'Video ' . $i . ' YouTube URL',
            'name' => 'video_' . $i . '_embed',
            'type' => 'oembed',
            'instructions' => 'Paste the YouTube video URL here.',
            'wrapper' => array('width' => '50'),
        );
        $front_page_fields[] = array(
            'key' => 'field_fp_video_' . $i . '_title',
            'label' => 'Video ' . $i . ' Title',
            'name' => 'video_' . $i . '_title',
            'type' => 'text',
            'wrapper' => array('width' => '50'),
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_front_page',
        'title' => 'Front Page Content',
        'fields' => $front_page_fields,
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'front-page.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'the_content',
        ),
        'active' => true,
        'description' => '',
    ));

endif;
