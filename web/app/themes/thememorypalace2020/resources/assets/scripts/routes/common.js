export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired

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

      if (player.currentTime == player.duration) {
        //document.getElementById('play-btn').className = '';
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

    $('.episode').on('click', '.thumbnail', function () {

      if ($(this).hasClass('playing')) {
        //Stop playing
        $(this).removeClass('playing');
        $('#podcastPlayer').attr('data-status', 'pause');
        player.pause();

      } else { 
        //Start playing
        $(this).addClass('playing');
        $('#podcastPlayer').attr('data-status', 'play');
        
        // Add podcast info
        $('#playerSource').attr('src', $(this).data('audio'));
        $('#podcastPlayer .title').html($(this).data('title'));
        $('#podcastPlayer .full-time').html($(this).data('length-formatted'));
        $('#podcastPlayer .download').attr('href', $(this).data('audio'));
        
        player.load();
        console.log(player)
        player.ontimeupdate = initProgressBar;
        initVolume();
        player.play();
        $('#podcastPlayer').addClass('active');
      }
    })

    // Player Play/Pause
    $('#podcastPlayer').on('click', '.play', function () {
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
