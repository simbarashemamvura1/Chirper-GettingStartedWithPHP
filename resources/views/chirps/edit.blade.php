<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8 px-4">
        <form action="{{ route('chirps.update', $chirp) }}" method="POST">
            @csrf @method('PUT')
            <textarea name="body" class="w-full border rounded p-2" rows="3">{{ $chirp->body }}</textarea>
            @error('body')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
</x-app-layout>
