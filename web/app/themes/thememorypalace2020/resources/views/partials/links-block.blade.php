@if($data['links'])
    <div class="links">
    <h2>Press</h2>
    <ul>
    @foreach ($data['links'] as $link)
        <li>
        <a href="{{ $link['link'] }}" target="_blank">
            {{ $link['text'] }}
        </a>
        </li>
    @endforeach
    </ul>
</div>
@endif