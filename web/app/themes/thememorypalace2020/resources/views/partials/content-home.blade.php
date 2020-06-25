@include('partials.color-brightness')

@php $color = get_field('color', $latest_episode[0]->ID) @endphp
<section id="top" class="{{$color}}">
    <div id="intro">
        <div class="intro-wrap">
            {{ the_content() }}
            <a class="button shuffle">Play a Random Episode</a>
        </div>
    </div>
<div id="latestEpisode" class="featured">
        @php $episode = $latest_episode[0] @endphp
        @include('partials.episode-block')
    </div>
</section>

<section id="episodes">
    <div class="container">
        <h2>Episodes</h2>
        @foreach ($episodes as $episode)
            @include('partials.episode-block')
        @endforeach
        <div class="episodes-footer">
            <a class="button dark" href="/episodes">More Episodes</a>
        </div>
    </div>
</section>
