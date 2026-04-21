# Todo List com Vue e Laravel

Aplicação para gerenciamento de tarefas com autenticação de usuários.

O projeto usa Laravel no backend, Inertia.js como ponte entre backend e frontend, e Vue 3 no frontend para entregar uma experiência de SPA sem abrir mão das rotas e validações do Laravel.

## Funcionalidades

- cadastro e login de usuários
- recuperação de senha
- verificação de e-mail
- autenticação em dois fatores com Laravel Fortify
- criação de tarefas
- edição de tarefas
- exclusão de tarefas
- visualização de detalhes da tarefa
- reordenação manual das tarefas por drag and drop
- isolamento de tarefas por usuário autenticado

## Stack

- PHP 8.3+
- Laravel 13
- Laravel Fortify
- Inertia.js
- Vue 3 + TypeScript
- Vite
- Tailwind CSS 4
- PostgreSQL
- Docker Compose
- Pest para testes

## Como o projeto funciona

- a rota `/` verifica se o usuário está autenticado
- se estiver autenticado, ele é redirecionado para `/task`
- se não estiver autenticado, ele é redirecionado para `/login`
- o acesso ao CRUD de tarefas fica protegido pelos middlewares `auth` e `verified`
- cada tarefa pertence a um usuário e é salva com uma posição para permitir reordenação
- após login, o Fortify redireciona o usuário para `/task`

## Requisitos

- PHP 8.3 ou superior
- Composer
- Node.js 20+
- npm

## Instalação

1. Clone o repositório.
2. Instale as dependências do PHP.
3. Instale as dependências do frontend.
4. Configure o arquivo `.env`.
5. Suba o banco PostgreSQL com Docker Compose.
6. Gere a chave da aplicação.
7. Rode as migrations.

### Passo a passo

```bash
composer install
npm install
cp .env.example .env
docker compose up -d
php artisan key:generate
php artisan migrate
```

No Windows PowerShell, se preferir:

```powershell
composer install
npm install
Copy-Item .env.example .env
docker compose up -d
php artisan key:generate
php artisan migrate
```

## Banco de dados

O projeto usa PostgreSQL em container Docker, orquestrado por `docker-compose.yml`.

Serviço disponível no Compose:

```text
postgres
```

O container usa as variáveis de ambiente da aplicação para configurar:

- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

Para subir apenas o banco:

```bash
docker compose up -d postgres
```

Para derrubar os containers:

```bash
docker compose down
```

Se quiser remover também o volume do banco:

```bash
docker compose down -v
```

## Executando em desenvolvimento

Para subir backend, fila e Vite ao mesmo tempo:

```bash
composer run dev
```

Esse comando inicia:

- `php artisan serve`
- `php artisan queue:listen --tries=1`
- `npm run dev`

Se preferir rodar manualmente:

```bash
php artisan serve
npm run dev
```

## Build de produção

```bash
npm run build
```

## Scripts úteis

### Backend / Composer

```bash
composer run dev
composer test
composer run lint
composer run lint:check
composer run ci:check
```

### Frontend / npm

```bash
npm run dev
npm run build
npm run lint
npm run lint:check
npm run format
npm run format:check
npm run types:check
```

## Rotas principais

### Públicas

- `GET /` redireciona para login ou tarefas
- `GET /login`
- `POST /login`
- `GET /register`
- `POST /register`
- fluxo de reset de senha do Fortify
- fluxo de verificação de e-mail do Fortify
- fluxo de dois fatores do Fortify

### Tarefas

Todas protegidas por `auth` e `verified`.

- `GET /task` lista as tarefas do usuário
- `POST /task` cria uma nova tarefa
- `PUT/PATCH /task/{task}` atualiza uma tarefa
- `DELETE /task/{task}` remove uma tarefa
- `PATCH /task/reorder` salva a nova ordem das tarefas

## Estrutura resumida

```text
app/
  Http/
    Controllers/
      TaskController.php
    Requests/
      StoreTaskRequest.php
      UpdateTaskRequest.php
      ReorderTaskRequest.php
  Models/
    Task.php
    User.php

database/
  migrations/
    create_tasks_table.php

resources/
  js/
    pages/
      auth/
      task/
    components/
      features/task/

routes/
  web.php
```

## Regras de negócio das tarefas

- cada tarefa pertence a um único usuário
- usuários só podem editar e excluir as próprias tarefas
- a ordenação é persistida pelo campo `position`
- o status aceito atualmente é `pending` ou `completed`
- o título é obrigatório
- a descrição é opcional

## Autenticação

O projeto usa Laravel Fortify para os fluxos de autenticação. Estão habilitados:

- cadastro
- login
- recuperação de senha
- verificação de e-mail
- autenticação em dois fatores

As views de autenticação são renderizadas com Inertia e Vue em `resources/js/pages/auth`.

## Interface de tarefas

A tela principal de tarefas fica em:

```text
resources/js/pages/task/Index.vue
```

Ela concentra o fluxo de:

- criação de tarefa
- abertura do modal de detalhes
- abertura do modal de edição
- confirmação de exclusão
- reordenação da lista

## Testes

Para rodar os testes:

```bash
php artisan test
```

ou

```bash
composer test
```

## Melhorias futuras

- filtros por status
- busca por título
- datas e prazos
- prioridades
- testes específicos para o CRUD de tarefas
- feedback visual mais completo para erros e sucesso
