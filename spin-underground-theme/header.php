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
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#releases">Audio</a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#videos">Videos</a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#about">About</a></li>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#contact">Contact</a></li>
        <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">Blog</a></li>
      </ul>
      <div class="burger" id="burger"><span></span><span></span><span></span></div>
    </nav>
  </div>
</header>
