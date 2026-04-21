<script setup lang="ts">
import TaskActions from './TaskActions.vue';
import type { Task } from '@/types/task';

defineProps<{
    task: Task;
}>();

defineEmits<{
    view: [task: Task];
    edit: [task: Task];
    remove: [task: Task];
}>();
</script>

<template>
    <li class="rounded-xl border bg-card p-4 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0 flex-1 space-y-1">
                <div class="flex items-center gap-2">
                    <h3 class="truncate font-medium">
                        {{ task.title }}
                    </h3>

                    <span class="rounded-full border px-2 py-0.5 text-xs">
                        {{ task.status }}
                    </span>
                </div>

                <p
                    v-if="task.description"
                    class="line-clamp-2 text-sm text-muted-foreground"
                >
                    {{ task.description }}
                </p>
            </div>

            <TaskActions
                @view="$emit('view', task)"
                @edit="$emit('edit', task)"
                @remove="$emit('remove', task)"
            />
        </div>
    </li>
</template>
