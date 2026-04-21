<script setup lang="ts">
import TaskCreateForm from '@/components/features/task/TaskCreateForm.vue';
import TaskHeader from '@/components/features/task/TaskHeader.vue';
import TaskList from '@/components/features/task/TaskList.vue';
import type { Task } from '@/types/task';

defineProps<{ tasks: Task[] }>();

const handleView = (task: Task) => {
    console.log('view', task);
};
const handleEdit = (task: Task) => {
    console.log('edit', task);
};
const handleRemove = (task: Task) => {
    console.log('remove', task);
};
</script>

<template>
    <section
        class="mx-auto flex min-h-[calc(100vh-4rem)] w-full max-w-4xl items-start justify-center px-4 py-8"
    >
        <div class="w-full space-y-6 rounded-2xl border bg-card p-6 shadow-sm">
            <TaskHeader
                title="Minhas tarefas"
                description="Organize suas tarefas, acompanhe prioridades e mantenha sua rotina em ordem."
            />

            <TaskCreateForm />

            <TaskList
                :tasks="tasks"
                @view="handleView"
                @edit="handleEdit"
                @remove="handleRemove"
            />
        </div>
    </section>
</template>
