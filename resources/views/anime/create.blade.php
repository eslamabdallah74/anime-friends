<x-layouts.app>
    <x-slot name="header">
        Add Anime
    </x-slot>
    <form class="py-4 space-y-4" method="post" action="/anime">
        @csrf
        <div>
            <div class="w-full px-6 py-8 text-black bg-white rounded shadow-md">
                {{-- Anime name --}}
                <div class="flex flex-row">
                    <label style="min-width: 15%;margin:auto;" for="name">Anime name</label>
                    <input
                    type="text"
                    class="block w-full p-3 my-4 border rounded border-grey-light"
                    id="name"
                    name="name"
                    placeholder="Type Anime name" />
                </div>
                {{-- Anime Url --}}
                <div class="flex flex-row">
                    <label style="min-width: 15%;margin:auto;" for="url">Anime Url</label>
                    <input
                    type="text"
                    id="url"
                    class="block w-full p-3 my-4 border rounded border-grey-light"
                    name="url"
                    placeholder="Type Anime website 'URL'" />
                </div>
                {{-- Anime status --}}
                <div class="flex flex-row">
                    <label style="min-width: 15%;margin:auto;" for="status">Status</label>
                    <select
                    id="status"
                    class="block w-full p-3 my-4 border rounded border-grey-light"
                    name="url"
                    placeholder="Type Anime website 'URL'">
                        @foreach (App\Models\Pivot\AnimeUser::$status as $key => $state )
                            <option value="{{ $key }}">{{ $state }}</option>
                        @endforeach
                    </select>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 my-1 text-center text-gray-200 bg-green-700 rounded hover:bg-green-dark focus:outline-none"
                >Add New Anime</button>

            </div>
        </div>
        @if ($errors->any())
            <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</x-layouts.app>
