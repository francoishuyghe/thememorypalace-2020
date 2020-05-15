<div id="podcastPlayer">
  <div class="container">
    <div class="title"></div>
    <div class="row">
      <div class="col-3 playback">
        <a class="minus15"><i class="fal fa-undo"></i></a>
        <a class="play">
          <i class="fas fa-pause"></i>
          <i class="fas fa-play"></i>
        </a>
        <a class="plus15"><i class="fal fa-redo"></i></a>
      </div>
      <div class="col-6 status">
        <div class="timing">
          <span class="current-time"></span>/<span class="full-time"></span>
        </div>
        <div class="playbar">
          <progress id="seek-obj" value="0" max="1"></progress>
        </div>
      </div>
      <div class="col-3 extra">
        <a class="download" target="_blank" href=""><i class="fal fa-arrow-to-bottom"></i></a>
        <a class="volume">volume</a>
      </div>
    </div>
  </div>
  <audio controls ontimeupdate="initProgressBar()">
    <source src="" type="audio/mpeg" id="playerSource">
  </audio>
</div>
<footer class="content-info">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        @php dynamic_sidebar('sidebar-footer') @endphp
      </div>
      <div class="col-md-6">
          {!! wp_nav_menu(['theme_location' => 'footer', 'menu_class' => 'footer-nav']) !!}
      </div>
    </div>
  </div>
</footer>
