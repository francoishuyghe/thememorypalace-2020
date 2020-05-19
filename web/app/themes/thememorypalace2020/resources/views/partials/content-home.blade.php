@include('partials.color-brightness')

<section id="top">
    @php $color = get_field('color', $latest_episode[0]->ID) @endphp
    <div id="intro" style="background-color: {{$color}}">
        {{ the_content() }}
        <a class="button shuffle">Play a Random Episode</a>
    </div>
<div id="latestEpisode" style="background-color: {{ colourBrightness($color, 0.5) }}">
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
            <a class="button" href="/episodes">More Episodes</a>
        </div>
    </div>
</section>
