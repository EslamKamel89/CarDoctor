<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Form from './Form.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'موديلات السيارات',
        href: '/car-models',
    },
    {
        title: 'إنشاء',
        href: '/car-models/create',
    },
];
</script>

<template>
    <Head title="إنشاء موديل سيارة" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Form action="create" />
    </AppLayout>
</template>
