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
            class="rounded-md border p-2 transition hover:bg-muted"
            @click="$emit('view')"
        >
            <Eye class="h-4 w-4" />
        </button>
        <button
            type="button"
            class="rounded-md border p-2 transition hover:bg-muted"
            @click="$emit('edit')"
        >
            <Pencil class="h-4 w-4" />
        </button>
        <button
            type="button"
            class="rounded-md border p-2 transition hover:bg-muted"
            @click="$emit('remove')"
        >
            <Trash2 class="h-4 w-4" />
        </button>
        <button
            type="button"
            class="cursor-grab rounded-md border p-2 transition hover:bg-muted active:cursor-grabbing"
        >
            <GripVertical class="h-4 w-4" />
        </button>
    </div>
</template>
