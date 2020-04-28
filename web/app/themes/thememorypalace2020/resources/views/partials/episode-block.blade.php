<div class="episode episode-{{ $episode->ID }}">
    <div class="row">
        <div class="col-md-4 thumbnail">
            {!! get_the_post_thumbnail($episode->ID, 'medium') !!}
        </div>
        <div class="col-md-8 info">
            <div class="header">
                {{ get_the_date('', $episode->ID) }}
            </div>
            <div class="title">
                <h4><a href="{{ get_permalink($episode)}}" >{{ $episode->post_title }}</a></h4>
            </div>
            <div class="footer">
                <span class="play"><i class="fal fa-play-circle"></i> PLAY</span>
                <span class="info"><i class="fal fa-info-circle"></i></span>
            </div>
        </div>
    </div>
</div>