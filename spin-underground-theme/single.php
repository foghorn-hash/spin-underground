<?php
/**
 * The template for displaying all single posts
 */
get_header(); ?>

<section class="single-post">
  <div class="container single-container">
    <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="post-header">
          <h1 class="post-title"><?php the_title(); ?></h1>
          <div class="post-meta-single">
            <span><?php echo get_the_date(); ?></span> | <span><?php the_author(); ?></span>
          </div>
          <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail">
              <?php the_post_thumbnail('large'); ?>
            </div>
          <?php endif; ?>
        </header>
        
        <div class="post-content">
          <?php the_content(); ?>
        </div>
        
        <footer class="post-footer">
          <div class="post-categories">
            <strong>Categories: </strong><?php the_category(', '); ?>
          </div>
          <div class="post-tags">
            <?php the_tags('<strong>Tags: </strong>', ', ', ''); ?>
          </div>
        </footer>
      </article>

      <?php 
      // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) :
          comments_template();
      endif;
      ?>
      
    <?php endwhile; ?>
  </div>
</section>

<?php get_footer(); ?>
