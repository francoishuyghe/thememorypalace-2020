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
