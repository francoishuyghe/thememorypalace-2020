@include('partials.color-brightness')

<section id="top" class="{{ the_field('color') }}">
  <div class="container">
    @php $episode = $post; @endphp
    @include('partials.episode-block')
  </div>
</section>
<section id="episodeContent">
  <div class="container">
      <article {!! post_class() !!}>
        <div class="entry-content">
          @php the_content() @endphp
          <div class="notes">
            {!! get_field('episodes_text', 'option') !!}
          </div>
        </div>
      </article>
  </div>
</section>