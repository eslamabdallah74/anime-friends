<x-layouts.app>
    <x-slot name='header'>
        Friends
    </x-slot>
    <div class="space-y-6">
    {{-- Add Friend --}}
    <div class="w-full px-6 py-8 text-black bg-white rounded shadow-md">
        <form action="/friends" method="post">
        @csrf
        {{-- <div> <button class="flex items-start justify-center p-2 mx-auto text-gray-200 bg-blue-500 rounded-md">Add Friend</button> </div> --}}
            {{-- Anime name --}}
            <div class="flex flex-row">
                <label style="min-width: 15%;margin:auto;" for="name">Friend Email</label>
                <input
                type="email"
                class="block w-full p-3 my-4 border rounded border-grey-light"
                id="name"
                name="email"
                placeholder="Type Friend Email" />
            </div>
            <button
            type="submit"
            class="w-full py-3 my-1 text-center text-gray-200 bg-green-700 rounded hover:bg-green-dark focus:outline-none"
            >Add New Friend</button>
            {{-- Errors --}}
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
    </div>
    @if($ourFriends->count())
        {{-- Friends --}}
        <div>
            <h1 class="text-xl font-bold text-slate-600">My Friends</h1>
            <div class="grid grid-cols-3 gap-4 mt-4">
                @foreach ($ourFriends as $friend)
                    <p>{{ $friend->name }}</p>
                @endforeach
            </div>
        </div>
    @endif
    @if($pendingFriends->count())
        {{-- Pending friends --}}
        <div>
            <h1 class="text-xl font-bold text-slate-600">Pending Friends Requests</h1>
            <div class="grid grid-cols-3 gap-4 mt-4">
                @foreach ($pendingFriends as $friend)
                    <p>{{ $friend->name }}</p>
                @endforeach
            </div>
        </div>
    @endif
    @if($friendsRequests->count())
        {{-- Friends Requests --}}
        <div>
            <h1 class="text-xl font-bold text-slate-600">Friends Requests</h1>
            <div class="grid grid-cols-3 gap-4 mt-4">
                @foreach ($friendsRequests as $friend)
                    <p>{{ $friend->name }}</p>
                @endforeach
            </div>
        </div>
    @endif
    </div>
</x-layouts.app>