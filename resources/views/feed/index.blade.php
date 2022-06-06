<x-layouts.app>
    <x-slot name='header'>
        Friends Feed
    </x-slot>
    <div class="mt-8">
        @if ($animes->count())
            @foreach ($animes as $anime)
                <div> {{ $anime->user()->first()->name }} {{ $anime->anime_user->action }} {{ $anime->name }} </div>
            @endforeach
        @else
            <div><a class="text-blue-700" href="/friends">Add Friends</a> to see what they are watching</div>
        @endif
    </div>
</x-layouts.app>
