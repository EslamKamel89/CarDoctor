<script setup lang="ts">
import CustomDialog from '@/components/shared/CustomDialog.vue';
import Badge from '@/components/ui/badge/Badge.vue';
import Button from '@/components/ui/button/Button.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { can } from '@/helpers/can';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, User } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { Eye, Pen, Plus, Trash2 } from 'lucide-vue-next';
import Show from './Show.vue';

const props = defineProps<{
    users: User[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'لوحة التحكم',
        href: '/dashboard',
    },
];

const deleteUser = (user: User) => {
    const confirmAction = confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟');
    if (!confirmAction) return;
    router.delete(route('users.destroy', { user: user.id }));
};
</script>

<template>
    <Head title="جدول المستخدمين" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex w-full justify-end">
                <Link :href="route('users.create')" v-if="can('users.create')">
                    <Button type="button">
                        <Plus />
                        <span>مستخدم</span>
                    </Button>
                </Link>
            </div>
            <Table>
                <!--
                    <TableCaption>قائمة بالفواتير الحديثة.</TableCaption>
                -->
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]"> الاسم </TableHead>
                        <TableHead>البريد الإلكتروني</TableHead>
                        <TableHead> الأدوار </TableHead>
                        <TableHead> تاريخ الإنشاء </TableHead>
                        <TableHead class="text-right"> الإجراءات </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="user in users" :key="user.id">
                        <TableCell class="font-medium">
                            {{ user.name }}
                        </TableCell>
                        <TableCell>{{ user.email }}</TableCell>
                        <TableCell>
                            <div class="flex flex-wrap gap-1">
                                <Badge v-for="role in user.roles" :key="role.id" variant="secondary">{{ role.name }}</Badge>
                            </div>
                        </TableCell>
                        <TableCell> {{ user.created_at }}</TableCell>
                        <TableCell class="">
                            <div class="flex w-full items-center justify-end space-x-2">
                                <Button v-if="can('users.delete')" @click="deleteUser(user)" type="button" variant="destructive" size="sm">
                                    <Trash2 />
                                </Button>
                                <CustomDialog title="عرض المستخدم" description="">
                                    <template #trigger>
                                        <Button type="button" variant="default" size="sm"><Eye /></Button>
                                    </template>
                                    <template #content>
                                        <Show :user-id="user.id" />
                                    </template>
                                </CustomDialog>
                                <Link v-if="can('users.update')" :href="route('users.edit', { user: user.id })">
                                    <Button type="button" variant="secondary" size="sm"><Pen /></Button>
                                </Link>
                            </div>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
