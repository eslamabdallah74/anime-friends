<x-layouts.app>
    @guest
    <x-slot name='header'>
        Anime Friends
    </x-slot>
    <div class="mt-8">
        Sign up to get started
    </div>
    @endguest
    @auth
    <x-slot name='header'>
        My Anime
    </x-slot>
    <div class="space-y-6">
        @foreach ($animesByStatus as $status => $animes )
        <div>
            <h1 class="text-xl font-bold text-slate-600">{{ App\Models\Pivot\AnimeUser::$status[$status] }}</h1>
            <div class="grid grid-cols-3 gap-4 mt-4">
                @foreach ($animes as $anime)
                    <div
                     class="{{ $anime->url ? 'text-blue-400 cursor-pointer' : 'text-yellow-50' }} w-full py-10 text-center bg-gray-900  rounded-xl">
                     @if($anime->url)
                        <a href="{{ $anime->url }}" target="_blank"> {{ $anime->name }} </a>
                     @else
                        <div> {{ $anime->name }} </div>
                     @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    @endauth
</x-layouts.app>
