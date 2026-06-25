<footer id="contact">
  <div class="container"><p>© <?php echo date('Y'); ?> Spin Underground Records • Tampere, Finland • <a href="mailto:info@spinunderground.fi" style="color:var(--accent);text-decoration:none;">info@spinunderground.fi</a> • <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" style="color:var(--accent);text-decoration:none;">Privacy Policy</a></p></div>
</footer>
<button id="scrollToTopBtn" title="Scroll to top">↑</button>
<script>
  // Get the button
  const scrollToTopBtn = document.getElementById("scrollToTopBtn");

  // Show the button when the user scrolls down 100px
  window.onscroll = function () {
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
          scrollToTopBtn.style.display = "block";
      } else {
          scrollToTopBtn.style.display = "none";
      }
  };

  // Scroll to the top when the button is clicked
  scrollToTopBtn.onclick = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
  };
  const burger = document.getElementById('burger');
  const navLinks = document.getElementById('navLinks');

  // Toggle mobile nav by toggling the .open class on the existing #navLinks
  function toggleMenu() {
    if (!navLinks) return;
    navLinks.classList.toggle('open');
    // Optional: toggle a class on the burger for simple animation styling
    if (burger) burger.classList.toggle('open');
  }

  if (burger) burger.addEventListener('click', toggleMenu);

  // Close the mobile nav when a link is clicked (useful on small screens)
  if (navLinks) {
    navLinks.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        if (navLinks.classList.contains('open')) navLinks.classList.remove('open');
        if (burger) burger.classList.remove('open');
      });
    });
  }
</script>
<?php wp_footer(); ?>
</body>
</html>
