<div class="episode episode-{{ $episode->ID }}">
    <div class="row">
        <div class="thumbnail" style="background: {{ the_field('color', $episode->ID ) }}">
            <div class="white">
                <div class="image" style="background-image: url({{ get_the_post_thumbnail_url($episode->ID, 'medium') }});"></div>
            </div>
        </div>
        <div class="info">
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