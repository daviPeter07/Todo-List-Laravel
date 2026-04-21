<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import type { Task } from '@/types/task';

defineProps<{
    open: boolean;
    task: Task | null;
    processing?: boolean;
}>();

const emit = defineEmits<{
    confirm: [];
    'update:open': [value: boolean];
}>();
</script>

<template>
    <Dialog :open="open" @update:open="emit('update:open', $event)">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Excluir tarefa</DialogTitle>
                <DialogDescription>
                    Confirme a exclusao da tarefa
                    <span class="font-medium text-foreground">
                        {{ task?.title ?? '' }}
                    </span>
                    . Esta acao nao pode ser desfeita.
                </DialogDescription>
            </DialogHeader>

            <DialogFooter>
                <Button variant="outline" @click="emit('update:open', false)">
                    Cancelar
                </Button>
                <Button
                    variant="destructive"
                    :disabled="processing || !task"
                    @click="emit('confirm')"
                >
                    Excluir
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
