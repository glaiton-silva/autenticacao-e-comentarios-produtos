<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h1 class="text-2xl font-bold mb-4">Editar Produto</h1>

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Nome do Produto')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $product->name }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Descrição')" />
                        <textarea id="description" class="block mt-1 w-full" name="description" required>{{ $product->description }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Preço')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" value="{{ $product->price }}" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Imagem')" />
                        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" />
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Imagem do Produto" class="mt-2 h-32">
                        @endif
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">
                        {{ __('Atualizar Produto') }}
                    </x-primary-button>
                </form>

                <!-- Botão para visualizar os comentários -->
                <div class="mt-6">
                    <a href="{{ route('admin.products.comments', $product->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Ver Comentários
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>