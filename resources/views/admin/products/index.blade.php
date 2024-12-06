<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h1 class="text-3xl font-semibold text-gray-800 mb-4">Gerenciar Produtos</h1>
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Adicionar Produto
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Nome</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Descrição</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Preço</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $product->description }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex space-x-4">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-yellow-500 hover:text-yellow-800">Editar</a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Excluir</button>
                                        </form>
                                        <a href="{{ route('admin.products.comments', $product->id) }}" class="text-blue-500 hover:text-blue-800">Ver Comentários</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>