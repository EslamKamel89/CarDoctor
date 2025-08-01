<script setup lang="ts">
import CustomDialog from '@/components/shared/CustomDialog.vue';
import Badge from '@/components/ui/badge/Badge.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { can } from '@/helpers/can';
import formatDateTime from '@/helpers/formatDateTime';
import AppLayout from '@/layouts/AppLayout.vue';
import Show from '@/pages/admin/roles/Show.vue';
import { BreadcrumbItem } from '@/types';
import { Role } from '@/types/app';
import { Head, Link, router } from '@inertiajs/vue3';
import { useBreakpoints } from '@vueuse/core';
import { ChevronDown, Eye, Pen, Plus, Trash2 } from 'lucide-vue-next';

const props = defineProps<{
    roles: Role[];
}>();

const breakpoints = useBreakpoints({
    mobile: 640, // Tailwind's 'sm' breakpoint
});

const isMobile = breakpoints.smaller('mobile');

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'لوحة التحكم',
        href: '/dashboard',
    },
];

const deleteRole = (role: Role) => {
    const confirmAction = confirm('هل أنت متأكد أنك تريد حذف هذا الدور؟');
    if (!confirmAction) return;
    router.delete(route('roles.destroy', { role: role.id }));
};
</script>

<template>
    <Head title="جدول الأدوار" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <div class="flex justify-end w-full">
                <Link :href="route('roles.create')" v-if="can('roles.create')">
                    <Button type="button">
                        <Plus />
                        <span>دور</span>
                    </Button>
                </Link>
            </div>

            <!-- Desktop Table View -->
            <Table class="hidden md:table">
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]"> الاسم </TableHead>
                        <TableHead>الصلاحيات</TableHead>
                        <TableHead> تاريخ الإنشاء </TableHead>
                        <TableHead class="text-right"> الإجراءات </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="role in roles" :key="role.id">
                        <TableCell class="font-medium">
                            {{ role.name_ar }}
                        </TableCell>
                        <TableCell>
                            <div class="flex flex-wrap gap-1">
                                <Badge v-for="permission in role.permissions" :key="permission.id" variant="secondary">{{
                                    permission.name_ar
                                }}</Badge>
                            </div>
                        </TableCell>
                        <TableCell> {{ formatDateTime(role.created_at) }}</TableCell>
                        <TableCell class="">
                            <div class="flex items-center justify-end w-full space-x-2">
                                <Button v-if="can('roles.delete')" @click="deleteRole(role)" type="button" variant="destructive" size="sm">
                                    <Trash2 />
                                </Button>
                                <CustomDialog title="عرض الدور" description="">
                                    <template #trigger>
                                        <Button type="button" variant="default" size="sm"><Eye /></Button>
                                    </template>
                                    <template #content>
                                        <Show :role-id="role.id" />
                                    </template>
                                </CustomDialog>
                                <Link v-if="can('roles.update')" :href="route('roles.edit', { role: role.id })">
                                    <Button type="button" variant="secondary" size="sm"><Pen /></Button>
                                </Link>
                            </div>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <!-- Mobile Card View -->
            <div class="space-y-2 md:hidden">
                <Card v-for="role in roles" :key="role.id">
                    <Collapsible>
                        <CollapsibleTrigger as-child>
                            <CardHeader class="flex-row items-center justify-between p-4 cursor-pointer">
                                <CardTitle class="text-base">{{ role.name_ar }}</CardTitle>
                                <ChevronDown class="h-4 w-4 transition-transform duration-200 group-data-[state=open]:rotate-180" />
                            </CardHeader>
                        </CollapsibleTrigger>
                        <CollapsibleContent>
                            <CardContent class="pt-0 space-y-3">
                                <div>
                                    <p class="text-sm font-medium text-muted-foreground">الصلاحيات</p>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        <Badge v-for="permission in role.permissions" :key="permission.id" variant="secondary">
                                            {{ permission.name_ar }}
                                        </Badge>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-muted-foreground">تاريخ الإنشاء</p>
                                    <p class="text-sm">{{ formatDateTime(role.created_at) }}</p>
                                </div>

                                <div class="flex justify-end pt-2 space-x-2">
                                    <Button v-if="can('roles.delete')" @click="deleteRole(role)" type="button" variant="destructive" size="sm">
                                        <Trash2 />
                                    </Button>
                                    <CustomDialog title="عرض الدور" description="">
                                        <template #trigger>
                                            <Button type="button" variant="default" size="sm"><Eye /></Button>
                                        </template>
                                        <template #content>
                                            <Show :role-id="role.id" />
                                        </template>
                                    </CustomDialog>
                                    <Link v-if="can('roles.update')" :href="route('roles.edit', { role: role.id })">
                                        <Button type="button" variant="secondary" size="sm"><Pen /></Button>
                                    </Link>
                                </div>
                            </CardContent>
                        </CollapsibleContent>
                    </Collapsible>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
