<script setup lang="ts">
import { computed, ref, watch } from 'vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { Task } from '@/types/task';

const props = defineProps<{
    open: boolean;
    task: Task | null;
    processing?: boolean;
}>();

const emit = defineEmits<{
    'update:open': [value: boolean];
    submit: [
        payload: {
            title: string;
            description: string;
            status: 'pending' | 'completed';
        },
    ];
}>();

//estado inicial no formulario settado como vazio (menos o status)
const title = ref('');
const description = ref('');
const status = ref<'pending' | 'completed'>('pending');

watch(
    () => props.task,
    (task) => {
        title.value = task?.title ?? '';
        description.value = task?.description ?? '';
        status.value = (task?.status as 'pending' | 'completed') ?? 'pending';
    },
    { immediate: true },
);

//pega estado vindo do ref em relação a title e desc e dependendo de modo
const dialogTitle = computed(() =>
    props.task ? 'Editar tarefa' : 'Nova tarefa',
);
const dialogDescription = computed(() =>
    props.task
        ? 'Atualize as informações da tarefa.'
        : 'Preencha os dados da nova tarefa.',
);

//envia dados ja formatados conforme preenchido no form
function handleSubmit() {
    emit('submit', {
        title: title.value,
        description: description.value,
        status: status.value,
    });
}
</script>

<!--dialog para edit e create de tarefas-->
<template>
    <Dialog :open="open" @update:open="emit('update:open', $event)">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>{{ dialogTitle }}</DialogTitle>
                <DialogDescription>{{ dialogDescription }}</DialogDescription>
            </DialogHeader>

            <div class="space-y-4">
                <div class="space-y-2">
                    <Label for="task-form-title">Título</Label>
                    <Input
                        id="task-form-title"
                        v-model="title"
                        placeholder="Digite o título da tarefa"
                    />
                </div>

                <div class="space-y-2">
                    <Label for="task-form-description">Descrição</Label>
                    <textarea
                        id="task-form-description"
                        v-model="description"
                        class="min-h-28 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background outline-none placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring"
                        placeholder="Digite a descrição da tarefa"
                    />
                </div>

                <div class="space-y-2">
                    <Label for="task-form-status">Status</Label>
                    <select
                        id="task-form-status"
                        v-model="status"
                        class="h-10 w-full rounded-md border border-input bg-background px-3 text-sm ring-offset-background outline-none focus-visible:ring-2 focus-visible:ring-ring"
                    >
                        <option value="pending">Pendente</option>
                        <option value="completed">Concluída</option>
                    </select>
                </div>
            </div>

            <DialogFooter>
                <Button variant="outline" @click="emit('update:open', false)">
                    Cancelar
                </Button>
                <Button :disabled="processing" @click="handleSubmit">
                    Salvar
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
