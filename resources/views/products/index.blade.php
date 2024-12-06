<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Destaques da Loja</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img class="w-full h-56 object-cover"
                    src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=Imagem+Indisponível' }}"
                    alt="{{ $product->name }}">
                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-600 mt-2">{{ Str::limit($product->description, 100) }}</p>
                    <p class="mt-4 text-xl font-bold text-gray-800">{{ 'R$ ' . number_format($product->price, 2, ',', '.') }}</p>
                    <a href="/product/{{ $product->id }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700">Ver Detalhes</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>