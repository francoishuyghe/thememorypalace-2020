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
        @foreach ($parent_tags as $parent_tag)
            {{-- If they have children, display them --}}
            @php
            $children_tags = get_tags(array( 'child_of' => $parent_tag->term_id ));
            @endphp
            @if($children_tags)
            <div class="tag-cat">
                <h3>{{ $parent_tag->name }}</h3>
                @foreach ($children_tags as $tag)
                    @if($tag->count > 1)
                        <a class="button" data-slug="{{$tag->slug}}">{{ $tag->name }}</a>
                    @endif
                @endforeach
            </div>
            @endif
        @endforeach
    </div>
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