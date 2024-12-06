<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h1 class="text-2xl font-semibold text-gray-800">Bem-vindo ao painel administrativo!</h1>
                <p class="mt-1 text-lg text-gray-600">Olá, <span class="font-semibold">{{ auth()->user()->name }}</span>! Estamos felizes em tê-lo aqui. O que deseja fazer hoje?</p>
            </div>
        </div>
    </div>
</x-admin-layout>