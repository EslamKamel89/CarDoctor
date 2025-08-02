<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { AppPageProps, BreadcrumbItem } from '@/types';
import { CarModel } from '@/types/app';
import { Head, usePage } from '@inertiajs/vue3';
import Form from './Form.vue';

const page = usePage<AppPageProps & { car_model: CarModel }>();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'موديلات السيارات',
        href: '/car_models',
    },
    {
        title: 'تحديث',
        href: page.url,
    },
];
</script>

<template>
    <Head title="تحديث موديل سيارة" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Form action="edit" :car_model="page.props.car_model" />
    </AppLayout>
</template>
