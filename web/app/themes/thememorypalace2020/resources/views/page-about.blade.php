@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="container">
      <div class="row">
        <div class="col-md-6 leftbar">
          <h3> {{ $data['intro'] }}</h3>
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
        </div>
        <div class="col-md-6">
          @php the_content() @endphp
        </div>
      </div>
    </div>
  @endwhile
@endsection
