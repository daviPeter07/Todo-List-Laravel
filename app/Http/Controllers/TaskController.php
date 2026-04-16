<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // facade para acessar user autenticado
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $tasks = Auth::user()
            ->tasks()
            ->orderBy('position')
            ->get();

        return Inertia::render('tasks/Index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    //objeto vindo da classe StoreTaskRequest e instancia dentro de $request
    public function store(StoreTaskRequest $request): RedirectResponse
    {

        $validated = $request->validated();
        //acessao a ultima posicao e incrementando quando adicionamos mais uma tarefa
        $nextPosition = Auth::user()
            ->tasks()
            ->max('position') + 1;

        //criando a task com as validacoes
        Auth::user()->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? 'pending',
            'position' => $nextPosition,
        ]);

        //redireciona para a page anterior
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //Route Model Binding, laravel pega id da tarefa e validacao da request
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        //se o user_id da tarefa for diferente do id logado retorna forbidden e interrompe
        abort_unless($task->user_id === Auth::id(), 403);

        //eloquent atualiza linha do banco e retorna dados validados
        $task->update($request->validated());

        //redireciona para a page anterior
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
