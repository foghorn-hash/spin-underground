<?php
/**
 * The main template file / Blog listing
 */
get_header(); ?>

<section class="blog-listing">
  <div class="container">
    <h1 class="section-title"><?php single_post_title(); ?></h1>
    <div class="grid grid-3">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="card blog-card">
          <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('medium', ['class' => 'blog-thumb']); ?>
            </a>
          <?php endif; ?>
          <div class="card-content">
            <p class="post-meta"><?php echo get_the_date(); ?></p>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="post-excerpt">
              <?php the_excerpt(); ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="read-more">Read More &rarr;</a>
          </div>
        </article>
      <?php endwhile; else : ?>
        <p>No posts found.</p>
      <?php endif; ?>
    </div>
    
    <div class="pagination">
        <?php
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( '&larr; Previous', 'spinunderground' ),
            'next_text' => __( 'Next &rarr;', 'spinunderground' ),
        ) );
        ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
