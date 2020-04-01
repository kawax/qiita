<li class="list-group-item">
    <time>{{ \Carbon\Carbon::parse($item['created_at'])->toDateString()  }}</time>

    <a href="{{ $item['url'] }}"
       class="font-weight-bold"
       target="_blank"
       rel="noreferrer noopener">
        {{ $item['title'] }}
    </a>

    @if(! $item['private'])
        <form action="{{ route('delete', $item['id']) }}" method="POST">
            @csrf
            @method('DELETE')
            <input class="btn btn-outline-danger btn-sm" type="submit" value="削除">
        </form>
    @endif
</li>
