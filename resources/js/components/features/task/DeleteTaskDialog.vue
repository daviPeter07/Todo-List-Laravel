<script setup lang="ts">
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import type { Task } from '@/types/task';

defineProps<{
    open: boolean;
    task: Task | null;
}>();

const emit = defineEmits<{
    'update:open': [value: boolean];
}>();
</script>

<template>
    <Dialog :open="open" @update:open="emit('update:open', $event)">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>{{
                    task?.title ?? 'Detalhes da tarefa'
                }}</DialogTitle>
                <DialogDescription>
                    Visualize as informações completas da tarefa.
                </DialogDescription>
            </DialogHeader>

            <div v-if="task" class="space-y-4">
                <div class="space-y-1">
                    <p class="text-sm font-medium">Status</p>
                    <p class="text-sm text-muted-foreground">
                        {{ task.status }}
                    </p>
                </div>

                <div class="space-y-1">
                    <p class="text-sm font-medium">Descrição</p>
                    <p class="text-sm text-muted-foreground">
                        {{ task.description || 'Sem descrição.' }}
                    </p>
                </div>
            </div>
        </DialogContent>
    </Dialog>
</template>
