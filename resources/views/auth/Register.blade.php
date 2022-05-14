<x-layouts.app>
    <x-slot name="header">
        Sign up
    </x-slot>
    <form class="py-4 space-y-4" method="post" action="/register">
        @csrf
        <div>
            <div class="w-full px-6 py-8 text-black bg-white rounded shadow-md">
                <input
                    required
                    type="text"
                    class="block w-full p-3 mb-4 border rounded border-grey-light"
                    placeholder="Jon Doe"
                    name="name"
                    placeholder="Full Name" />

                <input
                    required
                    type="text"
                    class="block w-full p-3 mb-4 border rounded border-grey-light"
                    placeholder="Jon-Doe@gmail.com"
                    name="email"
                    placeholder="Email" />

                <input
                    required
                    type="password"
                    class="block w-full p-3 mb-4 border rounded border-grey-light"
                    placeholder="********"
                    name="password"
                    placeholder="Password" />
                {{-- <input
                    required
                    type="password"
                    class="block w-full p-3 mb-4 border rounded border-grey-light"
                    name="confirmed"
                    placeholder="Confirm Password" /> --}}

                <button
                    type="submit"
                    class="w-full py-3 my-1 text-center text-gray-200 bg-green-700 rounded hover:bg-green-dark focus:outline-none"
                >Create Account</button>

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
