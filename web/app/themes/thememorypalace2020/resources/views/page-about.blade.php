@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="container">
      <div class="row">
        <div class="col-md-6 leftbar">
          <div class="intro">
            {!! $data['intro'] !!}
          </div>
          @include('partials/links-block')
        </div>
        <div class="col-md-6 rightcontent">
          @php the_content() @endphp
          @include('partials/links-block')
        </div>
      </div>
    </div>
  @endwhile
@endsection
