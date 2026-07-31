<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Chirper</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <header class="bg-white shadow-sm">
        <div class="max-w-2xl mx-auto px-4 py-4 flex justify-between items-center">
            <span class="text-xl font-bold text-gray-800">Laravel <span class="text-red-500">Chirper</span></span>

            @if (auth()->check())
                <div class="flex items-center gap-4">
                    <span class="text-gray-600 text-sm">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-gray-500 hover:text-gray-800">Log Out</button>
                    </form>
                </div>
            @else
                <div class="flex gap-2">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm rounded border border-gray-300 hover:bg-gray-50">Sign In</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm rounded bg-blue-600 text-white hover:bg-blue-700">Sign Up</a>
                </div>
            @endif
        </div>
    </header>

    <main class="max-w-2xl mx-auto mt-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Latest Chirps</h1>

        @if (auth()->check())
            <form action="{{ route('chirps.store') }}" method="POST" class="mb-6 bg-white p-4 rounded-lg shadow-sm">
                @csrf
                <textarea name="body" placeholder="What's on your mind?"
                    class="w-full border rounded p-2" rows="3"></textarea>
                @error('body')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <div class="flex justify-end mt-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Chirp</button>
                </div>
            </form>
        @endif

        @foreach ($chirps as $chirp)
            <div class="bg-white p-4 rounded-lg shadow-sm mb-4 flex gap-3">
                <div class="w-10 h-10 rounded-full bg-teal-500 text-white flex items-center justify-center font-bold shrink-0">
                    {{ strtoupper(substr($chirp->user->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <div class="flex justify-between">
                        <span class="font-bold">{{ $chirp->user->name }}</span>
                        <small class="text-gray-500">
                            {{ $chirp->created_at->diffForHumans() }}
                            @if ($chirp->created_at != $chirp->updated_at) &middot; Edited @endif
                        </small>
                    </div>
                    <p class="text-gray-700">{{ $chirp->body }}</p>

                    @if (auth()->check() && $chirp->user->is(auth()->user()))
                        <div class="mt-2 text-sm">
                            <a href="{{ route('chirps.edit', $chirp) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('chirps.destroy', $chirp) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-500 ml-2">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </main>

</body>
</html>