<x-layouts.app>
    <x-slot name='header'>
        Feed
    </x-slot>
    <div class="mt-8">
        @if ($animes->count())
            @foreach ($animes as $anime)
                <ol class="my-2 list-disc">
                    <li>
                        <span class="font-bold">{{ $anime->user()->first()->name }}</span>
                        {{ $anime->anime_user->action }}
                        <a href="{{ $anime->url }}" target="_blank" class="{{ $anime->url ? 'text-blue-700' : '' }}">{{ $anime->name }}</a>
                    </li>
                </ol>
            @endforeach
        @else
            <div><a class="text-blue-700" href="/friends">Add Friends</a> to see what they are watching</div>
        @endif
    </div>
</x-layouts.app>
