<script setup lang="ts">
import CustomDialog from '@/components/shared/CustomDialog.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { can } from '@/helpers/can';
import formatDateTime from '@/helpers/formatDateTime';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { CarModel } from '@/types/app';
import { Head, Link, router } from '@inertiajs/vue3';
import { useBreakpoints } from '@vueuse/core';
import { ChevronDown, Eye, Pen, Plus, Trash2 } from 'lucide-vue-next';
import Show from './Show.vue';

defineProps<{
    car_models: CarModel[];
}>();

const breakpoints = useBreakpoints({
    mobile: 640,
});
const isMobile = breakpoints.smaller('mobile');

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'لوحة التحكم',
        href: '/dashboard',
    },
    {
        title: 'موديلات السيارات',
        href: '/car-models',
    },
];

const deleteCarModel = (carModel: CarModel) => {
    const confirmAction = confirm('هل أنت متأكد أنك تريد حذف هذا الموديل؟');
    if (!confirmAction) return;
    router.delete(route('car-models.destroy', { car_model: carModel.id }));
};
</script>

<template>
    <Head title="جدول موديلات السيارات" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex w-full justify-end">
                <Link :href="route('car-models.create')" v-if="can('car_models.create')">
                    <Button type="button">
                        <Plus />
                        <span>موديل</span>
                    </Button>
                </Link>
            </div>

            <!-- Desktop Table View -->
            <Table class="hidden md:table">
                <TableHeader>
                    <TableRow>
                        <TableHead class="text-start"> الاسم </TableHead>
                        <TableHead class="text-start"> العلامة </TableHead>
                        <TableHead class="text-start"> نطاق السنوات </TableHead>
                        <TableHead class="text-start"> تاريخ الإنشاء </TableHead>
                        <TableHead class="text-end"> الإجراءات </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="car_model in car_models" :key="car_model.id">
                        <TableCell class="font-medium">
                            {{ car_model.name }}
                        </TableCell>
                        <TableCell>
                            {{ car_model.brand?.name }}
                        </TableCell>
                        <TableCell>
                            {{ car_model.year_range_formatted }}
                        </TableCell>
                        <TableCell>
                            {{ formatDateTime(car_model.created_at) }}
                        </TableCell>
                        <TableCell class="">
                            <div class="flex w-full items-center justify-end space-x-2">
                                <Button
                                    v-if="can('car-models.delete')"
                                    @click="deleteCarModel(car_model)"
                                    type="button"
                                    variant="destructive"
                                    size="sm"
                                >
                                    <Trash2 />
                                </Button>
                                <CustomDialog title="عرض الموديل" description="">
                                    <template #trigger>
                                        <Button type="button" variant="default" size="sm"><Eye /></Button>
                                    </template>
                                    <template #content>
                                        <Show :id="car_model.id" />
                                    </template>
                                </CustomDialog>
                                <Link v-if="can('car_models.edit')" :href="route('car-models.edit', { car_model: car_model.id })">
                                    <Button type="button" variant="secondary" size="sm"><Pen /></Button>
                                </Link>
                            </div>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <!-- Mobile Card View -->
            <div class="space-y-2 md:hidden">
                <Card v-for="car_model in car_models" :key="car_model.id">
                    <Collapsible>
                        <CollapsibleTrigger as-child>
                            <CardHeader class="cursor-pointer flex-row items-center justify-between p-4">
                                <div>
                                    <CardTitle class="text-base">{{ car_model.name }}</CardTitle>
                                    <p class="text-sm text-muted-foreground">
                                        {{ car_model.brand?.name }}
                                    </p>
                                </div>
                                <ChevronDown class="h-4 w-4 transition-transform duration-200 group-data-[state=open]:rotate-180" />
                            </CardHeader>
                        </CollapsibleTrigger>
                        <CollapsibleContent>
                            <CardContent class="space-y-3 pt-0">
                                <div>
                                    <p class="text-sm font-medium text-muted-foreground">العلامة</p>
                                    <p class="text-sm">{{ car_model.brand?.name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-muted-foreground">نطاق السنوات</p>
                                    <p class="text-sm">{{ car_model.year_range_formatted }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-muted-foreground">تاريخ الإنشاء</p>
                                    <p class="text-sm">
                                        {{ formatDateTime(car_model.created_at) }}
                                    </p>
                                </div>
                                <div class="flex justify-end space-x-2 pt-2">
                                    <Button
                                        v-if="can('car_models.delete')"
                                        @click="deleteCarModel(car_model)"
                                        type="button"
                                        variant="destructive"
                                        size="sm"
                                    >
                                        <Trash2 />
                                    </Button>
                                    <CustomDialog title="عرض الموديل" description="">
                                        <template #trigger>
                                            <Button type="button" variant="default" size="sm"><Eye /></Button>
                                        </template>
                                        <template #content>
                                            <Show :id="car_model.id" />
                                        </template>
                                    </CustomDialog>
                                    <Link v-if="can('car_models.edit')" :href="route('car-models.edit', { car_model: car_model.id })">
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
