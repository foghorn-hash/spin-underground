<?php
/**
 * Template for displaying all WooCommerce pages
 *
 * @package Spin_Underground
 */

get_header(); ?>

<main class="woocommerce-main-content" id="main">
  <div class="container woocommerce-container">
    <?php woocommerce_content(); ?>
  </div>
</main>

<?php
get_footer();
