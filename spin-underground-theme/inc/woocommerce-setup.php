<?php
/**
 * WooCommerce Integration & Front-Page Releases Setup
 *
 * @package Spin_Underground
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Declare WooCommerce theme support
 */
function spinunderground_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'spinunderground_woocommerce_support' );

/**
 * Custom wrapper for WooCommerce pages (Shop, Single Product, Cart, Checkout)
 */
function spinunderground_wc_wrapper_start() {
    echo '<div class="woocommerce-page-inner">';
}
function spinunderground_wc_wrapper_end() {
    echo '</div>';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'spinunderground_wc_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'spinunderground_wc_wrapper_end', 10 );

/**
 * Display format badge and catalog code above product title on single product page
 */
function spinunderground_single_product_badge() {
    global $product;
    if ( ! $product ) return;

    $product_id = $product->get_id();
    $raw_format = get_post_meta( $product_id, '_spin_format', true );

    if ( empty( $raw_format ) ) {
        $search_text = strtolower( $product->get_name() );
        $terms = get_the_terms( $product_id, 'product_cat' );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) { $search_text .= ' ' . strtolower( $term->name ); }
        }
        $tag_terms = get_the_terms( $product_id, 'product_tag' );
        if ( ! empty( $tag_terms ) && ! is_wp_error( $tag_terms ) ) {
            foreach ( $tag_terms as $term ) { $search_text .= ' ' . strtolower( $term->name ); }
        }
        if ( $product->is_downloadable() ) {
            $downloads = $product->get_downloads();
            if ( ! empty( $downloads ) ) {
                foreach ( $downloads as $dl ) {
                    $search_text .= ' ' . strtolower( $dl->get_name() ) . ' ' . strtolower( $dl->get_file() );
                }
            }
        }

        if ( strpos( $search_text, 'wav' ) !== false ) {
            $raw_format = 'wav';
        } elseif ( strpos( $search_text, 'mp3' ) !== false ) {
            $raw_format = 'mp3';
        } elseif ( strpos( $search_text, 'flac' ) !== false ) {
            $raw_format = 'flac';
        } elseif ( strpos( $search_text, 'vinyl' ) !== false ) {
            $raw_format = 'vinyl';
        } elseif ( strpos( $search_text, 'bundle' ) !== false ) {
            $raw_format = 'bundle';
        } elseif ( strpos( $search_text, 'merch' ) !== false || strpos( $search_text, 'apparel' ) !== false || strpos( $search_text, 'shirt' ) !== false ) {
            $raw_format = 'merch';
        } else {
            $raw_format = 'wav';
        }
    }

    $format_labels = array(
        'wav'     => 'DIGITAL WAV',
        'mp3'     => 'DIGITAL MP3',
        'flac'    => 'DIGITAL FLAC',
        'vinyl'   => '12" VINYL',
        'bundle'  => 'VINYL + DIGITAL',
        'digital' => 'DIGITAL',
        'merch'   => 'MERCHANDISE',
    );
    $format_badge = isset( $format_labels[ $raw_format ] ) ? $format_labels[ $raw_format ] : strtoupper( $raw_format );

    $catalog = get_post_meta( $product_id, '_spin_catalog_number', true );
    if ( empty( $catalog ) ) {
        $catalog = $product->get_sku();
    }

    $artist = get_post_meta( $product_id, '_spin_artist_name', true );

    echo '<div class="single-product-top-meta">';
    echo '<span class="format-badge format-' . esc_attr( $raw_format ) . '">' . esc_html( $format_badge ) . '</span>';
    if ( ! empty( $catalog ) ) {
        echo '<span class="catalog-badge-inline">' . esc_html( $catalog ) . '</span>';
    }
    if ( ! empty( $artist ) ) {
        echo '<span class="artist-badge-inline"><i class="bi bi-disc"></i> ' . esc_html( $artist ) . '</span>';
    }
    echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'spinunderground_single_product_badge', 4 );

/**
 * Update WooCommerce cart count badge via AJAX
 */
function spinunderground_cart_count_fragments( $fragments ) {
    $count = 0;
    if ( function_exists( 'WC' ) && WC()->cart ) {
        $count = WC()->cart->get_cart_contents_count();
    }
    $fragments['span.cart-count'] = '<span class="cart-count">' . esc_html( $count ) . '</span>';
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'spinunderground_cart_count_fragments' );

/**
 * Register custom release fields in WooCommerce Product edit screen
 */
function spinunderground_add_custom_product_fields() {
    echo '<div class="options_group spinunderground-custom-product-fields">';
    echo '<p class="form-field"><strong>' . esc_html__( 'Spin Underground Release Metadata', 'spinunderground' ) . '</strong></p>';

    woocommerce_wp_text_input( array(
        'id'          => '_spin_artist_name',
        'label'       => __( 'Artist / Producer Name', 'spinunderground' ),
        'placeholder' => 'e.g. Matt Spin',
        'desc_tip'    => true,
        'description' => __( 'Enter the artist or producer name for this release.', 'spinunderground' ),
    ) );

    woocommerce_wp_text_input( array(
        'id'          => '_spin_catalog_number',
        'label'       => __( 'Catalog Number', 'spinunderground' ),
        'placeholder' => 'e.g. SPIN 042',
        'desc_tip'    => true,
        'description' => __( 'Label catalog code (e.g. SPIN 042).', 'spinunderground' ),
    ) );

    woocommerce_wp_select( array(
        'id'          => '_spin_format',
        'label'       => __( 'Release Format', 'spinunderground' ),
        'options'     => array(
            'wav'     => __( 'Digital WAV (24-bit Lossless)', 'spinunderground' ),
            'mp3'     => __( 'Digital MP3 (320 kbps)', 'spinunderground' ),
            'flac'    => __( 'Digital FLAC (Lossless)', 'spinunderground' ),
            'vinyl'   => __( '12" Vinyl Record', 'spinunderground' ),
            'bundle'  => __( 'Vinyl + Digital Bundle', 'spinunderground' ),
            'digital' => __( 'Digital Download (General)', 'spinunderground' ),
            'merch'   => __( 'Merchandise / Apparel', 'spinunderground' ),
        ),
        'desc_tip'    => true,
        'description' => __( 'Choose the format type displayed as badge on the release card and used for filter tabs.', 'spinunderground' ),
    ) );

    woocommerce_wp_text_input( array(
        'id'          => '_spin_genre',
        'label'       => __( 'Genre / Sub-genre', 'spinunderground' ),
        'placeholder' => 'e.g. Peak Time Techno • 132 BPM',
        'desc_tip'    => true,
        'description' => __( 'Genre tag or BPM info displayed on the release card.', 'spinunderground' ),
    ) );

    woocommerce_wp_text_input( array(
        'id'          => '_spin_audio_preview',
        'label'       => __( 'Audio Preview URL', 'spinunderground' ),
        'placeholder' => 'https://...',
        'desc_tip'    => true,
        'description' => __( 'Direct MP3 / audio preview URL for the front-page audio player.', 'spinunderground' ),
    ) );

    woocommerce_wp_text_input( array(
        'id'          => '_spin_external_link',
        'label'       => __( 'Beatport / Bandcamp Link', 'spinunderground' ),
        'placeholder' => 'https://www.beatport.com/...',
        'desc_tip'    => true,
        'description' => __( 'Optional external stream or purchase link.', 'spinunderground' ),
    ) );

    echo '</div>';
}
add_action( 'woocommerce_product_options_general_product_data', 'spinunderground_add_custom_product_fields' );

/**
 * Save custom release fields
 */
function spinunderground_save_custom_product_fields( $post_id ) {
    $fields = array(
        '_spin_artist_name'    => 'sanitize_text_field',
        '_spin_catalog_number' => 'sanitize_text_field',
        '_spin_format'         => 'sanitize_text_field',
        '_spin_genre'          => 'sanitize_text_field',
        '_spin_audio_preview'  => 'esc_url_raw',
        '_spin_external_link'  => 'esc_url_raw',
    );

    foreach ( $fields as $field_key => $sanitize_callback ) {
        if ( isset( $_POST[ $field_key ] ) ) {
            $value = call_user_func( $sanitize_callback, $_POST[ $field_key ] );
            update_post_meta( $post_id, $field_key, $value );
        }
    }
}
add_action( 'woocommerce_process_product_meta', 'spinunderground_save_custom_product_fields' );

/**
 * Helper to fetch releases for the front-page.
 * Returns real WooCommerce products if available, or rich demo/mock record releases.
 *
 * @param int $limit Number of items to retrieve.
 * @return array
 */
function spinunderground_get_frontpage_releases( $limit = 6 ) {
    $releases = array();

    // 1. Check if WooCommerce is installed and active
    if ( class_exists( 'WooCommerce' ) ) {
        $args = array(
            'status'  => 'publish',
            'limit'   => $limit,
            'orderby' => 'date',
            'order'   => 'DESC',
        );

        $products = wc_get_products( $args );

        if ( ! empty( $products ) ) {
            foreach ( $products as $product ) {
                $product_id = $product->get_id();

                // Format badge & detection
                $raw_format = get_post_meta( $product_id, '_spin_format', true );
                if ( empty( $raw_format ) ) {
                    $search_text = strtolower( $product->get_name() );

                    $terms = get_the_terms( $product_id, 'product_cat' );
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $term ) {
                            $search_text .= ' ' . strtolower( $term->name );
                        }
                    }

                    $tag_terms = get_the_terms( $product_id, 'product_tag' );
                    if ( ! empty( $tag_terms ) && ! is_wp_error( $tag_terms ) ) {
                        foreach ( $tag_terms as $term ) {
                            $search_text .= ' ' . strtolower( $term->name );
                        }
                    }

                    if ( $product->is_downloadable() ) {
                        $downloads = $product->get_downloads();
                        if ( ! empty( $downloads ) ) {
                            foreach ( $downloads as $dl ) {
                                $search_text .= ' ' . strtolower( $dl->get_name() ) . ' ' . strtolower( $dl->get_file() );
                            }
                        }
                    }

                    if ( strpos( $search_text, 'wav' ) !== false ) {
                        $raw_format = 'wav';
                    } elseif ( strpos( $search_text, 'mp3' ) !== false ) {
                        $raw_format = 'mp3';
                    } elseif ( strpos( $search_text, 'flac' ) !== false ) {
                        $raw_format = 'flac';
                    } elseif ( strpos( $search_text, 'vinyl' ) !== false ) {
                        $raw_format = 'vinyl';
                    } elseif ( strpos( $search_text, 'bundle' ) !== false ) {
                        $raw_format = 'bundle';
                    } elseif ( strpos( $search_text, 'merch' ) !== false || strpos( $search_text, 'apparel' ) !== false || strpos( $search_text, 'shirt' ) !== false ) {
                        $raw_format = 'merch';
                    } else {
                        $raw_format = 'wav';
                    }
                }

                $format_labels = array(
                    'wav'     => 'DIGITAL WAV',
                    'mp3'     => 'DIGITAL MP3',
                    'flac'    => 'DIGITAL FLAC',
                    'vinyl'   => '12" VINYL',
                    'bundle'  => 'VINYL + DIGITAL',
                    'digital' => 'DIGITAL',
                    'merch'   => 'MERCHANDISE',
                );
                $format_badge = isset( $format_labels[ $raw_format ] ) ? $format_labels[ $raw_format ] : strtoupper( $raw_format );

                // Multi-format filter tags: so digital includes wav, mp3, flac
                $filter_slugs = $raw_format;
                if ( in_array( $raw_format, array( 'wav', 'mp3', 'flac' ) ) ) {
                    $filter_slugs .= ' digital';
                }

                // Artist
                $artist = get_post_meta( $product_id, '_spin_artist_name', true );
                if ( empty( $artist ) ) {
                    // Extract from title if separated by hyphen (e.g. Artist - Title)
                    $title_parts = explode( ' - ', $product->get_name(), 2 );
                    $artist = count( $title_parts ) === 2 ? trim( $title_parts[0] ) : 'Spin Underground';
                }

                // Catalog
                $catalog = get_post_meta( $product_id, '_spin_catalog_number', true );
                if ( empty( $catalog ) ) {
                    $catalog = $product->get_sku() ? $product->get_sku() : 'SUG' . str_pad( $product_id, 3, '0', STR_PAD_LEFT );
                }

                // Genre
                $genre = get_post_meta( $product_id, '_spin_genre', true );
                if ( empty( $genre ) ) {
                    $genres_terms = get_the_terms( $product_id, 'product_tag' );
                    if ( ! empty( $genres_terms ) && ! is_wp_error( $genres_terms ) ) {
                        $genre = $genres_terms[0]->name;
                    } else {
                        $genre = 'Underground Techno';
                    }
                }

                // Image
                $img_id = $product->get_image_id();
                if ( $img_id ) {
                    $img_src = wp_get_attachment_image_url( $img_id, 'large' );
                } else {
                    $img_src = get_template_directory_uri() . '/assets/release-1.jpg';
                }

                // External link
                $external_link = get_post_meta( $product_id, '_spin_external_link', true );

                // Audio preview
                $audio_preview = get_post_meta( $product_id, '_spin_audio_preview', true );

                $releases[] = array(
                    'is_wc'            => true,
                    'id'               => $product_id,
                    'title'            => $product->get_name(),
                    'artist'           => $artist,
                    'catalog'          => $catalog,
                    'genre'            => $genre,
                    'format_slug'      => $filter_slugs,
                    'format_type'      => $raw_format,
                    'format_badge'     => $format_badge,
                    'price_html'       => $product->get_price_html(),
                    'is_on_sale'       => $product->is_on_sale(),
                    'is_in_stock'      => $product->is_in_stock(),
                    'permalink'        => get_permalink( $product_id ),
                    'image_url'        => $img_src,
                    'add_to_cart_url'  => $product->add_to_cart_url(),
                    'add_to_cart_text' => $product->add_to_cart_text(),
                    'audio_preview'    => $audio_preview,
                    'external_link'    => $external_link,
                );
            }
        }
    }

    // 2. Fallback / Default Releases if no WooCommerce products exist yet
    if ( empty( $releases ) ) {
        $theme_uri = get_template_directory_uri();

        $default_items = array(
            array(
                'id'               => 101,
                'title'            => 'Deep System EP',
                'artist'           => 'Matt Spin',
                'catalog'          => 'SPIN 042',
                'genre'            => 'Peak Time Techno • 132 BPM',
                'format_slug'      => 'vinyl',
                'format_type'      => 'vinyl',
                'format_badge'     => '12" VINYL',
                'price_html'       => '<del><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&euro;</span>19.00</bdi></span></del> <ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&euro;</span>15.99</bdi></span></ins>',
                'is_on_sale'       => true,
                'is_in_stock'      => true,
                'permalink'        => '#',
                'image_url'        => $theme_uri . '/assets/release-1.jpg',
                'add_to_cart_url'  => '?add-to-cart=101',
                'add_to_cart_text' => 'Add to Cart',
                'audio_preview'    => '',
                'external_link'    => 'https://www.beatport.com',
            ),
            array(
                'id'               => 102,
                'title'            => 'Synapse Overload',
                'artist'           => 'Electrophonic',
                'catalog'          => 'SPIN 043',
                'genre'            => 'Atmospheric Electronic • 128 BPM',
                'format_slug'      => 'wav digital',
                'format_type'      => 'wav',
                'format_badge'     => 'DIGITAL WAV',
                'price_html'       => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&euro;</span>7.99</bdi></span>',
                'is_on_sale'       => false,
                'is_in_stock'      => true,
                'permalink'        => '#',
                'image_url'        => $theme_uri . '/assets/release-2.jpg',
                'add_to_cart_url'  => '?add-to-cart=102',
                'add_to_cart_text' => 'Add to Cart',
                'audio_preview'    => '',
                'external_link'    => 'https://www.beatport.com',
            ),
            array(
                'id'               => 103,
                'title'            => 'Void Runner LP',
                'artist'           => 'K-System & Spin',
                'catalog'          => 'SPIN 044',
                'genre'            => 'Warehouse Techno • 135 BPM',
                'format_slug'      => 'mp3 digital',
                'format_type'      => 'mp3',
                'format_badge'     => 'DIGITAL MP3',
                'price_html'       => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&euro;</span>5.99</bdi></span>',
                'is_on_sale'       => false,
                'is_in_stock'      => true,
                'permalink'        => '#',
                'image_url'        => $theme_uri . '/assets/release-3.jpg',
                'add_to_cart_url'  => '?add-to-cart=103',
                'add_to_cart_text' => 'Add to Cart',
                'audio_preview'    => '',
                'external_link'    => 'https://www.beatport.com',
            ),
            array(
                'id'               => 104,
                'title'            => 'Eclipse Horizon',
                'artist'           => 'Subterrania',
                'catalog'          => 'SPIN 045',
                'genre'            => 'Melodic Cosmic Techno • 126 BPM',
                'format_slug'      => 'wav digital',
                'format_type'      => 'wav',
                'format_badge'     => 'DIGITAL WAV',
                'price_html'       => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&euro;</span>6.49</bdi></span>',
                'is_on_sale'       => false,
                'is_in_stock'      => true,
                'permalink'        => '#',
                'image_url'        => $theme_uri . '/assets/release-4.jpg',
                'add_to_cart_url'  => '?add-to-cart=104',
                'add_to_cart_text' => 'Add to Cart',
                'audio_preview'    => '',
                'external_link'    => 'https://www.beatport.com',
            ),
            array(
                'id'               => 105,
                'title'            => 'Technologie / Sub046',
                'artist'           => 'Underground System',
                'catalog'          => 'SPIN 046',
                'genre'            => 'Industrial Acid • 134 BPM',
                'format_slug'      => 'flac digital',
                'format_type'      => 'flac',
                'format_badge'     => 'DIGITAL FLAC',
                'price_html'       => '<del><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&euro;</span>18.00</bdi></span></del> <ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&euro;</span>14.00</bdi></span></ins>',
                'is_on_sale'       => true,
                'is_in_stock'      => true,
                'permalink'        => '#',
                'image_url'        => $theme_uri . '/assets/release-5.jpg',
                'add_to_cart_url'  => '?add-to-cart=105',
                'add_to_cart_text' => 'Add to Cart',
                'audio_preview'    => '',
                'external_link'    => 'https://www.beatport.com',
            ),
            array(
                'id'               => 106,
                'title'            => 'Neural Pulse',
                'artist'           => 'Matt Spin',
                'catalog'          => 'SPIN 047',
                'genre'            => 'Hypnotic Deep Techno • 130 BPM',
                'format_slug'      => 'bundle',
                'format_type'      => 'bundle',
                'format_badge'     => 'VINYL + DIGITAL',
                'price_html'       => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&euro;</span>19.99</bdi></span>',
                'is_on_sale'       => false,
                'is_in_stock'      => true,
                'permalink'        => '#',
                'image_url'        => $theme_uri . '/assets/release-6.jpg',
                'add_to_cart_url'  => '?add-to-cart=106',
                'add_to_cart_text' => 'Add to Cart',
                'audio_preview'    => '',
                'external_link'    => 'https://www.beatport.com',
            ),
        );

        // Check if user specified any front-page ACF release overrides
        for ( $i = 1; $i <= $limit; $i++ ) {
            $acf_title = function_exists( 'get_field' ) ? get_field( 'release_' . $i . '_title' ) : null;
            $acf_link  = function_exists( 'get_field' ) ? get_field( 'release_' . $i . '_link' ) : null;
            $acf_img   = function_exists( 'get_field' ) ? get_field( 'release_' . $i . '_image' ) : null;

            if ( $acf_title && $acf_link && isset( $default_items[ $i - 1 ] ) ) {
                $default_items[ $i - 1 ]['title']         = $acf_title;
                $default_items[ $i - 1 ]['external_link'] = $acf_link;
                if ( $acf_img && is_array( $acf_img ) && ! empty( $acf_img['sizes']['large'] ) ) {
                    $default_items[ $i - 1 ]['image_url'] = $acf_img['sizes']['large'];
                }
            }
        }

        $releases = array_slice( $default_items, 0, $limit );
    }

    return $releases;
}

/**
 * Disable duplicate Google Pay and Apple Pay from PayPal Smart Buttons
 * when Stripe Payment Request is active on cart/checkout.
 */
function spinunderground_disable_paypal_duplicate_wallets( $funding ) {
    if ( ! is_array( $funding ) ) {
        $funding = array();
    }
    if ( ! isset( $funding['disabled'] ) || ! is_array( $funding['disabled'] ) ) {
        $funding['disabled'] = array();
    }
    if ( ! in_array( 'googlepay', $funding['disabled'], true ) ) {
        $funding['disabled'][] = 'googlepay';
    }
    if ( ! in_array( 'applepay', $funding['disabled'], true ) ) {
        $funding['disabled'][] = 'applepay';
    }
    return $funding;
}
add_filter( 'woocommerce_paypal_payments_basic_smart_button_funding', 'spinunderground_disable_paypal_duplicate_wallets', 20 );
add_filter( 'woocommerce_paypal_payments_smart_button_funding', 'spinunderground_disable_paypal_duplicate_wallets', 20 );

/**
 * Client-side script to deduplicate Google Pay express payment buttons
 * in WooCommerce Cart and Checkout Blocks.
 */
function spinunderground_deduplicate_google_pay_script() {
    if ( ! function_exists( 'is_cart' ) && ! function_exists( 'is_checkout' ) ) {
        return;
    }
    if ( ! is_cart() && ! is_checkout() && ! is_front_page() ) {
        return;
    }
    ?>
    <script type="text/javascript">
    (function() {
        function removeDuplicateGPay() {
            // 1. Check WooCommerce Blocks express payment list
            var expressLists = document.querySelectorAll('.wc-block-components-express-payment__event-buttons');
            expressLists.forEach(function(list) {
                var items = list.querySelectorAll(':scope > li');
                // If there are 3 items, item 1 is PayPal and items 2 & 3 are duplicate Google Pay
                if (items.length >= 3) {
                    items[2].style.setProperty('display', 'none', 'important');
                }
            });

            // 2. Identify all Google Pay containers and iframes
            var gpayWrappers = [];
            var iframes = document.querySelectorAll('iframe');
            iframes.forEach(function(iframe) {
                var title = (iframe.getAttribute('title') || '').toLowerCase();
                var src = (iframe.getAttribute('src') || '').toLowerCase();
                var aria = (iframe.getAttribute('aria-label') || '').toLowerCase();
                if (title.indexOf('google pay') !== -1 || title.indexOf('gpay') !== -1 || src.indexOf('pay.google.com') !== -1 || aria.indexOf('google pay') !== -1) {
                    var wrapper = iframe.closest('li') || iframe.closest('.wc-stripe-payment-request-wrapper') || iframe.closest('.paypal-button-row') || iframe.closest('[id*="payment-request"]') || iframe;
                    if (gpayWrappers.indexOf(wrapper) === -1) {
                        gpayWrappers.push(wrapper);
                    }
                }
            });

            // If more than 1 Google Pay button exists, hide all subsequent ones
            if (gpayWrappers.length > 1) {
                for (var i = 1; i < gpayWrappers.length; i++) {
                    gpayWrappers[i].style.setProperty('display', 'none', 'important');
                }
            }

            // 3. Specifically hide PayPal's Google Pay button elements
            var ppGPay = document.querySelectorAll('[data-funding-source="googlepay"], .paypal-button-context-googlepay, #paypal-googlepay-button, .zial-google-pay-button');
            ppGPay.forEach(function(el) {
                var wrap = el.closest('li') || el.closest('.paypal-button-row') || el;
                wrap.style.setProperty('display', 'none', 'important');
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', removeDuplicateGPay);
        } else {
            removeDuplicateGPay();
        }

        var attempts = 0;
        var timer = setInterval(function() {
            removeDuplicateGPay();
            attempts++;
            if (attempts > 20) {
                clearInterval(timer);
            }
        }, 200);

        if (window.MutationObserver) {
            var observer = new MutationObserver(function() {
                removeDuplicateGPay();
            });
            observer.observe(document.body, { childList: true, subtree: true });
        }
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'spinunderground_deduplicate_google_pay_script', 99 );


