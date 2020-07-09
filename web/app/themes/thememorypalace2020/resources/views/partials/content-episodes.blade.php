<section id="intro">
    @php the_content() @endphp
    <a class="button dark shuffle">Play a Random Episode</a>
</section>

<section id="archive">
    <h2 class="long">Archive</h2>
    <div id="tags">
    {{-- Get all Parents tags --}}
        @php 
        $places = get_terms(array(
            'taxonomy' => 'places',
            'hide_empty' => true,
        ));

        $history = get_terms(array(
            'taxonomy' => 'history',
            'hide_empty' => true,
        ));

        $topics = get_terms(array(
            'taxonomy' => 'topics',
            'hide_empty' => true,
        ));

        $categories = [
            array(
                'name' => 'History',
                'slug' => 'history',
                'terms' => $history
            ),
            array(
                'name' => 'Places',
                'slug' => 'places',
                'terms' => $places
        ),
            array(
                'name' => 'Topics',
                'slug' => 'topics',
                'terms' => $topics
        ),
        ]
        
        @endphp

        <div class="header">
            <a class="favorites">Favorites</a>
            @foreach ($categories as $category)
                <a class="tag-title" data-tags="{{ $category['slug'] }}">{{ $category['name'] }} <i class="fas fa-sort-down"></i><i class="fas fa-sort-up"></i></a>
            @endforeach
            <a class="reset">RESET</a>
        </div>
        @foreach ($categories as $category)
            {{-- If they have children, display them --}}
            <div class="tag-cat" data-tags="{{ $category['slug'] }}">
                @foreach ($category['terms'] as $tag)
                    @if($tag->count > 2)
                        <button data-filter=".{{$tag->slug}}">{{ $tag->name }}</a>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="episodes">
        <div class="gutter-sizer"></div>
        @foreach ($episodes as $episode)
            @include('partials.episode-block')
        @endforeach
    </div>
</section>