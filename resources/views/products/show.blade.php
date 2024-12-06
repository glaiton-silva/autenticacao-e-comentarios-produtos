<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img class="w-full h-96 object-cover"
                    src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300' }}"
                    alt="{{ $product->name }}">

                <div class="p-6">
                    <h1 class="text-4xl font-semibold">{{ $product->name }}</h1>
                    <p class="text-gray-600 mt-4">{{ $product->description }}</p>
                    <p class="mt-6 text-2xl font-bold text-gray-800">{{ 'R$ ' . number_format($product->price, 2, ',', '.') }}</p>
                    <a href="/" class="mt-6 inline-block bg-blue-500 text-white px-4 py-2 rounded">Voltar</a>
                </div>
            </div>

            <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">Comentários</h2>

                <div id="comments-container"></div>

                @auth
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Deixe seu comentário</h3>
                    <textarea id="new-comment" class="w-full p-3 border border-gray-300 rounded-md" rows="4" placeholder="Escreva seu comentário..."></textarea>
                    <button id="submit-comment" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Enviar Comentário</button>
                </div>
                @else
                <div class="mt-6 text-gray-500">
                    Para enviar um comentário, você precisa estar <a href="{{ route('login') }}" class="text-blue-500">logado</a>.
                </div>
                @endauth
            </div>
        </div>
    </div>

    <script>
        const loggedInUserId = @json(Auth::check() ? Auth::id() : null);

        // Função para carregar os comentários
        function loadComments() {
            fetch(`/api/products/{{ $product->id }}/comments`)
                .then(response => response.json())
                .then(comments => {
                    const commentsContainer = document.getElementById('comments-container');
                    commentsContainer.innerHTML = '';

                    comments.forEach(comment => {
                        const commentElement = document.createElement('div');
                        commentElement.classList.add('mb-4', 'border-b', 'pb-4');
                        commentElement.innerHTML = `
                    <p><strong>${comment.user.name}</strong></p>
                    <p>${comment.content}</p>
                    <div class="text-sm text-gray-500 mt-2">Editado: ${comment.edits.length} vez(es)</div>
                    <div class="mt-2">
                        ${loggedInUserId && loggedInUserId === comment.user.id ? `
                            <button class="text-blue-500 text-sm" onclick="editComment(${comment.id})">Editar</button>
                            <button class="text-red-500 text-sm" onclick="deleteComment(${comment.id})">Excluir</button>
                        ` : ''}
                    </div>
                `;
                        commentsContainer.appendChild(commentElement);
                    });
                });
        }

        // Função para enviar um novo comentário
        function submitComment() {
            const content = document.getElementById('new-comment').value;
            if (!content) return alert('Por favor, escreva um comentário.');

            fetch(`/api/products/{{ $product->id }}/comments`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        content: content
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.content) {
                        alert('Comentário enviado com sucesso!');
                        loadComments();
                        document.getElementById('new-comment').value = '';
                    } else {
                        alert('Erro ao enviar o comentário.');
                    }
                })
                .catch(error => {
                    alert('Erro ao enviar o comentário.');
                    console.error(error);
                });
        }

        // Função para editar um comentário
        function editComment(commentId) {
            const content = prompt('Digite o novo comentário:');

            if (!content) return alert('Comentário não pode ser vazio.');

            fetch(`/api/products/{{ $product->id }}/comments/${commentId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        content: content
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.comment) {
                        alert('Comentário editado com sucesso!');
                        loadComments();
                    } else {
                        alert('Erro ao editar comentário.');
                    }
                })
                .catch(error => {
                    console.error('Erro ao editar comentário:', error);
                    alert('Erro ao editar comentário.');
                });
        }

        // Função para excluir um comentário
        function deleteComment(commentId) {
            if (!confirm("Tem certeza que deseja excluir este comentário?")) return;

            fetch(`/api/products/{{ $product->id }}/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Comentário excluído com sucesso!');
                        loadComments();
                    } else {
                        alert('Erro ao excluir o comentário.');
                    }
                })
                .catch(error => {
                    alert('Erro ao excluir o comentário.');
                    console.error(error);
                });
        }

        // Carregar comentários ao carregar a página
        document.addEventListener('DOMContentLoaded', function() {
            loadComments();

            const submitButton = document.getElementById('submit-comment');
            if (submitButton) {
                submitButton.addEventListener('click', submitComment);
            }
        });
    </script>
</x-app-layout>