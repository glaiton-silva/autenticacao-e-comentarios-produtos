
# Projeto Laravel com Autenticação e Comentários

Este projeto utiliza **Laravel** para criar um sistema de gerenciamento de usuários e comentários. Ele inclui funcionalidades para autenticação, CRUD de comentários e um painel de administração. O projeto também utiliza **Vite** para otimizar o frontend e **Docker** para o ambiente de desenvolvimento.

## Requisitos

Antes de iniciar, é recomendado utilizar **Homestead** para facilitar a instalação do ambiente de desenvolvimento. A avaliação do exercício será feita utilizando o Homestead mais atualizado, mas qualquer instalação é válida.

### Ferramentas Necessárias:

1. **Docker** para o gerenciamento de containers.
2. **Homestead** para configurar o ambiente Laravel rapidamente.
3. **PHP 8.0+**, **Composer** e **Node.js** instalados.

## Como Executar o Projeto

### Passo 1: Configuração do Homestead

Se estiver utilizando o Homestead, siga as etapas abaixo:

1. Clone o repositório:
    ```bash
    git clone https://github.com/seu-repositorio/projeto-laravel.git
    cd projeto-laravel
    ```

2. Inicie o Homestead (caso não tenha o Homestead, siga [este link](https://laravel.com/docs/8.x/homestead) para instalação):
    ```bash
    vagrant up
    ```

3. Após o Homestead estar rodando, acesse o projeto dentro da máquina virtual:
    ```bash
    vagrant ssh
    cd /vagrant
    ```

### Passo 2: Instalar Dependências

No ambiente Homestead, instale as dependências do projeto:

```bash
composer install
npm install
```

### Passo 3: Configurar o Banco de Dados

Crie o banco de dados no seu ambiente. No Homestead, acesse o MySQL:

```bash
mysql -u homestead -p
CREATE DATABASE nome_do_banco;
exit
```

Atualize o arquivo `.env` com as credenciais do banco de dados:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=33060
DB_DATABASE=nome_do_banco
DB_USERNAME=homestead
DB_PASSWORD=secret
```

### Passo 4: Rodar as Migrations

Para criar as tabelas no banco de dados, execute:

```bash
php artisan migrate
```

### Passo 5: Executar o Vite para o Frontend

O **Vite** é usado para otimizar e compilar o frontend. Para rodar o Vite, execute:

```bash
npm run dev
```

O Vite irá rodar no ambiente de desenvolvimento e você poderá acessar a interface frontend.

### Passo 6: Acessar o Sistema

Acesse a aplicação no navegador através da URL fornecida pelo Homestead, normalmente `http://localhost` ou `http://192.168.10.10`.

## Testes Automatizados

Testes automatizados são implementados utilizando **PHPUnit**. Execute os testes com o seguinte comando:

```bash
php artisan test
```

## Funcionalidades

### Autenticação e Cadastro de Usuários

- **Cadastro**: O sistema permite que os usuários se cadastrem com e-mail e senha.
- **Autenticação**: Os usuários podem se autenticar utilizando o e-mail e a senha, com autenticação baseada em token via `Sanctum` para requisições subsequentes.

#### Como Implementamos:
- Utilizamos o pacote `Laravel Sanctum` para autenticação baseada em token, permitindo uma maneira simples de autenticar usuários em uma SPA ou outras requisições AJAX.
- A senha dos usuários é criptografada utilizando o `Hash::make()` do Laravel para garantir a segurança.

### Comentários de Produtos

- **Listagem de Comentários**: Todos os usuários (autenticados ou não) podem visualizar os comentários.
- **Criação de Comentários**: Apenas usuários autenticados podem adicionar comentários.
- **Autor do Comentário**: O sistema retorna o nome do autor do comentário e a data e horário da postagem.
- **Edição de Comentários**: Usuários autenticados podem editar seus próprios comentários, incluindo a data da última edição.
- **Histórico de Edições**: O sistema mantém um histórico de edições de comentários.
- **Exclusão de Comentários**: Usuários podem excluir seus próprios comentários. O administrador pode excluir todos os comentários.

#### Como Implementamos:
- A rota `POST /api/products/{product}/comments` é protegida por autenticação via token.
- O controlador de `CommentController` possui métodos para a criação, edição e exclusão de comentários.
- A funcionalidade de edição de comentários mantém um campo de histórico para registrar todas as edições feitas.
- O administrador tem permissões para excluir todos os comentários, enquanto os usuários só podem excluir seus próprios comentários.

### Área Administrativa

- O sistema possui uma área administrativa que permite o gerenciamento de produtos e usuários.
- Os administradores podem excluir qualquer comentário e gerenciar os usuários registrados.

#### Como Implementamos:
- O middleware `auth` protege todas as rotas da área administrativa, garantindo que apenas administradores possam acessá-las.

---

## Soluções Aplicadas

### Requisitos Obrigatórios

1. **Gerenciamento de Usuários**: Implementado utilizando o `Laravel Breeze` para fornecer autenticação, registro e edição de dados dos usuários.
2. **Autenticação com Token**: Utilizamos o `Sanctum` para autenticação via token em todas as requisições que não sejam para login ou registro.
3. **Comentários Visíveis para Todos**: Implementamos a rota de listagem de comentários que é acessível para qualquer usuário.
4. **Inserção de Comentários Apenas por Usuários Autenticados**: A criação de comentários exige um token de autenticação, garantindo que apenas usuários autenticados possam comentar.
5. **Exibição do Autor e Data de Postagem**: A resposta da API para os comentários inclui informações sobre o autor e a data de postagem.

### Requisitos Desejáveis

1. **Edição de Comentários**: Implementada a possibilidade de edição de comentários pelos próprios autores, com a data de criação e de edição sendo exibidas.
2. **Histórico de Edições de Comentários**: O sistema armazena um histórico de edições de cada comentário, permitindo que múltiplas edições sejam rastreadas.
3. **Exclusão de Comentários**: Usuários podem excluir seus próprios comentários, e administradores podem excluir todos os comentários.
4. **Criptografia de Senhas**: As senhas dos usuários são criptografadas usando o método `Hash::make()` do Laravel.
5. **Testes Automatizados**: Utilizamos `PHPUnit` para escrever testes automatizados para as rotas de API e Web, garantindo que as funcionalidades funcionem conforme o esperado.

---

## Conclusão

Este projeto abrange funcionalidades de gerenciamento de usuários, autenticação com token, controle de comentários e um painel administrativo. Ele também inclui a utilização do **Vite** para a construção do frontend e a configuração do ambiente utilizando **Docker** e **Homestead**.

### Notas

- A avaliação do exercício será feita utilizando o **Homestead mais atualizado**.
- Caso esteja usando um ambiente diferente, adapte os passos conforme necessário.

