<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Permission, Role } from '@/types/app';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps<{
    role: Role;
    permissions: Permission[];
}>();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'الأدوار',
        href: '/roles',
    },
    {
        title: 'تحديث',
        href: `/roles/${props.role.id}/edit`,
    },
];
const form = useForm({
    name: props.role.name,
    name_ar: props.role.name_ar,
    permissions: props.role.permissions.map((permission) => permission.id),
});
</script>
<template>
    <Head title="Role User" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <form @submit.prevent="form.put(route('roles.update', { role: role.id }))" class="flex flex-col items-start w-full space-y-3">
                <div class="grid w-full items-center gap-1.5">
                    <Label for="name">الاسم</Label>
                    <Input v-model="form.name" id="name" type="text" placeholder="الاسم" />
                    <div class="text-xs font-thin text-red-700" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div class="grid w-full items-center gap-1.5">
                    <Label for="name_ar">الاسم العربي</Label>
                    <Input v-model="form.name_ar" id="name" type="text" placeholder="الاسم العربي" />
                    <div class="text-xs font-thin text-red-700" v-if="form.errors.name_ar">{{ form.errors.name_ar }}</div>
                </div>
                <div class="flex items-center space-x-2" v-for="permission in permissions" :key="permission.id">
                    <input type="checkbox" :id="`permission.${permission.id}`" v-model="form.permissions" :value="permission.id" />
                    <label
                        :for="`permission.${permission.id}`"
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    >
                        {{ permission.name_ar }}
                    </label>
                </div>
                <Button type="submit" class="max-w-sm">تحديث</Button>
            </form>
        </div>
    </AppLayout>
</template>
