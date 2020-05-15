<section id="intro">
    @php the_content() @endphp
</section>

<section id="archive">
    <h2 class="long">Archive</h2>
    <div id="tags">
        {{-- Get all Parents tags --}}
        @php 
            $args = array(
                'orderby' => 'name',
                'order' => 'ASC',
                'include' => [1322, 1320, 1321]
                );
            $parent_tags = get_tags($args);
        @endphp

        <div class="header">
            <a class="favorites">Favorites</a>
            @foreach ($parent_tags as $parent_tag)
                <a class="tag-title" data-tags="{{ $parent_tag->slug }}">{{ $parent_tag->name }} <i class="fas fa-sort-down"></i><i class="fas fa-sort-up"></i></a>
            @endforeach
            <a class="reset">RESET</a>
        </div>
        @foreach ($parent_tags as $parent_tag)
            {{-- If they have children, display them --}}
            @php
            $children_tags = get_tags(array( 'child_of' => $parent_tag->term_id ));
            @endphp
            @if($children_tags)
            <div class="tag-cat" data-tags="{{ $parent_tag->slug }}">
                @foreach ($children_tags as $tag)
                    @if($tag->count > 1)
                        <button data-filter=".{{$tag->slug}}">{{ $tag->name }}</a>
                    @endif
                @endforeach
            </div>
            @endif
        @endforeach
    </div>
    <div class="episodes">
        <div class="gutter-sizer"></div>
        @foreach ($episodes as $episode)
            @include('partials.episode-block')
        @endforeach
    </div>
</section>