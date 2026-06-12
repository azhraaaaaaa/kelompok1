<x-app-layout>
    <div class="p-8">
        <h1 class="text-4xl font-bold">
            Rencana Liburan
        </h1>

        <p class="mt-4">
            Selamat datang, {{ auth()->user()->name }}
        </p>

        <div class="mt-8">
            <a href="/bali"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                Jelajahi Bali
            </a>
        </div>
    </div>
</x-app-layout>