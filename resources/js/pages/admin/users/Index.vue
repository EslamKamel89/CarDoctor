<script setup lang="ts">
import CustomDialog from '@/components/shared/CustomDialog.vue';
import Badge from '@/components/ui/badge/Badge.vue';
import Button from '@/components/ui/button/Button.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { can } from '@/helpers/can';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, User } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { useBreakpoints } from '@vueuse/core';
import { ChevronDown, Eye, Pen, Plus, Trash2 } from 'lucide-vue-next';

const props = defineProps<{
    users: User[];
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

const deleteUser = (user: User) => {
    const confirmAction = confirm('هل أنت متأكد أنك تريد حذف هذا المستخدم؟');
    if (!confirmAction) return;
    router.delete(route('users.destroy', { user: user.id }));
};
</script>

<template>
    <Head title="جدول المستخدمين" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <div class="flex justify-end w-full">
                <Link :href="route('users.create')" v-if="can('users.create')">
                    <Button type="button">
                        <Plus />
                        <span>مستخدم</span>
                    </Button>
                </Link>
            </div>

            <!-- Desktop Table View -->
            <Table class="hidden md:table">
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
                            <div class="flex items-center justify-end w-full space-x-2">
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

            <!-- Mobile Card View -->
            <div class="space-y-2 md:hidden">
                <Card v-for="user in users" :key="user.id">
                    <Collapsible>
                        <CollapsibleTrigger as-child>
                            <CardHeader class="flex-row items-center justify-between p-4 cursor-pointer">
                                <div>
                                    <CardTitle class="text-base">{{ user.name }}</CardTitle>
                                    <p class="text-sm text-muted-foreground">{{ user.email }}</p>
                                </div>
                                <ChevronDown class="h-4 w-4 transition-transform duration-200 group-data-[state=open]:rotate-180" />
                            </CardHeader>
                        </CollapsibleTrigger>
                        <CollapsibleContent>
                            <CardContent class="pt-0 space-y-3">
                                <div>
                                    <p class="text-sm font-medium text-muted-foreground">الأدوار</p>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        <Badge v-for="role in user.roles" :key="role.id" variant="secondary">
                                            {{ role.name }}
                                        </Badge>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-muted-foreground">تاريخ الإنشاء</p>
                                    <p class="text-sm">{{ user.created_at }}</p>
                                </div>

                                <div class="flex justify-end pt-2 space-x-2">
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
                            </CardContent>
                        </CollapsibleContent>
                    </Collapsible>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
