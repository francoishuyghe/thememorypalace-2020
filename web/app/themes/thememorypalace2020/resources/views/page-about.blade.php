@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  <section class="page-content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 leftbar">
          <div class="intro">
            {!! $data['intro'] !!}
          </div>
          @if($data['links'])
          <div class="links">
            <ul>
            @foreach ($data['links'] as $link)
              <li>
                <a href="{{ $link['link'] }}" target="_blank">
                  {{ $link['text'] }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        @endif
        </div>
        <div class="col-md-6">
          @php the_content() @endphp
        </div>
      </div>
    </div>
  </section>
  @endwhile
@endsection
