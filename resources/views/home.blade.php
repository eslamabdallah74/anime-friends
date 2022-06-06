<x-layouts.app>
    @guest
    <x-slot name='header'>
        <h1 class="p-2 text-center bg-gray-900 rounded-md text-gray-50">Anime Friends</h1>
    </x-slot>
    <div class="mt-8">
        <x-welcome-message></x-welcome-message>
    </div>
    @endguest
    @auth
    <x-slot name='header'>
        My Anime
    </x-slot>

    @if($animesByStatus->count() > 0)
    <div class="space-y-6">
        @foreach ($animesByStatus as $status => $animes )
        <div>
            <h1 class="text-xl font-bold text-slate-600">{{ App\Models\Pivot\AnimeUser::$status[$status] }}</h1>
            <div class="grid grid-cols-3 gap-4 mt-4">
                @foreach ($animes as $anime)
                <div class="relative w-full py-10 text-center bg-gray-900 rounded-xl text-yellow-50">
                    {{-- Anime Link --}}
                    @if($anime->url)
                    <a href="{{ $anime->url }}" target="_blank">
                        <span class="absolute text-blue-700 left-4 top-3">
                            Link
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="inline-block bi bi-link" viewBox="0 0 16 16">
                                <path
                                    d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z" />
                                <path
                                    d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z" />
                            </svg>
                        </span>
                    </a>
                    @endif
                    {{-- Edit Icon --}}
                    <a href="/anime/{{ $anime->id }}/edit">
                        <span class="absolute right-10 top-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="text-green-600 bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </span>
                    </a>
                    {{-- Delete Icon --}}
                    <form action="{{ route('anime.destroy' , ['anime' => $anime->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <span class="absolute top-3 right-3">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="text-red-600 bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </button>
                        </span>
                    </form>
                    <div> {{ $anime->name }} </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    @else
    <a class="text-blue-700" href="/anime/create">Add animes</a>
    @endif
        {{-- Flash message --}}
        @if ($message = Session::get('deleted'))
        <div class="p-4 text-center text-gray-200 bg-green-700 rounded-md">
            <button type="button" class="close" data-dismiss="alert">*</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif
    @endauth
</x-layouts.app>
