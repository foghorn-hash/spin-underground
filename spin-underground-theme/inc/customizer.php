<?php
/**
 * Spin Underground Theme Customizer
 */

function spinunderground_customize_register( $wp_customize ) {

    // Front Page Hero Section
    $wp_customize->add_section( 'spinunderground_front_page_hero', array(
        'title'       => __( 'Front Page Hero', 'spinunderground' ),
        'priority'    => 25,
        'description' => __( 'Edit the hero heading, subtitle, and button text displayed on the front page.', 'spinunderground' ),
    ) );

    $wp_customize->add_setting( 'hero_title', array(
        'default'           => 'Feel the Underground Vibe',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_title', array(
        'label'    => __( 'Hero Title', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_hero',
        'settings' => 'hero_title',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_subtitle', array(
        'default'           => 'Cutting-edge techno & house from the heart of Finland.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_subtitle', array(
        'label'    => __( 'Hero Subtitle', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_hero',
        'settings' => 'hero_subtitle',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'hero_button_text', array(
        'default'           => 'Latest Releases',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hero_button_text', array(
        'label'    => __( 'Hero Button Text', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_hero',
        'settings' => 'hero_button_text',
        'type'     => 'text',
    ) );

    // Front Page Releases & Store Section
    $wp_customize->add_section( 'spinunderground_front_page_releases', array(
        'title'       => __( 'Front Page Releases & Store', 'spinunderground' ),
        'priority'    => 28,
        'description' => __( 'Customize the WooCommerce releases showcase on the front page.', 'spinunderground' ),
    ) );

    $wp_customize->add_setting( 'release_section_badge', array(
        'default'           => 'OFFICIAL LABEL RELEASES',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'release_section_badge', array(
        'label'    => __( 'Releases Section Badge', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_releases',
        'settings' => 'release_section_badge',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'release_section_title', array(
        'default'           => 'Releases & Label Store',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'release_section_title', array(
        'label'    => __( 'Releases Section Title', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_releases',
        'settings' => 'release_section_title',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'release_section_subtitle', array(
        'default'           => 'Exclusive heavyweight 12" vinyl pressings, lossless 24-bit digital masters & underground gear.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'release_section_subtitle', array(
        'label'    => __( 'Releases Section Subtitle', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_releases',
        'settings' => 'release_section_subtitle',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'release_products_count', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'release_products_count', array(
        'label'    => __( 'Number of Releases to Display', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_releases',
        'settings' => 'release_products_count',
        'type'     => 'number',
    ) );

    $wp_customize->add_setting( 'release_shop_btn_text', array(
        'default'           => 'Explore Full Record Store',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'release_shop_btn_text', array(
        'label'    => __( 'Shop Button Text', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_releases',
        'settings' => 'release_shop_btn_text',
        'type'     => 'text',
    ) );

    // Front Page Videos Section
    $wp_customize->add_section( 'spinunderground_front_page_videos', array(
        'title'       => __( 'Front Page Videos', 'spinunderground' ),
        'priority'    => 30,
        'description' => __( 'Change the YouTube embed URLs and section titles for the Front Page.', 'spinunderground' ),
    ) );

    $wp_customize->add_setting( 'video_section_title', array(
        'default'           => 'Latest YouTube Videos',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'video_section_title', array(
        'label'    => __( 'Video Section Title', 'spinunderground' ),
        'section'  => 'spinunderground_front_page_videos',
        'settings' => 'video_section_title',
        'type'     => 'text',
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
