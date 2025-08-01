<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { AppPageProps, BreadcrumbItem } from '@/types';
import { Brand } from '@/types/app';
import { Head, usePage } from '@inertiajs/vue3';
import Form from './Form.vue';
const page = usePage<AppPageProps & { brand: Brand }>();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'العلامات التجارية',
        href: '/brands',
    },
    {
        title: 'تحديث',
        href: page.url,
    },
];
</script>
<template>
    <Head title="تحديث علامة تجارية" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Form action="edit" :brand="page.props.brand" />
    </AppLayout>
</template>
