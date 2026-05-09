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
    <div class="responsive-video">
      <iframe src="https://www.youtube.com/embed/kkKOJO0Hw0o?si=DLpzFNzokzy2Egh6" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    <div class="responsive-video">
      <iframe src="https://www.youtube.com/embed/aM0xpY-LgAc?si=GoYS0FUhctaGrlxI" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
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
    <div class="card">
      <img src="https://geo-media.beatport.com/image_size/1400x1400/33f5f5ff-b27c-48f0-a82a-bbe8b4dde055.jpg" alt="Step by Step" />
      <div class="card-content"><h3>Step by Step (Original Mix)</h3><a href="https://www.beatport.com/release/step-by-step/5021322" target="_blank" rel="noopener">Listen on Beatport &rarr;</a></div>
    </div>
    <div class="card">
      <img src="https://geo-media.beatport.com/image_size/1400x1400/b994d3ff-e115-4b00-b679-af71b80927da.jpg" alt="Just This" />
      <div class="card-content"><h3>Just This</h3><a href="https://www.beatport.com/release/just-this/4903429" target="_blank" rel="noopener">Listen on Beatport &rarr;</a></div>
    </div>
    <div class="card">
      <img src="https://geo-media.beatport.com/image_size/1400x1400/65674e9c-9bd9-48b9-aa60-2c8d4aed3698.jpg" alt="Best of My Stuff 2025" />
      <div class="card-content"><h3>Best of My Stuff 2025</h3><a href="https://www.beatport.com/release/best-of-my-stuff-2025/4903427" target="_blank" rel="noopener">Listen on Beatport &rarr;</a></div>
    </div>
    <div class="card">
      <img src="https://geo-media.beatport.com/image_size/1400x1400/13cecf50-e8ae-4383-9398-6561e5c935b1.jpg" alt="Once Upon Techno EP" />
      <div class="card-content"><h3>Once Upon Techno EP</h3><a href="https://www.beatport.com/release/once-upon-techno-ep/4898339" target="_blank" rel="noopener">Listen on Beatport &rarr;</a></div>
    </div>
    <div class="card">
      <img src="https://geo-media.beatport.com/image_size/1400x1400/ada1212b-d1de-4e9e-8af4-d57cab2cabeb.jpg" alt="Dance of Money" />
      <div class="card-content"><h3>Dance of Money</h3><a href="https://www.beatport.com/release/dance-of-money/4894759" target="_blank" rel="noopener">Listen on Beatport &rarr;</a></div>
    </div>
    <div class="card">
      <img src="https://geo-media.beatport.com/image_size/1400x1400/f811d8dd-4fac-4196-b3d5-ac9a82d86737.jpg" alt="Anyway" />
      <div class="card-content"><h3>Anyway</h3><a href="https://www.beatport.com/release/anyway/4806312" target="_blank" rel="noopener">Listen on Beatport &rarr;</a></div>
    </div>
  </div>
</section>

<!-- Video releases -->
<section class="releases" id="videos" style="background:#111;">
  <h2 class="section-title">Latest YouTube Videos</h2>
  <div class="container grid grid-3">
    <!-- Video card example -->
    <div class="video-card">
      <div class="video-wrapper"><iframe src="https://www.youtube.com/embed/_nwFO6kef48?si=g3khTOpar-AQlakR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
      <div class="video-info"><h3>DJ set at 17th April 2025</h3></div>
    </div>
    <div class="video-card">
      <div class="video-wrapper"><iframe src="https://www.youtube.com/embed/ude1ZmMDWkE?si=n_vvEbFOesw1PV4K" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
      <div class="video-info"><h3>Cyperpunk</h3></div>
    </div>
    <div class="video-card">
      <div class="video-wrapper"><iframe src="https://www.youtube.com/embed/XtUIIO7DRlo?si=1_uBlPciYX4srz4c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
      <div class="video-info"><h3>DJ set</h3></div>
    </div>
    <div class="video-card">
      <div class="video-wrapper"><iframe src="https://www.youtube.com/embed/YIcMOhCadNI?si=J56PXfKLKOCBi3eN" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
      <div class="video-info"><h3>Track</h3></div>
    </div>
    <div class="video-card">
      <div class="video-wrapper"><iframe src="https://www.youtube.com/embed/A3Z4RcKvs-Q?si=oV43JePFrkauTUPI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
      <div class="video-info"><h3>Track</h3></div>
    </div>
    <div class="video-card">
      <div class="video-wrapper"><iframe src="https://www.youtube.com/embed/5lnIw-9qch8?si=du02DLcVhUQIoTdH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
      <div class="video-info"><h3>Track</h3></div>
    </div>
  </div>
</section>

<section class="about" id="about">
  <h2 class="section-title">About Us</h2>
  <div class="container">
    <p>Spin Underground Records: Pioneering the Purest Techno Sounds</p>

    <p>Welcome to Spin Underground Records, where the beat is relentless, the bass is pulsating, and the energy is electrifying. We are a cutting-edge record label dedicated exclusively to the relentless pursuit of 100% pure Techno music. Our commitment to the genre runs deep, and we are proud to be the driving force behind some of the most innovative and boundary-pushing tracks in the electronic music scene.</p>

    <p>At the helm of Spin Underground Records is a powerhouse of talent, featuring a stellar lineup of artists who live and breathe Techno. Our roster boasts the likes of CELEC, DJ Deep Noise, Tiento, Ademir, the visionary force MARK HAMILTON, and now, introducing Dark Code - the brainchild of Sasha F (Sami Haapajoki) and his friend Teemu Murtonen.</p>

    <p>Meet the Maestros:</p>

    <p>CELEC: A maestro of rhythm, CELEC crafts Techno symphonies that transcend boundaries. His productions are a fusion of intricate beats and hypnotic melodies, creating an immersive experience for Techno enthusiasts.</p>

    <p>DJ Deep Noise: Dive into the sonic depths with DJ Deep Noise, whose mastery of sound manipulation and seamless mixes catapult listeners into an unparalleled Techno journey. Prepare to be lost in the hypnotic grooves and atmospheric textures.</p>

    <p>Tiento: Tiento's signature style revolves around a perfect blend of dark undertones and driving beats. His tracks are a sonic exploration, taking listeners on a captivating ride through the raw, unfiltered essence of Techno.</p>

    <p>Ademir: Ademir's contributions to Spin Underground Records are a testament to his ability to fuse futuristic elements with classic Techno vibes. His productions are a dynamic convergence of innovation and tradition.</p>

    <p>MARK HAMILTON: The driving force behind Spin Underground Records, MARK HAMILTON, brings his visionary approach to the label. His passion for Techno is evident in every beat, making him an indispensable part of the Techno revolution.</p>

    <p>Dark Code: Emerging from the depths of the Finnish Hard-style scene, Dark Code, spearheaded by Sasha F (Sami Haapajoki) and Teemu Murtonen, brings a relentless energy to the table. With millions of streams on Spotify and a reputation as a legend in the Finnish electronic music scene, Dark Code delivers hard-hitting beats and gritty textures that redefine the boundaries of Techno.</p>

    <p>The Spin Underground Experience:</p>

    <p>Spin Underground Records is not just a label; it's a movement. We invite you to join us on a sonic exploration, where the boundaries of Techno are pushed, and the limits of creativity are shattered. With a commitment to authenticity and a passion for the purest form of Techno, we are here to redefine the genre and set the stage for the future of electronic music.</p>

    <p>Immerse yourself in the pulsating beats, hypnotic rhythms, and avant-garde sounds that define Spin Underground Records. Welcome to the underground revolution.</p>
  </div>
</section>

<?php
get_footer();
