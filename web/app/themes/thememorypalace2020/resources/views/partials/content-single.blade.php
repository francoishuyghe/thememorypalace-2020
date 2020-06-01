@include('partials.color-brightness')

<section id="top" class="{{ the_field('color') }}">
  <div id="content">
      <article {!! post_class() !!}>
        <div class="entry-content">
          @php the_content() @endphp
        </div>
        <footer>
          {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
        </footer>
    </article>
  </div>
  <div id="episode">
    @php $episode = $post @endphp
    @include('partials.episode-block')
  </div>
</section>