<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
</script>

<template>
    <div class="space-y-2">
        <Label for="task-title">Nova Tarefa</Label>
        <div class="sm:flex-flow flex flex-col gap-3">
            <Input
                id="task-title"
                type="text"
                placeholder="Digite o título da tarefa..."
                class="flex-1"
            />
            <Button type="button">Adicionar</Button>
        </div>
    </div>
</template>
