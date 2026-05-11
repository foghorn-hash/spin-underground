<?php
/**
 * Spin Underground Theme Customizer
 */

function spinunderground_customize_register( $wp_customize ) {

    // Front Page Videos Section
    $wp_customize->add_section( 'spinunderground_front_page_videos', array(
        'title'       => __( 'Front Page Videos', 'spinunderground' ),
        'priority'    => 30,
        'description' => __( 'Change the YouTube embed URLs for the top header videos on the Front Page.', 'spinunderground' ),
    ) );

    // Video 1
    $wp_customize->add_setting( 'header_video_1', array(
        'default'           => 'https://www.youtube.com/embed/kkKOJO0Hw0o?si=DLpzFNzokzy2Egh6',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'header_video_1', array(
        'label'    => __( 'Video 1 Embed URL', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_videos',
        'settings' => 'header_video_1',
        'type'     => 'url',
    ) );

    // Video 2
    $wp_customize->add_setting( 'header_video_2', array(
        'default'           => 'https://www.youtube.com/embed/aM0xpY-LgAc?si=GoYS0FUhctaGrlxI',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'header_video_2', array(
        'label'    => __( 'Video 2 Embed URL', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_videos',
        'settings' => 'header_video_2',
        'type'     => 'url',
    ) );

}
add_action( 'customize_register', 'spinunderground_customize_register' );
