<section id="top">
    Top player
</section>

<section id="episodes">
    <div class="container">
        <h2>Episodes</h2>
        @foreach ($latest_episodes as $episode)
            @include('partials.episode-block')
        @endforeach
        <a class="button" href="/episodes">More Episodes</a>
    </div>
</section>

@php the_content() @endphp
