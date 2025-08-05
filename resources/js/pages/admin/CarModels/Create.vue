<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Brand } from '@/types/app';
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
const props = defineProps<{ brands: Brand[] }>();
</script>

<template>
    <Head title="إنشاء موديل سيارة" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Form action="create" :brands="brands" />
    </AppLayout>
</template>
