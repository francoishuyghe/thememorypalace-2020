@extends('layouts.app')

@section('content')

  <div class="container">
  <section id="intro">
    <h1>{{ single_cat_title() }}</h1>
    @php the_archive_description( '<div class="taxonomy-description">', '</div>' );  @endphp
  </section>

  <section id="archive">
    <div class="episodes">
        <div class="gutter-sizer"></div>
        @while(have_posts()) @php the_post() @endphp
            @php $episode = get_post() @endphp
            @include('partials.episode-block')
        @endwhile
    </div>
  </section>
  </div>
@endsection
