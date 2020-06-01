<header class="banner">
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
    <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
  @php 
    $postColor = get_field('color');
    if(!$postColor){
      $postColor = App::themeColor();
    }
  @endphp 
  <a class="subscribe {{ $postColor }}" target="_blank" href="https://podcasts.apple.com/podcast/the-memory-palace/id299436963">Subscribe</a>
</header>
