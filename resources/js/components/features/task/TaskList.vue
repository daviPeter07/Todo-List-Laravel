<script setup lang="ts">
import TaskItem from '@/components/features/task/TaskItem.vue';
import type { Task } from '@/types/task';

const props = defineProps<{
    tasks: Task[];
}>();

const emit = defineEmits<{
    view: [task: Task];
    edit: [task: Task];
    remove: [task: Task];
    reorder: [tasks: Task[]];
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

            <Draggable
                v-else
                :list="tasks"
                item-key="id"
                handle=".drag-handle"
                class="space-y-3"
                @end="emit('reorder', tasks)"
            >
                <template #item="{ element }">
                    <TaskItem
                        :task="element"
                        @view="$emit('view', element)"
                        @edit="$emit('edit', element)"
                        @remove="$emit('remove', element)"
                    />
                </template>
            </Draggable>
        </div>
    </div>
</template>
