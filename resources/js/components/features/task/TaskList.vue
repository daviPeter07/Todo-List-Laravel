<script setup lang="ts">
import TaskItem from '@/components/features/task/TaskItem.vue';
import type { Task } from '@/types/task';

defineProps<{
    tasks: Task[];
}>();

defineEmits<{
    view: [task: Task];
    edit: [task: Task];
    remove: [task: Task];
}>();
</script>

<template>
    <div class="rounded-xl border">
        <div class="border-b px-4 py-3">
            <h2 class="text-sm font-medium">Lista de tarefas</h2>
        </div>

        <div class="max-h-105 overflow-y-auto p-4">
            <div
                v-if="tasks.length === 0"
                class="py-10 text-center text-sm text-muted-foreground"
            >
                Nenhuma tarefa cadastrada ainda.
            </div>

            <ul v-else class="space-y-3">
                <TaskItem
                    v-for="task in tasks"
                    :key="task.id"
                    :task="task"
                    @view="$emit('view', task)"
                    @edit="$emit('edit', task)"
                    @remove="$emit('remove', task)"
                />
            </ul>
        </div>
    </div>
</template>
