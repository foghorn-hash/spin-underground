<?php
/**
 * The main template file
 */

get_header(); ?>

<!-- Overlay menu -->
<div class="overlay" id="overlay">
 <button class="close-btn" id="closeBtn">&times;</button>
 <a href="#releases" onclick="closeMenu()"><i class="bi bi-disc"></i> Releases & Store</a>
 <a href="#videos" onclick="closeMenu()">Videos</a>
 <a href="#about" onclick="closeMenu()">About</a>
 <a href="#contact" onclick="closeMenu()">Contact</a>
 <a href="<?php echo esc_url( get_post_type_archive_link( 'artist' ) ); ?>" onclick="closeMenu()">Artists</a>
 <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" onclick="closeMenu()">Blog</a>
 <?php if ( class_exists( 'WooCommerce' ) ) : ?>
   <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" onclick="closeMenu()"><i class="bi bi-bag"></i> Cart (<?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>)</a>
 <?php endif; ?>
</div>

<section class="video-section">
  <div class="video-container-wrapper">
    <?php 
    $header_video_1 = get_theme_mod('header_video_1', 'https://www.youtube.com/embed/kkKOJO0Hw0o?si=DLpzFNzokzy2Egh6');
    if ( $header_video_1 ) : ?>
        <div class="responsive-video">
        <iframe src="<?php echo esc_url($header_video_1); ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    <?php endif; ?>

    <?php 
    $header_video_2 = get_theme_mod('header_video_2', 'https://www.youtube.com/embed/aM0xpY-LgAc?si=GoYS0FUhctaGrlxI');
    if ( $header_video_2 ) : ?>
        <div class="responsive-video">
        <iframe src="<?php echo esc_url($header_video_2); ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    <?php endif; ?>
  </div>
</section>

<section class="hero">
  <div class="container hero-content">
    <h1><?php echo esc_html( get_theme_mod( 'hero_title', 'Feel the Underground Vibe' ) ); ?></h1>
    <p><?php echo esc_html( get_theme_mod( 'hero_subtitle', 'Cutting-edge techno & house from the heart of Finland.' ) ); ?></p>
    <a href="#releases" class="btn"><?php echo esc_html( get_theme_mod( 'hero_button_text', 'Latest Releases' ) ); ?></a>
  </div>
</section>

<!-- WooCommerce Record Label Releases & Store Showcase -->
<section class="releases releases-store-section" id="releases">
  <div class="container">
    <?php
    $release_badge    = get_theme_mod( 'release_section_badge', 'OFFICIAL LABEL RELEASES' );
    $release_title    = get_theme_mod( 'release_section_title', 'Releases & Label Store' );
    $release_subtitle = get_theme_mod( 'release_section_subtitle', 'Exclusive heavyweight 12" vinyl pressings, lossless 24-bit digital masters & underground gear.' );
    $product_count    = get_theme_mod( 'release_products_count', 6 );
    $shop_btn_text    = get_theme_mod( 'release_shop_btn_text', 'Explore Full Record Store' );
    $shop_url         = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop' );

    $releases = spinunderground_get_frontpage_releases( $product_count );
    ?>

    <!-- Store Section Header -->
    <div class="store-section-header">
      <div class="store-badge-tag"><i class="bi bi-disc"></i> <?php echo esc_html( $release_badge ); ?></div>
      <h2 class="section-title store-title"><?php echo esc_html( $release_title ); ?></h2>
      <p class="store-subtitle"><?php echo esc_html( $release_subtitle ); ?></p>
    </div>

    <!-- Format Filter Tabs -->
    <div class="store-filter-bar">
      <button type="button" class="store-filter-btn active" data-filter="all"><i class="bi bi-grid-3x3-gap"></i> All Releases</button>
      <button type="button" class="store-filter-btn" data-filter="wav"><i class="bi bi-file-earmark-music"></i> WAV</button>
      <button type="button" class="store-filter-btn" data-filter="mp3"><i class="bi bi-music-note"></i> MP3</button>
      <button type="button" class="store-filter-btn" data-filter="flac"><i class="bi bi-soundwave"></i> FLAC</button>
      <button type="button" class="store-filter-btn" data-filter="vinyl"><i class="bi bi-record-circle"></i> 12" Vinyl</button>
      <button type="button" class="store-filter-btn" data-filter="bundle"><i class="bi bi-collection-play"></i> Bundles</button>
      <button type="button" class="store-filter-btn" data-filter="merch"><i class="bi bi-tag"></i> Merch</button>
    </div>

    <!-- Releases Product Grid -->
    <div class="store-releases-grid" id="storeReleasesGrid">
      <?php if ( ! empty( $releases ) ) : ?>
        <?php foreach ( $releases as $rel ) : ?>
          <article class="release-card" 
                   data-format="<?php echo esc_attr( $rel['format_slug'] ); ?>"
                   data-id="<?php echo esc_attr( $rel['id'] ); ?>"
                   data-title="<?php echo esc_attr( $rel['title'] ); ?>"
                   data-artist="<?php echo esc_attr( $rel['artist'] ); ?>"
                   data-audio="<?php echo esc_attr( $rel['audio_preview'] ); ?>"
                   data-img="<?php echo esc_url( $rel['image_url'] ); ?>"
                   data-cart-url="<?php echo esc_url( $rel['add_to_cart_url'] ); ?>">
            
            <!-- Vinyl Sleeve & Sliding Record Presentation -->
            <div class="sleeve-wrap">
              <!-- Grooved Vinyl Disc Sliding out on hover -->
              <div class="vinyl-disc-layer" aria-hidden="true">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/vinyl-disc.svg' ); ?>" alt="" class="vinyl-disc-img" />
              </div>

              <!-- Jacket / Sleeve Front Cover -->
              <div class="sleeve-cover">
                <img src="<?php echo esc_url( $rel['image_url'] ); ?>" alt="<?php echo esc_attr( $rel['title'] ); ?>" class="cover-art" loading="lazy" />
                <div class="sleeve-sheen"></div>

                <!-- Badges overlay -->
                <div class="sleeve-badges">
                  <?php $badge_class = isset( $rel['format_type'] ) ? $rel['format_type'] : $rel['format_slug']; ?>
                  <span class="format-badge format-<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $rel['format_badge'] ); ?></span>
                  <?php if ( ! empty( $rel['is_on_sale'] ) ) : ?>
                    <span class="sale-badge"><i class="bi bi-lightning-fill"></i> SALE</span>
                  <?php endif; ?>
                </div>

                <!-- Catalog Number Overlay -->
                <div class="catalog-badge"><?php echo esc_html( $rel['catalog'] ); ?></div>

                <!-- Interactive Audio Preview Button -->
                <button type="button" class="preview-play-btn" aria-label="<?php esc_attr_e( 'Play release audio preview', 'spinunderground' ); ?>">
                  <span class="play-icon"><i class="bi bi-play-fill"></i></span>
                  <span class="pause-icon"><i class="bi bi-pause-fill"></i></span>
                  <div class="sound-wave-bars" aria-hidden="true">
                    <span></span><span></span><span></span><span></span>
                  </div>
                </button>
              </div>
            </div>

            <!-- Card Metadata & Action Row -->
            <div class="release-details">
              <div class="release-header-meta">
                <span class="release-artist"><?php echo esc_html( $rel['artist'] ); ?></span>
                <span class="release-catalog-text"><?php echo esc_html( $rel['catalog'] ); ?></span>
              </div>

              <h3 class="release-title">
                <a href="<?php echo esc_url( $rel['permalink'] ); ?>"><?php echo esc_html( $rel['title'] ); ?></a>
              </h3>

              <p class="release-genre"><?php echo esc_html( $rel['genre'] ); ?></p>

              <div class="release-actions-row">
                <div class="release-price">
                  <?php echo $rel['price_html']; // Escaped or generated by WooCommerce ?>
                </div>

                <div class="release-buttons">
                  <?php if ( ! empty( $rel['is_wc'] ) ) : ?>
                    <a href="<?php echo esc_url( $rel['add_to_cart_url'] ); ?>" 
                       data-quantity="1" 
                       class="btn-store-cart add_to_cart_button ajax_add_to_cart" 
                       data-product_id="<?php echo esc_attr( $rel['id'] ); ?>" 
                       data-product_sku="<?php echo esc_attr( $rel['catalog'] ); ?>" 
                       aria-label="<?php echo esc_attr( $rel['add_to_cart_text'] ); ?>" 
                       rel="nofollow">
                      <i class="bi bi-bag-plus"></i> <span class="btn-text"><?php echo esc_html( $rel['add_to_cart_text'] ); ?></span>
                    </a>
                  <?php else : ?>
                    <a href="<?php echo esc_url( $rel['add_to_cart_url'] ); ?>" 
                       class="btn-store-cart demo-cart-btn" 
                       data-product_id="<?php echo esc_attr( $rel['id'] ); ?>" 
                       aria-label="Add to Cart">
                      <i class="bi bi-bag-plus"></i> <span class="btn-text">Add to Cart</span>
                    </a>
                  <?php endif; ?>

                  <?php if ( ! empty( $rel['external_link'] ) && $rel['external_link'] !== '#' ) : ?>
                    <a href="<?php echo esc_url( $rel['external_link'] ); ?>" target="_blank" rel="noopener" class="btn-store-icon" title="Beatport / External">
                      <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>

          </article>
        <?php endforeach; ?>
      <?php else : ?>
        <p class="no-releases-notice">No releases currently available. Add products in WooCommerce to display them here.</p>
      <?php endif; ?>
    </div>

    <!-- Store Features & Guarantees Banner -->
    <div class="store-perks-banner">
      <div class="perk-item">
        <div class="perk-icon"><i class="bi bi-disc-fill"></i></div>
        <div class="perk-text">
          <h4>Audiophile Vinyl</h4>
          <p>Heavyweight 180g virgin vinyl with pristine club mastering</p>
        </div>
      </div>
      <div class="perk-item">
        <div class="perk-icon"><i class="bi bi-file-earmark-music-fill"></i></div>
        <div class="perk-text">
          <h4>24-Bit Studio Masters</h4>
          <p>Instant lossless WAV & 320kbps MP3 downloads included</p>
        </div>
      </div>
      <div class="perk-item">
        <div class="perk-icon"><i class="bi bi-truck"></i></div>
        <div class="perk-text">
          <h4>Global Safe Delivery</h4>
          <p>Carefully packed in sturdy protective cardboard mailers</p>
        </div>
      </div>
      <div class="perk-item">
        <div class="perk-icon"><i class="bi bi-shield-check"></i></div>
        <div class="perk-text">
          <h4>100% Artist Direct</h4>
          <p>Direct royalties to independent underground music producers</p>
        </div>
      </div>
    </div>

    <!-- Bottom Store CTA -->
    <div class="store-footer-cta">
      <a href="<?php echo esc_url( $shop_url ); ?>" class="btn btn-store-primary">
        <span><?php echo esc_html( $shop_btn_text ); ?></span> <i class="bi bi-arrow-right"></i>
      </a>
    </div>

  </div>
</section>

<!-- Floating Audio Preview Player Dock -->
<div class="preview-player-dock" id="previewPlayerDock" aria-hidden="true">
  <div class="container dock-container">
    <div class="dock-track-info">
      <div class="dock-disc-thumb">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/vinyl-disc.svg' ); ?>" alt="" class="dock-spinning-disc" id="dockDiscThumb" />
      </div>
      <div class="dock-text">
        <span class="dock-label"><span class="live-dot"></span> NOW PREVIEWING</span>
        <h4 class="dock-title" id="dockTrackTitle">Deep System EP</h4>
        <p class="dock-artist" id="dockArtistName">Matt Spin</p>
      </div>
    </div>

    <div class="dock-controls">
      <button type="button" class="dock-btn dock-btn-play" id="dockPlayPauseBtn" aria-label="Play or Pause Preview">
        <i class="bi bi-pause-fill"></i>
      </button>
      <div class="dock-wave-visualizer" id="dockWaveVisualizer" aria-hidden="true">
        <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
      </div>
      <div class="dock-time" id="dockTimeDisplay">0:15 / 0:45</div>
    </div>

    <div class="dock-actions">
      <a href="#storeReleasesGrid" class="dock-btn-buy" id="dockBuyBtn">
        <i class="bi bi-bag-check"></i> <span id="dockBuyText">Buy Release</span>
      </a>
      <button type="button" class="dock-btn-close" id="dockCloseBtn" aria-label="Close audio player">&times;</button>
    </div>
  </div>
</div>

<!-- Video releases -->
<section class="releases" id="videos" style="background:#111;">
  <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'video_section_title', 'Latest YouTube Videos' ) ); ?></h2>
  <div class="container grid grid-3">
    <?php 
    $has_videos = false;
    for ($i = 1; $i <= 6; $i++) {
        $embed = get_field('video_' . $i . '_embed');
        $title = get_field('video_' . $i . '_title');

        if ($embed) {
            $has_videos = true;
            ?>
            <div class="video-card">
                <div class="video-wrapper">
                    <?php echo $embed; // oEmbed HTML ?>
                </div>
                <?php if ($title) : ?>
                    <div class="video-info"><h3><?php echo esc_html($title); ?></h3></div>
                <?php endif; ?>
            </div>
            <?php
        }
    }

    if (!$has_videos) {
        echo '<p>Add YouTube videos via the WordPress dashboard (Edit Front Page).</p>';
    }
    ?>
  </div>
</section>

<section class="about" id="about">
  <h2 class="section-title">About Us</h2>
  <div class="container">
    <?php 
    $about_text = get_field('about_us_text');
    if ($about_text) {
        echo $about_text;
    } else {
        echo '<p>Add "About Us" text via the WordPress dashboard (Edit Front Page).</p>';
    }
    ?>
  </div>
</section>

<?php
get_footer();
