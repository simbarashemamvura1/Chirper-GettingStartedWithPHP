<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Chirper</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/2.44.0/iconfont/tabler-icons.min.css">
</head>
<body class="bg-gray-100 min-h-screen">

    <header class="bg-white shadow-sm">
        <div class="max-w-2xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.jpg') }}" alt="Chirper logo" class="w-9 h-9 rounded-full object-cover">
                <span class="text-xl font-bold text-gray-800">Laravel <span class="text-amber-800">Chirper</span></span>
            </div>

            @if (auth()->check())
                <div class="flex items-center gap-4">
                    <span class="text-gray-600 text-sm">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-amber-800 hover:text-amber-900 flex items-center gap-1">
                            Log Out <i class="ti ti-feather"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="flex gap-2">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm rounded border border-amber-800 text-amber-800 hover:bg-amber-50 flex items-center gap-1">
                        Sign In <i class="ti ti-feather"></i>
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm rounded bg-amber-800 text-white hover:bg-amber-900 flex items-center gap-1">
                        Sign Up <i class="ti ti-feather"></i>
                    </a>
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
                    <button class="bg-amber-800 text-white px-4 py-2 rounded hover:bg-amber-900 flex items-center gap-1">
                        Chirp <i class="ti ti-feather"></i>
                    </button>
                </div>
            </form>
        @endif

  @foreach ($chirps as $chirp)
    @php
        $avatarColors = ['bg-teal-500', 'bg-amber-600', 'bg-purple-500', 'bg-pink-500', 'bg-blue-500', 'bg-green-600', 'bg-orange-500', 'bg-indigo-500'];
        $colorIndex = crc32($chirp->user->id) % count($avatarColors);
    @endphp
    <div class="bg-white p-4 rounded-lg shadow-sm mb-4 flex gap-3">
        <div class="w-10 h-10 rounded-full {{ $avatarColors[$colorIndex] }} text-white flex items-center justify-center font-bold shrink-0">
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
                <div class="mt-2 text-sm flex gap-3">
                    <a href="{{ route('chirps.edit', $chirp) }}" class="text-amber-800 hover:text-amber-900 flex items-center gap-1">
                        Edit <i class="ti ti-feather"></i>
                    </a>
                    <form action="{{ route('chirps.destroy', $chirp) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-600 flex items-center gap-1">
                            Delete <i class="ti ti-feather"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endforeach
    </main>

</body>