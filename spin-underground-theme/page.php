<?php
/**
 * The template for displaying all pages
 *
 * @package Spin_Underground
 */

get_header(); ?>

<section class="page-content">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
        <h1 class="section-title"><?php the_title(); ?></h1>
        <div class="page-body">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</section>

<?php get_footer();
