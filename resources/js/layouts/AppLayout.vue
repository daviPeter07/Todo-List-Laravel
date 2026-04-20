<script setup lang="ts">
import type { BreadcrumbItem } from '@/types';

defineProps<{
    breadcrumbs?: BreadcrumbItem[];
}>();
</script>

<template>
    <div class="min-h-screen bg-background text-foreground">
        <main class="mx-auto w-full max-w-7xl p-6">
            <slot />
        </main>
    </div>
</template>
