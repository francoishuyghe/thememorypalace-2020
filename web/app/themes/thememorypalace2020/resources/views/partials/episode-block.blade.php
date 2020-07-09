@php
$audio = get_field('episode_audio', $episode->ID);
$metadata = [];

if($audio)
{
    $audio_file_path = get_attached_file( $audio['ID'] );
    $metadata = wp_read_audio_metadata( $audio_file_path );
}

$postHistory = get_the_terms($episode->ID, 'history');
$postPlaces = get_the_terms($episode->ID, 'places');
$postTopics = get_the_terms($episode->ID, 'topics');

$tagSlugs = '';
if($postHistory){
    foreach ($postHistory as $tag) {
        $tagSlugs .= ' ' . $tag->slug;
    }
}
if($postPlaces){
    foreach ($postPlaces as $tag) {
        $tagSlugs .= ' ' . $tag->slug;
    }
}
if($postTopics){
    foreach ($postTopics as $tag) {
        $tagSlugs .= ' ' . $tag->slug;
    }
}

$permalink = get_permalink($episode);
@endphp

<div class="episode episode-{{ $episode->ID }}{{ $tagSlugs }} @if(in_category(1363, $episode->ID)) favorite @endif"
    data-audio="{{ $audio['url'] }}"
    data-title="EPISODE {{ get_field('episode_number', $episode->ID) }}: {{ $episode->post_title }}"
    data-id="{{ $episode->ID }}"
    data-permalink="{{ $permalink }}">

    <a href="{{ $permalink }}" >
        <div class="thumbnail-wrap">
            <div class="thumbnail {{ the_field('color', $episode->ID ) }}">
                <div class="white">
                    <div class="image" style="background-image: url({{ get_the_post_thumbnail_url($episode->ID, 'medium') }});"></div>
                </div>
            </div>
        </div>
    </a>

    <div class="info">
        <div class="title">
            <h5>Episode {{ get_field('episode_number', $episode->ID) }}</h5>
            <h4><a href="{{ $permalink }}" >{{ $episode->post_title }}</a></h4>
        </div>
        <div class="player">
            <div class="play-wrap">
                <div class="play">
                    <i class="fas fa-play"></i>
                    <i class="fas fa-pause"></i>
                </div>
            </div>
            <div class="length">
                @if($audio){{ $metadata['length_formatted'] }}@endif
            </div>
        </div>
    </div>
</div>