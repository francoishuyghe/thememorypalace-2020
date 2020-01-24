<section id="top">
    <div class="latest-episode">
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
        <a class="button" href="/episodes">More Episodes</a>
    </div>
</section>

@php the_content() @endphp
