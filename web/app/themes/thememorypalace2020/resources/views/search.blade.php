@extends('layouts.app')

@section('content')
  <section class="page-content">
    <div class="container">
    @include('partials.page-header')

    @if (!have_posts())
      <div class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
      {!! get_search_form(false) !!}
    @endif

    <section id="episodes">
      <div class="row">
        @while(have_posts()) @php the_post() @endphp
          @php $episode = get_post() @endphp
          @include('partials.episode-block')
        @endwhile
      </div>
    </section>

    {!! get_the_posts_navigation() !!}
    </div>
  </section>
@endsection
