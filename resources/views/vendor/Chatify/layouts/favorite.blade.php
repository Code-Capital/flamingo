<div class="favorite-list-item">
    @if ($data)
        <div data-channel="{{ $channel_id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{ $data->avatar }}');">
        </div>
        @if ($data->name)
            <p>{{ strlen($data->name) > 5 ? substr($data->name, 0, 6) . '..' : $data->name }}</p>
        @else
            <p>{{ strlen($data->user_name) > 5 ? substr($data->user_name, 0, 6) . '..' : $data->user_name }}</p>
        @endif
    @endif
</div>
