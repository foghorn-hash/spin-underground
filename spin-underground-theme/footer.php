<footer id="contact">
  <div class="container"><p>© <?php echo date('Y'); ?> Spin Underground Records • Tampere, Finland • <a href="mailto:info@spinunderground.fi" style="color:var(--accent);text-decoration:none;">info@spinunderground.fi</a></p></div>
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
  const burger=document.getElementById('burger');
  // There are two overlay elements with id="overlay" in the original HTML.
  // Using querySelectorAll to handle all overlays if needed, but the original code just uses getElementById.
  // Let's stick to the original logic, assuming the first overlay is the main one.
  const overlays=document.querySelectorAll('.overlay');
  const closeBtns=document.querySelectorAll('.close-btn');
  
  function openMenu(){
    overlays.forEach(overlay => overlay.classList.add('open'));
  }
  function closeMenu(){
    overlays.forEach(overlay => overlay.classList.remove('open'));
  }
  if(burger) burger.addEventListener('click',openMenu);
  closeBtns.forEach(btn => btn.addEventListener('click',closeMenu));
</script>
<?php wp_footer(); ?>
</body>
</html>
