<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h1 class="text-3xl font-semibold text-gray-800 mb-4">Gerenciar Usuários</h1>
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Adicionar Usuário
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Nome</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Função</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($user->role) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex space-x-4">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-500 hover:text-yellow-800">Editar</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
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