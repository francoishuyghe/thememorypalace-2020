import Swup from 'swup';
import SwupGaPlugin from '@swup/ga-plugin';
import SwupBodyClassPlugin from '@swup/body-class-plugin';
import episodes from './episodes';

export default {
  init() {
    // JavaScript to be fired on all pages
    if (!$('body').hasClass('logged-in')) { 
      const swup = new Swup({
        plugins: [
          new SwupBodyClassPlugin(),
          new SwupGaPlugin(),
        ],
      });
      
      swup.on('contentReplaced', initPages);
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired

    initCommon();

    //Shuffle buttons
    $('.shuffle').click(function () {
      // Get a random episode
      $.ajax({
        url: ajax_object.ajax_url,
        method: 'POST',
        data: { action: 'get_random_post' },
      }).done(function (response) {
        let post = JSON.parse(response);
        // Start Playing
        playButton(post.audio.url, post.title, post.ID);
      });
    });


    // Player Play/Pause 
    $('#podcastPlayer .play').click(function () {
      // Find episode on page and toggle playing
      let episodeID = $('#podcastPlayer').data('id');
      $('.episode[data-id="' + episodeID + '"]').toggleClass('playing');

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

  },
};
  
function initCommon() { 
    // Click event on an episode block
    $('.episode .play').click(function () {
      let episode = $(this).parents('.episode');
      if (episode.hasClass('playing')) {
        // Pause playing
        episode.removeClass('playing');
        pauseButton();
      } else { 
        // Start playing
        $('.episode.playing').removeClass('playing');
        episode.addClass('playing');
        playButton(episode.data('audio'), episode.data('title'), episode.data('id'));
      }
    })
}
  
function initPages() {
  console.log('Rerun Init')
  initCommon();

    if (document.querySelector('.page.episodes')) {
      episodes.init();
      episodes.finalize();
    }
  }

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
  $('body').addClass('player-active');
}

//Pause
function pauseButton() { 
  //Stop playing
  $('#podcastPlayer').attr('data-status', 'pause');
  player.pause();
}

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