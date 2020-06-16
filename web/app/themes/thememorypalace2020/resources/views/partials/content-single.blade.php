@include('partials.color-brightness')

<section id="top" class="{{ the_field('color') }}">
  <div id="content">
      <article {!! post_class() !!}>
        <div class="entry-content">
          @php the_content() @endphp
        </div>
      </article>
  </div>
  <div id="episode" class="featured">
    @php $episode = $post; @endphp
    @include('partials.episode-block')
  </div>
</section>