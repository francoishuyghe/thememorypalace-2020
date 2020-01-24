<section id="intro">
    @php the_content() @endphp
</section>

<section id="archive">
    <h2 class="long">Archive</h2>
    <div class="episodes">
        <div class="row">
        @foreach ($episodes as $episode)
            <div class="col-md-4">
                @include('partials.episode-block')
            </div>
        @endforeach
        <div class="row">
    </div>
</section>