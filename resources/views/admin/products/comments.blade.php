<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6">Comentários do Produto: {{ $product->name }}</h1>

                <div class="flex justify-start mb-4">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Voltar para o Produto
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Usuário</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Comentário</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Histórico de Edições</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($product->comments as $comment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $comment->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $comment->content }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @foreach ($comment->edits as $edit)
                                    <p class="text-gray-600">Anterior: {{ $edit->previous_content }} ({{ $edit->created_at->format('d/m/Y H:i') }})</p>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex space-x-4">
                                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Excluir</button>
                                        </form>
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