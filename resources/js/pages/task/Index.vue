<script setup lang="ts">
import { computed, ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import TaskCreateForm from '@/components/features/task/TaskCreateForm.vue';
import DeleteTaskDialog from '@/components/features/task/DeleteTaskDialog.vue';
import TaskDetailsDialog from '@/components/features/task/TaskDetailsDialog.vue';
import TaskFormDialog from '@/components/features/task/TaskFormDialog.vue';
import TaskHeader from '@/components/features/task/TaskHeader.vue';
import TaskList from '@/components/features/task/TaskList.vue';
import type { Task } from '@/types/task';

const props = defineProps<{
    tasks: Task[];
}>();

const createTitle = ref('');
const selectedTask = ref<Task | null>(null);

const detailsOpen = ref(false);
const formOpen = ref(false);
const deleteOpen = ref(false);
const deleteProcessing = ref(false);

const createForm = useForm({
    title: '',
    description: '',
    status: 'pending' as 'pending' | 'completed',
});

const editForm = useForm({
    title: '',
    description: '',
    status: 'pending' as 'pending' | 'completed',
});

const localTasks = computed(() =>
    [...props.tasks].sort((a, b) => a.position - b.position),
);

function submitCreate() {
    createForm.title = createTitle.value;

    createForm.post('/task', {
        preserveScroll: true,
        onSuccess: () => {
            createTitle.value = '';
            createForm.reset('title', 'description', 'status');
            createForm.status = 'pending';
        },
    });
}

function openDetails(task: Task) {
    selectedTask.value = task;
    detailsOpen.value = true;
}

function openEdit(task: Task) {
    selectedTask.value = task;
    formOpen.value = true;
}

function openDelete(task: Task) {
    selectedTask.value = task;
    deleteOpen.value = true;
}

function submitEdit(payload: {
    title: string;
    description: string;
    status: 'pending' | 'completed';
}) {
    if (!selectedTask.value) return;

    editForm.title = payload.title;
    editForm.description = payload.description;
    editForm.status = payload.status;

    editForm.put(`/task/${selectedTask.value.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            formOpen.value = false;
            selectedTask.value = null;
        },
    });
}

function confirmDelete() {
    if (!selectedTask.value) return;

    deleteProcessing.value = true;

    router.delete(`/task/${selectedTask.value.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            deleteOpen.value = false;
            selectedTask.value = null;
        },
        onFinish: () => {
            deleteProcessing.value = false;
        },
    });
}

function handleReorder(tasks: Task[]) {
    const payload = tasks.map((task, index) => ({
        id: task.id,
        position: index,
    }));

    router.patch('/task/reorder', { tasks: payload }, { preserveScroll: true });
}
</script>

<template>
    <section
        class="mx-auto flex min-h-[calc(100vh-4rem)] w-full max-w-4xl items-start justify-center px-4 py-8"
    >
        <div class="w-full space-y-6 rounded-2xl border bg-card p-6 shadow-sm">
            <TaskHeader
                title="Minhas tarefas"
                description="Organize suas tarefas, acompanhe prioridades e mantenha sua rotina em ordem."
            />

            <TaskCreateForm
                v-model="createTitle"
                :processing="createForm.processing"
                @submit="submitCreate"
            />

            <TaskList
                :tasks="localTasks"
                @view="openDetails"
                @edit="openEdit"
                @remove="openDelete"
                @reorder="handleReorder"
            />
        </div>
    </section>

    <TaskDetailsDialog
        :open="detailsOpen"
        :task="selectedTask"
        @update:open="detailsOpen = $event"
    />

    <TaskFormDialog
        :open="formOpen"
        :task="selectedTask"
        :processing="editForm.processing"
        @update:open="formOpen = $event"
        @submit="submitEdit"
    />

    <DeleteTaskDialog
        :open="deleteOpen"
        :task="selectedTask"
        :processing="deleteProcessing"
        @update:open="deleteOpen = $event"
        @confirm="confirmDelete"
    />
</template>
