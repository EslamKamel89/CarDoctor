<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Form from './Form.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'العلامات التجارية',
        href: '/brands',
    },
    {
        title: 'إنشاء',
        href: '/brands/create',
    },
];
</script>
<template>
    <Head title="إنشاء علامة تجارية" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Form action="create" />
    </AppLayout>
</template>
