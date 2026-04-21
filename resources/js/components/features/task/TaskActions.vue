<script setup lang="ts">
import { Eye, GripVertical, Pencil, Trash2 } from 'lucide-vue-next';

defineEmits<{
    view: [];
    edit: [];
    remove: [];
}>();
</script>

<template>
    <div class="flex items-center gap-2">
        <button
            type="button"
            aria-label="Visualizar tarefa"
            class="rounded-md border p-2 transition hover:bg-muted"
            @click="$emit('view')"
        >
            <Eye class="h-4 w-4" />
        </button>

        <button
            type="button"
            aria-label="Editar tarefa"
            class="rounded-md border p-2 transition hover:bg-muted"
            @click="$emit('edit')"
        >
            <Pencil class="h-4 w-4" />
        </button>

        <button
            type="button"
            aria-label="Excluir tarefa"
            class="rounded-md border p-2 transition hover:bg-muted"
            @click="$emit('remove')"
        >
            <Trash2 class="h-4 w-4" />
        </button>

        <div
            aria-label="Reordenar tarefa"
            class="drag-handle cursor-grab rounded-md border p-2 transition hover:bg-muted active:cursor-grabbing"
        >
            <GripVertical class="h-4 w-4" />
        </div>
    </div>
</template>
