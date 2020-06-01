<div id="podcastPlayer">
  <div class="container">
    <div class="title"></div>
      <div class="playback">
        <a class="minus15"><i class="fal fa-undo"></i></a>
        <a class="play">
          <i class="fas fa-pause"></i>
          <i class="fas fa-play"></i>
        </a>
        <a class="plus15"><i class="fal fa-redo"></i></a>
      </div>
      <div class="status">
        <div class="timing">
          <span class="current-time"></span>/<span class="full-time"></span>
        </div>
        <div class="playbar">
          <progress id="seek-obj" value="0" max="1"></progress>
        </div>
      </div>
      <div class="extra">
        <a class="download" target="_blank" href=""><i class="fal fa-arrow-to-bottom"></i></a>
        <div class="volume-wrap">
          <div class="volume-button">
            <i class="fas fa-volume"></i>
            <i class="fas fa-volume-off"></i>
          </div>
          <div class="volume-slider">
            <input type="range" id="volume" name="volume" min="0" max="100">
          </div>
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
      <div class="col-md-6 footer-widget">
        @php dynamic_sidebar('sidebar-footer') @endphp
      </div>
      <div class="col-md-6 footer-menu">
          {!! wp_nav_menu(['theme_location' => 'footer', 'menu_class' => 'footer-nav']) !!}
      </div>
    </div>
  </div>
</footer>
