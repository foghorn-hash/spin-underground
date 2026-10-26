<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-0629654235067145" crossorigin="anonymous"></script>
  <meta name="google-adsense-account" content="ca-pub-0629654235067145">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() ); ?>/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon-16x16.png">
  <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/site.webmanifest">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
  <div class="container">
    <nav>
      <div class="logo">
        <?php 
        if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
            the_custom_logo();
        } else {
            $logo_url = get_template_directory_uri() . '/assets/SpinUndergroundV-square.png'; 
            echo '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" /></a>';
        }
        ?>
      </div>
      <ul class="nav-links" id="navLinks">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#releases"><i class="bi bi-disc"></i> Releases</a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#videos">Videos</a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#about">About</a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#contact">Contact</a></li>
        <li><a href="<?php echo esc_url( get_post_type_archive_link( 'artist' ) ); ?>">Artists</a></li>
        <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">Blog</a></li>
        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
        <li class="nav-cart-item">
          <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="nav-cart-link" aria-label="<?php esc_attr_e( 'Shopping Cart', 'spinunderground' ); ?>">
            <i class="bi bi-bag"></i>
            <span class="cart-count"><?php echo WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?></span>
          </a>
        </li>
        <?php endif; ?>
      </ul>
      <div class="burger" id="burger"><span></span><span></span><span></span></div>
    </nav>
  </div>
</header>
