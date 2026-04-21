<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';

//definição de props
const props = defineProps<{
    modelValue: string;
    processing?: boolean;
}>();

const emit = defineEmits<{
    'update:modelValue': [value: string];
    submit: [];
}>();
</script>

<template>
    <div class="space-y-2">
        <Label for="task-title">Nova Tarefa</Label>

        <form
            class="flex flex-col gap-3 sm:flex-row"
            @submit.prevent="emit('submit')"
        >
            <!--pega como modelo de valor da prop
                declara o value a ser enviado
                botao faz submit, quando apertado fica processing para n ser apertado
            -->
            <Input
                id="task-title"
                :model-value="props.modelValue"
                type="text"
                placeholder="Digite o título da tarefa..."
                class="flex-1"
                @update:model-value="emit('update:modelValue', String($event))"
            />
            <Button type="submit" :disabled="processing">Adicionar</Button>
        </form>
    </div>
</template>
