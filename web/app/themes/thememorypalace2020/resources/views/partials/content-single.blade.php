@include('partials.color-brightness')

<section id="top">
  @php $color = get_field('color') @endphp
  <div id="content" style="background-color: {{$color}}">
      <article {!! post_class() !!}>
        <div class="entry-content">
          @php the_content() @endphp
        </div>
        <footer>
          {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
        </footer>
    </article>
  </div>
  <div id="episode" style="background-color: {{ colourBrightness($color, 0.5) }}">
    @php $episode = $post @endphp
    @include('partials.episode-block')
  </div>
</section>