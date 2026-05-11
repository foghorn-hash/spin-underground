<?php
/**
 * The template for displaying Artist Archives
 */
get_header(); ?>

<section class="artist-listing">
  <div class="container">
    <h1 class="section-title"><?php post_type_archive_title(); ?></h1>
    <div class="grid grid-3">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="card artist-card">
          <?php 
          // Check if ACF additional photo is provided, otherwise use featured image
          $photo = get_field('artist_photo');
          if ( $photo && is_array($photo) ) {
              $img_url = $photo['sizes']['medium_large'];
              $img_alt = $photo['alt'];
          } else {
              $img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
              $img_alt = get_the_title();
          }
          
          if ( $img_url ) : ?>
            <a href="<?php the_permalink(); ?>">
              <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="artist-thumb">
            </a>
          <?php endif; ?>
          <div class="card-content">
            <?php
            // Get genres
            $genres = get_the_terms( get_the_ID(), 'artist_genre' );
            if ( $genres && ! is_wp_error( $genres ) ) : 
                $genre_names = wp_list_pluck( $genres, 'name' );
                ?>
                <p class="post-meta artist-genres"><?php echo esc_html( join( ', ', $genre_names ) ); ?></p>
            <?php endif; ?>
            
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            
            <?php 
            $producer_name = get_field('producer_name');
            if ( $producer_name ) : ?>
                <p class="artist-producer-name"><strong>Producer:</strong> <?php echo esc_html($producer_name); ?></p>
            <?php endif; ?>

            <a href="<?php the_permalink(); ?>" class="btn">View Profile</a>
          </div>
        </article>
      <?php endwhile; else : ?>
        <p>No artists found.</p>
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
