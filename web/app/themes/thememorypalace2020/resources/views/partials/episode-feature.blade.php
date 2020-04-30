<div class="episode-feature episode-{{ $episode->ID }}">
    <div class="row">
        <div class="col-md-4 play">
            <span class="play"><i class="fal fa-play"></i></span>
        </div>
        <div class="col-md-8 info">
            <div class="header">
                Episode "index"
            </div>
            <div class="title">
                <h4><a href="{{ get_permalink($episode)}}" >{{ $episode->post_title }}</a></h4>
            </div>
        </div>
    <div class="thumbnail" style="background: {{ the_field('color', $episode->ID ) }}">
            <div class="white">
                <div class="image" style="background-image: url({{ get_the_post_thumbnail_url($episode->ID, 'medium') }});"></div>
            </div>
        </div>
    </div>
</div>