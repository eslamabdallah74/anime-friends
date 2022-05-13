<x-layouts.app>
    <x-slot name="header">
        Login
    </x-slot>
    <form class="py-4 space-y-4" method="post" action="/login">
        @csrf
        <div>
            <div class="w-full px-6 py-8 text-black bg-white rounded shadow-md">
                <input
                    required
                    type="text"
                    class="block w-full p-3 mb-4 border rounded border-grey-light"
                    name="email"
                    placeholder="Email" />

                <input
                    required
                    type="password"
                    class="block w-full p-3 mb-4 border rounded border-grey-light"
                    name="password"
                    placeholder="Password" />
                <button
                    type="submit"
                    class="w-full py-3 my-1 text-center text-gray-200 bg-green-700 rounded hover:bg-green-dark focus:outline-none"
                >Login</button>

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
