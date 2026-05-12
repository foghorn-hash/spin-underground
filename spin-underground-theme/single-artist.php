<?php
/**
 * The template for displaying all single Artists
 */
get_header(); ?>

<main class="single-artist-container container">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('artist-profile'); ?>>
            
            <header class="artist-header">
                <?php 
                $photo = get_field('artist_photo');
                if ( $photo && is_array($photo) ) {
                    $img_url = $photo['sizes']['large'];
                    $img_alt = $photo['alt'];
                } else {
                    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    $img_alt = get_the_title();
                }
                
                if ( $img_url ) : ?>
                    <div class="artist-photo">
                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                    </div>
                <?php endif; ?>

                <div class="artist-header-info">
                    <h1 class="artist-title"><?php the_title(); ?></h1>
                    
                    <?php 
                    $producer_name = get_field('producer_name');
                    if ( $producer_name ) : ?>
                        <p class="artist-producer-name"><strong>Producer:</strong> <?php echo esc_html($producer_name); ?></p>
                    <?php endif; ?>

                    <?php
                    $genres = get_the_terms( get_the_ID(), 'artist_genre' );
                    if ( $genres && ! is_wp_error( $genres ) ) : 
                        $genre_names = wp_list_pluck( $genres, 'name' );
                        ?>
                        <div class="artist-genres">
                            <i class="bi bi-music-note-list"></i> <?php echo esc_html( join( ', ', $genre_names ) ); ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                    $booking_email = get_field('booking_email');
                    if ( $booking_email ) : ?>
                        <div class="artist-booking">
                            <a href="mailto:<?php echo esc_attr($booking_email); ?>" class="btn btn-outline">
                                <i class="bi bi-envelope-fill"></i> Book <?php the_title(); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </header>

            <div class="artist-body grid">
                <div class="artist-bio card">
                    <h2>Biography</h2>
                    <div class="bio-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <aside class="artist-links">
                    <?php 
                    // Social Links
                    $socials = [
                        'instagram_url' => ['icon' => 'bi-instagram', 'label' => 'Instagram', 'class' => 'link-instagram'],
                        'facebook_url'  => ['icon' => 'bi-facebook', 'label' => 'Facebook', 'class' => 'link-facebook'],
                        'youtube_url'   => ['icon' => 'bi-youtube', 'label' => 'YouTube', 'class' => 'link-youtube'],
                        'soundcloud_url'=> ['icon' => 'bi-cloud-fill', 'label' => 'SoundCloud', 'class' => 'link-soundcloud'], // Cloud icon for SC
                        'twitch_url'    => ['icon' => 'bi-twitch', 'label' => 'Twitch', 'class' => 'link-twitch'],
                    ];
                    $has_socials = false;
                    foreach($socials as $key => $data) { if(get_field($key)) $has_socials = true; }
                    
                    if ($has_socials) : ?>
                        <div class="link-group card">
                            <h3>Socials</h3>
                            <div class="link-buttons">
                                <?php foreach($socials as $key => $data) : 
                                    $url = get_field($key);
                                    if ($url) : ?>
                                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="btn-icon <?php echo esc_attr($data['class']); ?>">
                                            <i class="bi <?php echo esc_attr($data['icon']); ?>"></i> <?php echo esc_html($data['label']); ?>
                                        </a>
                                <?php endif; endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php 
                    // Streaming Links
                    $streaming = [
                        'spotify_url'      => ['icon' => 'bi-spotify', 'label' => 'Spotify', 'class' => 'link-spotify'],
                        'deezer_url'       => ['icon' => 'bi-music-player-fill', 'label' => 'Deezer', 'class' => 'link-deezer'],
                        'amazon_music_url' => ['icon' => 'bi-amazon', 'label' => 'Amazon Music', 'class' => 'link-amazon'],
                    ];
                    $has_streaming = false;
                    foreach($streaming as $key => $data) { if(get_field($key)) $has_streaming = true; }
                    
                    if ($has_streaming) : ?>
                        <div class="link-group card">
                            <h3>Streaming</h3>
                            <div class="link-buttons">
                                <?php foreach($streaming as $key => $data) : 
                                    $url = get_field($key);
                                    if ($url) : ?>
                                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="btn-icon <?php echo esc_attr($data['class']); ?>">
                                            <i class="bi <?php echo esc_attr($data['icon']); ?>"></i> <?php echo esc_html($data['label']); ?>
                                        </a>
                                <?php endif; endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php 
                    // Store Links
                    $stores = [
                        'beatport_url'      => ['icon' => 'bi-headphones', 'label' => 'Beatport', 'class' => 'link-beatport'],
                        'traxsource_url'    => ['icon' => 'bi-vinyl-fill', 'label' => 'Traxsource', 'class' => 'link-traxsource'],
                        'juno_download_url' => ['icon' => 'bi-download', 'label' => 'Juno Download', 'class' => 'link-juno'],
                    ];
                    $has_stores = false;
                    foreach($stores as $key => $data) { if(get_field($key)) $has_stores = true; }
                    
                    if ($has_stores) : ?>
                        <div class="link-group card">
                            <h3>MP3 Stores</h3>
                            <div class="link-buttons">
                                <?php foreach($stores as $key => $data) : 
                                    $url = get_field($key);
                                    if ($url) : ?>
                                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="btn-icon <?php echo esc_attr($data['class']); ?>">
                                            <i class="bi <?php echo esc_attr($data['icon']); ?>"></i> <?php echo esc_html($data['label']); ?>
                                        </a>
                                <?php endif; endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </aside>
            </div>
            
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
