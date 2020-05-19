import barba from '@barba/core';
import gsap from 'gsap';

export default {
  init() {
    // JavaScript to be fired on all pages
    var bodyClasses;

    console.log('Barba init');
    barba.init({
      transitions: [{
        name: 'default-transition',
        leave(data) {
          return gsap.to(data.current.container, {
            opacity: 0,
          });
        },
        enter(data) {
          //Get new body classes
          let response = data.next.html.replace(/(<\/?)body( .+?)?>/gi, '$1notbody$2>', data.next.html);
          bodyClasses = $(response).filter('notbody').attr('class');
          $('body').attr('class', bodyClasses);

          //Animate it in
          return gsap.from(data.next.container, {
            opacity: 0,
          });
        },
      }],
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired


    //Shuffle buttons
    $('.shuffle').click(function () {
      // Get a random episode
      $.ajax({
        url: ajax_object.ajax_url,
        method: 'POST',
        data: { action: 'get_random_post' },
      }).done(function (response) {
        let post = JSON.parse(response);
        console.log(post)
        // Start Playing
        playButton(post.audio, post.title, post.ID);
      });
    });

    // Player Settings
    let player = $('#podcastPlayer audio')[0];
    let volumeControl = $('#volume');

    function initProgressBar() {
      var length = player.duration || 0;
      var current_time = player.currentTime;

      // calculate total length of value
      var totalLength = calculateTotalValue(length)
      $('.full-time').html(totalLength);

      // calculate current value time
      var currentTime = calculateCurrentValue(current_time);
      $('.current-time').html(currentTime);

      var progressbar = $('#seek-obj');
      progressbar.val(current_time / length);
      progressbar.on('click', seek);

      //When the track ends
      if (player.currentTime == player.duration) {
        // Find episode on page and toggle playing
        let episodeID = $('#podcastPlayer').data('id');
        $('.thumbnail[data-id="' + episodeID + '"]').toggleClass('playing');
      }

      function seek(event) {
        var percent = event.offsetX / this.offsetWidth;
        player.currentTime = percent * player.duration;
        progressbar.value = percent / 100;
      }
    }

    function initVolume() {

      volumeControl.val(100);

      // Volume Slider Control
      volumeControl.change(function () {
        let newVolume = $(this).val() / 100;
        player.volume = newVolume;

        if (newVolume == 0) {
          $('.volume-wrap').addClass('muted');
        } else {
          $('.volume-wrap').removeClass('muted');
        }
      });

      // Mute/Unmute
      $('.volume-button').click(function () {
        if (player.volume == 0) {
          //unmute and turn volume to 100
          volumeControl.val(100);
          player.volume = 1;
          $('.volume-wrap').removeClass('muted');
        } else {
          //mute
          volumeControl.val(0);
          player.volume = 0;
          $('.volume-wrap').addClass('muted');
        }
      });
    }

    // Play
    function playButton(audio, title, id) {
      console.log('Info: ', audio, title, id)
      // Add podcast info
      $('#podcastPlayer .title').html(title);
      $('#podcastPlayer').data('id', id);
      $('#playerSource').attr('src', audio);
      $('#podcastPlayer .download').attr('href', audio);
        
      player.load();
      player.ontimeupdate = initProgressBar;
      initVolume();
      player.play();
      $('#podcastPlayer').attr('data-status', 'play');
      $('#podcastPlayer').addClass('active');
    }

    //Pause
    function pauseButton() { 
      //Stop playing
      $('#podcastPlayer').attr('data-status', 'pause');
      player.pause();
    }

    // Click event on an episode block
    $('.episode').on('click', '.thumbnail', function () {
      if ($(this).hasClass('playing')) {
        // Pause playing
        $(this).removeClass('playing');
        pauseButton();
      } else { 
        // Start playing
        $('.thumbnail.playing').removeClass('playing');
        $(this).addClass('playing');
        playButton($(this).data('audio'), $(this).data('title'), $(this).data('id'));
      }
    })

    // Player Play/Pause
    $('#podcastPlayer').on('click', '.play', function () {
      // Find episode on page and toggle playing
      let episodeID = $('#podcastPlayer').data('id');
      $('.thumbnail[data-id="' + episodeID + '"]').toggleClass('playing');

      if (player.paused) {
        player.play();
        $('#podcastPlayer').attr('data-status', 'play');
      } else {
        player.pause();
        $('#podcastPlayer').attr('data-status', 'pause');
      }
    });

    // Skip 10 seconds
    $('#podcastPlayer').on('click', '.plus15', function () {
      player.currentTime += 10;
    });

    // Go back 10 seconds
    $('#podcastPlayer').on('click', '.minus15', function () {
      player.currentTime -= 10;
    });

    //Calculate Total Value
    function calculateTotalValue(length) {
      var minutes = Math.floor(length / 60),
        seconds_int = length - minutes * 60,
        seconds_str = seconds_int.toString(),
        seconds = seconds_str.substr(0, 2),
        time = minutes + ':' + seconds
    
      return time;
    }

    //Calculate Current Value
    function calculateCurrentValue(currentTime) {
      var current_minute = parseInt(currentTime / 60) % 60,
        current_seconds_long = currentTime % 60,
        current_seconds = current_seconds_long.toFixed(),
        current_time = (current_minute < 10 ? '0' + current_minute : current_minute) + ':' + (current_seconds < 10 ? '0' + current_seconds : current_seconds);
    
      return current_time;
    }

  },
};
