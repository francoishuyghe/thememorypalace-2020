<div class="episode episode-{{ $episode->ID }}">
    <div class="row">
        <div class="col-md-4">
            {!! get_the_post_thumbnail($episode->ID, 'medium') !!}
        </div>
        <div class="col-md-8">
            <h4><a href="{{ get_permalink($episode)}}" >{{ $episode->post_title }}</a></h4>
        </div>
    </div>
</div>