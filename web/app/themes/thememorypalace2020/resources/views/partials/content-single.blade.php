@include('partials.color-brightness')

<section id="episodeContent">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        @php $episode = $post; @endphp
        @include('partials.episode-block')
      </div>
      <div class="col-md-8">
      <article {!! post_class() !!}>
        <div class="entry-content">
          <h1>{{ the_title() }}</h1>
          <p>Published on {{ get_the_date('', $episode->ID) }} </p>
          @php the_content() @endphp
          <div class="notes">
            {!! get_field('episodes_text', 'option') !!}
          </div>
        </div>
      </article>
    </div>
  </div>
</section>