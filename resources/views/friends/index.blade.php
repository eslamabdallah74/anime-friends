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
            class="w-full py-3 my-1 text-center text-gray-200 bg-blue-700 rounded hover:bg-green-dark focus:outline-none"
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
        {{-- My Friends --}}
        <div>
            <h1 class="text-xl font-bold text-slate-600">My Friends</h1>
            <div class="mt-4">
                @foreach ($ourFriends as $friend)
                    <h4 class="text-gray-50">
                        <span class="font-semibold text-gray-900">{{ $friend->name }} </span>
                        <span class="text-gray-700">({{ $friend->email }})</span>
                        {{-- Delete --}}
                        {{-- Delete --}}
                        <form class="inline" action="/friends/{{ $friend->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-700 underline">Delete</button>
                        </form>
                    </h4>
                @endforeach
            </div>
        </div>
    @endif
    @if($pendingFriends->count())
        {{-- Pending friends --}}
        <div>
            <h1 class="text-xl font-bold text-slate-600">Pending Friends Requests</h1>
            <div class="mt-4">
                @foreach ($pendingFriends as $friend)
                    <h4 class="text-gray-50">
                        <span class="font-semibold text-gray-900">{{ $friend->name }} </span>
                        <span class="text-gray-700">({{ $friend->email }})</span>
                        {{-- Delete --}}
                        <form class="inline" action="/friends/{{ $friend->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-700 underline">Cancel</button>
                        </form>
                    </h4>

                @endforeach
            </div>
        </div>
    @endif
    @if($friendsRequests->count())
        {{-- Friends Requests --}}
        <div>
            <h1 class="text-xl font-bold text-slate-600">Friends Requests</h1>
            <div class="mt-4">
                @foreach ($friendsRequests as $friend)
                    <h4 class="text-gray-50">
                        <span class="font-semibold text-gray-900">{{ $friend->name }} </span>
                        <span class="text-gray-700">({{ $friend->email }})</span>
                    </h4>
                    {{-- Accept --}}
                    <form class="inline" action="/friends/{{ $friend->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="text-blue-700 underline">Accept</button>
                    </form>
                    {{-- Delete --}}
                    <form class="inline" action="/friends/{{ $friend->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-700 underline">Decline</button>
                    </form>
                @endforeach
            </div>
        </div>
    @endif
    </div>
</x-layouts.app>
