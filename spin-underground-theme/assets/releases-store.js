/**
 * Spin Underground - Releases Store & Audio Preview Player
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    initStoreFilters();
    initAudioPreviewPlayer();
    initCartFeedback();
  });

  /* ==========================================================================
     1. Release Format Filter Tabs
     ========================================================================== */
  function initStoreFilters() {
    var filterBtns = document.querySelectorAll('.store-filter-btn');
    var cards = document.querySelectorAll('.release-card');

    if (!filterBtns.length || !cards.length) return;

    filterBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var filter = this.getAttribute('data-filter');

        filterBtns.forEach(function (b) { b.classList.remove('active'); });
        this.classList.add('active');

        cards.forEach(function (card) {
          var format = (card.getAttribute('data-format') || '').toLowerCase();
          var formatList = format.split(/\s+/);
          if (filter === 'all' || formatList.indexOf(filter) !== -1 || format === filter) {
            card.style.display = 'flex';
            requestAnimationFrame(function () {
              card.style.opacity = '1';
              card.style.transform = 'translateY(0) scale(1)';
            });
          } else {
            card.style.opacity = '0';
            card.style.transform = 'translateY(12px) scale(0.96)';
            setTimeout(function () {
              if (card.style.opacity === '0') {
                card.style.display = 'none';
              }
            }, 250);
          }
        });
      });
    });
  }

  /* ==========================================================================
     2. Interactive Audio Preview Player (Real Audio & Web Audio Synth Demo)
     ========================================================================== */
  function initAudioPreviewPlayer() {
    var playerDock = document.getElementById('previewPlayerDock');
    if (!playerDock) return;

    var dockTitle = document.getElementById('dockTrackTitle');
    var dockArtist = document.getElementById('dockArtistName');
    var dockPlayBtn = document.getElementById('dockPlayPauseBtn');
    var dockBuyBtn = document.getElementById('dockBuyBtn');
    var dockCloseBtn = document.getElementById('dockCloseBtn');
    var dockDisc = document.getElementById('dockDiscThumb');
    var dockTime = document.getElementById('dockTimeDisplay');
    var dockWave = document.getElementById('dockWaveVisualizer');

    var currentPlayingCard = null;
    var isPlaying = false;
    var audioObj = null;
    var synthTimer = null;
    var elapsedSec = 0;
    var maxDuration = 45; // 45s preview
    var audioCtx = null;

    // Web Audio Synthesizer for instant realistic demo techno preview
    function playDemoTechnoSynth() {
      try {
        var AudioContextClass = window.AudioContext || window.webkitAudioContext;
        if (!AudioContextClass) return;
        if (!audioCtx) audioCtx = new AudioContextClass();
        if (audioCtx.state === 'suspended') audioCtx.resume();

        var step = 0;
        var bpm = 130;
        var stepDuration = (60 / bpm) / 4; // 16th note in seconds

        function playKick(time) {
          if (!audioCtx) return;
          var osc = audioCtx.createOscillator();
          var gain = audioCtx.createGain();
          osc.type = 'sine';
          osc.frequency.setValueAtTime(140, time);
          osc.frequency.exponentialRampToValueAtTime(35, time + 0.12);
          gain.gain.setValueAtTime(0.7, time);
          gain.gain.exponentialRampToValueAtTime(0.001, time + 0.22);
          osc.connect(gain);
          gain.connect(audioCtx.destination);
          osc.start(time);
          osc.stop(time + 0.23);
        }

        function playHiHat(time) {
          if (!audioCtx) return;
          // Noise buffer
          var bufferSize = audioCtx.sampleRate * 0.05;
          var buffer = audioCtx.createBuffer(1, bufferSize, audioCtx.sampleRate);
          var data = buffer.getChannelData(0);
          for (var i = 0; i < bufferSize; i++) {
            data[i] = (Math.random() * 2 - 1) * 0.2;
          }
          var noise = audioCtx.createBufferSource();
          noise.buffer = buffer;
          var filter = audioCtx.createBiquadFilter();
          filter.type = 'highpass';
          filter.frequency.value = 7500;
          var gain = audioCtx.createGain();
          gain.gain.setValueAtTime(0.25, time);
          gain.gain.exponentialRampToValueAtTime(0.01, time + 0.045);
          noise.connect(filter);
          filter.connect(gain);
          gain.connect(audioCtx.destination);
          noise.start(time);
        }

        function playBass(time, freq) {
          if (!audioCtx) return;
          var osc = audioCtx.createOscillator();
          var filter = audioCtx.createBiquadFilter();
          var gain = audioCtx.createGain();
          osc.type = 'sawtooth';
          osc.frequency.value = freq;
          filter.type = 'lowpass';
          filter.frequency.setValueAtTime(450, time);
          filter.frequency.exponentialRampToValueAtTime(120, time + 0.15);
          gain.gain.setValueAtTime(0.35, time);
          gain.gain.exponentialRampToValueAtTime(0.01, time + 0.16);
          osc.connect(filter);
          filter.connect(gain);
          gain.connect(audioCtx.destination);
          osc.start(time);
          osc.stop(time + 0.17);
        }

        synthTimer = setInterval(function () {
          if (!isPlaying || !audioCtx) return;
          var now = audioCtx.currentTime;

          // 4-on-the-floor kick
          if (step % 4 === 0) {
            playKick(now);
          }
          // Offbeat hat on 2, 6, 10, 14
          if (step % 4 === 2) {
            playHiHat(now);
          }
          // Rolling sub-bass
          if (step % 2 === 1) {
            var bassFreq = (step % 8 === 7) ? 65.41 : 55.0; // C2 / A1
            playBass(now, bassFreq);
          }

          step = (step + 1) % 16;
        }, stepDuration * 1000);

      } catch (e) {
        console.warn('Web Audio error:', e);
      }
    }

    function stopAllAudio() {
      if (synthTimer) {
        clearInterval(synthTimer);
        synthTimer = null;
      }
      if (audioObj) {
        audioObj.pause();
        audioObj = null;
      }
      if (currentPlayingCard) {
        currentPlayingCard.classList.remove('playing');
        var playBtn = currentPlayingCard.querySelector('.preview-play-btn');
        if (playBtn) playBtn.classList.remove('active');
      }
      isPlaying = false;
      if (dockPlayBtn) {
        dockPlayBtn.innerHTML = '<i class="bi bi-play-fill"></i>';
      }
      if (dockDisc) {
        dockDisc.classList.remove('spinning');
      }
      if (dockWave) {
        dockWave.classList.remove('active');
      }
    }

    var progressInterval = null;
    function startProgress() {
      if (progressInterval) clearInterval(progressInterval);
      progressInterval = setInterval(function () {
        if (!isPlaying) return;
        elapsedSec++;
        if (elapsedSec >= maxDuration) {
          elapsedSec = 0;
        }
        var m = Math.floor(elapsedSec / 60);
        var s = elapsedSec % 60;
        if (dockTime) {
          dockTime.textContent = (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s + ' / 0:45';
        }
      }, 1000);
    }

    function playTrack(card) {
      if (currentPlayingCard === card && isPlaying) {
        // Pause
        stopAllAudio();
        return;
      }

      stopAllAudio();

      currentPlayingCard = card;
      card.classList.add('playing');
      var playBtn = card.querySelector('.preview-play-btn');
      if (playBtn) playBtn.classList.add('active');

      var title = card.getAttribute('data-title') || 'Release';
      var artist = card.getAttribute('data-artist') || 'Spin Underground';
      var audioSrc = card.getAttribute('data-audio') || '';
      var cartUrl = card.getAttribute('data-cart-url') || '#releases';

      if (dockTitle) dockTitle.textContent = title;
      if (dockArtist) dockArtist.textContent = artist;
      if (dockBuyBtn) dockBuyBtn.setAttribute('href', cartUrl);

      // Open player dock
      playerDock.classList.add('visible');
      playerDock.setAttribute('aria-hidden', 'false');

      isPlaying = true;
      if (dockPlayBtn) {
        dockPlayBtn.innerHTML = '<i class="bi bi-pause-fill"></i>';
      }
      if (dockDisc) {
        dockDisc.classList.add('spinning');
      }
      if (dockWave) {
        dockWave.classList.add('active');
      }

      elapsedSec = 0;
      if (dockTime) dockTime.textContent = '00:00 / 0:45';
      startProgress();

      if (audioSrc && audioSrc.startsWith('http')) {
        try {
          audioObj = new Audio(audioSrc);
          audioObj.play().catch(function () {
            playDemoTechnoSynth();
          });
          audioObj.addEventListener('ended', function () {
            stopAllAudio();
          });
        } catch (e) {
          playDemoTechnoSynth();
        }
      } else {
        // Demo sound synthesizer
        playDemoTechnoSynth();
      }
    }

    // Card play button listeners
    document.querySelectorAll('.release-card').forEach(function (card) {
      var playBtn = card.querySelector('.preview-play-btn');
      if (playBtn) {
        playBtn.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          playTrack(card);
        });
      }
    });

    // Dock play/pause button
    if (dockPlayBtn) {
      dockPlayBtn.addEventListener('click', function () {
        if (isPlaying) {
          stopAllAudio();
        } else if (currentPlayingCard) {
          playTrack(currentPlayingCard);
        } else {
          var firstCard = document.querySelector('.release-card');
          if (firstCard) playTrack(firstCard);
        }
      });
    }

    // Close dock
    if (dockCloseBtn) {
      dockCloseBtn.addEventListener('click', function () {
        stopAllAudio();
        playerDock.classList.remove('visible');
        playerDock.setAttribute('aria-hidden', 'true');
        if (progressInterval) clearInterval(progressInterval);
      });
    }
  }

  /* ==========================================================================
     3. Add-to-Cart Feedback & Interaction
     ========================================================================== */
  function initCartFeedback() {
    // Listen to WooCommerce standard AJAX add to cart
    document.body.addEventListener('added_to_cart', function (e, fragments, cart_hash, $button) {
      if ($button && $button.length) {
        var originalHtml = $button.html();
        $button.addClass('added-success').html('<i class="bi bi-check-lg"></i> Added');
        setTimeout(function () {
          $button.removeClass('added-success').html(originalHtml);
        }, 2200);
      }
    });

    // Demo add to cart feedback for demo releases
    document.querySelectorAll('.demo-cart-btn').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var self = this;
        var originalHtml = self.innerHTML;

        self.classList.add('added-success');
        self.innerHTML = '<i class="bi bi-check2"></i> Added!';

        // Bump header cart badge
        var badges = document.querySelectorAll('.cart-count');
        badges.forEach(function (badge) {
          var current = parseInt(badge.textContent, 10) || 0;
          badge.textContent = current + 1;
          badge.classList.add('bump');
          setTimeout(function () { badge.classList.remove('bump'); }, 400);
        });

        setTimeout(function () {
          self.classList.remove('added-success');
          self.innerHTML = originalHtml;
        }, 2000);
      });
    });
  }

})();
