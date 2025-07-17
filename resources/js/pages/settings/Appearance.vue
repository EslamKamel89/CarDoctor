<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'إعدادات المظهر',
        href: '/settings/appearance',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="إعدادات المظهر" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="إعدادات المظهر" description="قم بتحديث إعدادات مظهر حسابك" />
                <AppearanceTabs />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
