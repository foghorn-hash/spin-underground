<?php
/**
 * The main template file
 */

get_header(); ?>

<!-- Overlay menu (Duplicate ID in original, we'll keep one for the main menu) -->
<div class="overlay" id="overlay">
 <button class="close-btn" id="closeBtn">&times;</button>
 <a href="#releases" onclick="closeMenu()">Audio</a>
 <a href="#videos" onclick="closeMenu()">Videos</a>
 <a href="#about" onclick="closeMenu()">About</a>
 <a href="#contact" onclick="closeMenu()">Contact</a>
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
    <h1>Feel the Underground Vibe</h1>
    <p>Cutting-edge techno & house from the heart of Finland.</p>
    <a href="#releases" class="btn">Latest Releases</a>
  </div>
</section>

<!-- Audio releases -->
<section class="releases" id="releases">
  <h2 class="section-title">Featured Audio Releases</h2>
  <div class="container grid grid-3">
    <?php 
    $has_releases = false;
    for ($i = 1; $i <= 6; $i++) {
        $img = get_field('release_' . $i . '_image');
        $title = get_field('release_' . $i . '_title');
        $link = get_field('release_' . $i . '_link');

        if ($title && $link) {
            $has_releases = true;
            $img_url = ($img && is_array($img)) ? $img['sizes']['medium_large'] : '';
            ?>
            <div class="card">
                <?php if ($img_url) : ?>
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" />
                <?php else: ?>
                    <!-- Placeholder image if none provided -->
                    <div style="background:#222; width:100%; aspect-ratio:1/1;"></div>
                <?php endif; ?>
                <div class="card-content">
                    <h3><?php echo esc_html($title); ?></h3>
                    <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener">Listen on Beatport &rarr;</a>
                </div>
            </div>
            <?php
        }
    }

    if (!$has_releases) {
        echo '<p>Add releases via the WordPress dashboard (Edit Front Page).</p>';
    }
    ?>
  </div>
</section>

<!-- Video releases -->
<section class="releases" id="videos" style="background:#111;">
  <h2 class="section-title">Latest YouTube Videos</h2>
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
