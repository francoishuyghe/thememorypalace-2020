<section id="intro">
    @php the_content() @endphp
</section>

<section id="archive">
    <div class="episodes">
        <div class="gutter-sizer"></div>
        @while(have_posts()) @php the_post() @endphp
            @php $episode = $post @endphp
            @include('partials.episode-block')
        @endwhile
    </div>
</section>