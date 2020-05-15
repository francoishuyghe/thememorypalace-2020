@php
$audio = get_field('episode_audio', $episode->ID);
$metadata = [];

if($audio)
{
    $audio_file_path = get_attached_file( $audio['ID'] );
    $metadata = wp_read_audio_metadata( $audio_file_path );
}

$postTags = get_the_tags($episode->ID);
$tagSlugs = '';
if($postTags){
    foreach ($postTags as $tag) {
        $tagSlugs .= ' ' . $tag->slug;
    }
}
@endphp

<div class="episode episode-{{ $episode->ID }}{{ $tagSlugs }}">
    <div class="thumbnail" 
    @if($metadata)
    data-audio="{{ $audio['url'] }}"
    data-title="EPISODE {{ get_field('episode_number', $episode->ID) }}: {{ $episode->post_title }}"
    @endif
    style="background: {{ the_field('color', $episode->ID ) }}">
            <div class="white">
                <div class="image" style="background-image: url({{ get_the_post_thumbnail_url($episode->ID, 'medium') }});"></div>
            </div>
            <div class="play">
                <i class="fas fa-play"></i>
                <i class="fas fa-pause"></i>
            </div>
        </div>
        <div class="info">
            <div class="header">
                {{ get_the_date('', $episode->ID) }} @if($audio) | {{ $metadata['length_formatted'] }}@endif
            </div>
            <div class="title">
                <h5>Episode {{ get_field('episode_number', $episode->ID) }}</h5>
                <h4><a href="{{ get_permalink($episode)}}" >{{ $episode->post_title }}</a></h4>
            </div>
        </div>
</div>