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
import { Brand } from '@/types/app';
import { Head, Link, router } from '@inertiajs/vue3';
import { useBreakpoints } from '@vueuse/core';
import { ChevronDown, Eye, Pen, Plus, Trash2 } from 'lucide-vue-next';
import Show from './Show.vue';

defineProps<{
    brands: Brand[];
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
        title: 'العلامات التجارية',
        href: '/brands',
    },
];

const deleteBrand = (brand: Brand) => {
    const confirmAction = confirm('هل أنت متأكد أنك تريد حذف هذه العلامة؟');
    if (!confirmAction) return;
    router.delete(route('brands.destroy', { brand: brand.id }));
};

// const restoreBrand = (brand: Brand) => {
//     router.post(route('brands.restore', { brand: brand.id }));
// };
</script>

<template>
    <Head title="جدول العلامات" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <div class="flex justify-end w-full">
                <Link :href="route('brands.create')" v-if="can('brands.create')">
                    <Button type="button">
                        <Plus />
                        <span>علامة</span>
                    </Button>
                </Link>
            </div>

            <!-- Desktop Table View -->
            <Table class="hidden md:table">
                <TableHeader>
                    <TableRow>
                        <TableHead class="text-start"> الاسم </TableHead>
                        <TableHead class="text-start"> تاريخ الإنشاء </TableHead>
                        <TableHead class="text-end"> الإجراءات </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="brand in brands" :key="brand.id">
                        <TableCell class="font-medium">
                            {{ brand.name }}
                        </TableCell>

                        <TableCell> {{ formatDateTime(brand.created_at) }} </TableCell>
                        <TableCell class="">
                            <div class="flex items-center justify-end w-full space-x-2">
                                <!-- Delete / Restore -->
                                <Button v-if="can('brands.delete')" @click="deleteBrand(brand)" type="button" variant="destructive" size="sm">
                                    <Trash2 />
                                </Button>
                                <!--
                                    <Button v-else @click="restoreBrand(brand)" type="button" variant="secondary" size="sm">
                                        <RotateCcw />
                                    </Button>
                                -->

                                <CustomDialog title="عرض العلامة" description="">
                                    <template #trigger>
                                        <Button type="button" variant="default" size="sm"><Eye /></Button>
                                    </template>
                                    <template #content>
                                        <Show :id="brand.id" />
                                    </template>
                                </CustomDialog>

                                <!-- Edit -->
                                <Link v-if="can('brands.edit')" :href="route('brands.edit', { brand: brand.id })">
                                    <Button type="button" variant="secondary" size="sm"><Pen /></Button>
                                </Link>
                            </div>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <!-- Mobile Card View -->
            <div class="space-y-2 md:hidden">
                <Card v-for="brand in brands" :key="brand.id">
                    <Collapsible>
                        <CollapsibleTrigger as-child>
                            <CardHeader class="flex-row items-center justify-between p-4 cursor-pointer">
                                <div>
                                    <CardTitle class="text-base">{{ brand.name }}</CardTitle>
                                </div>
                                <ChevronDown class="h-4 w-4 transition-transform duration-200 group-data-[state=open]:rotate-180" />
                            </CardHeader>
                        </CollapsibleTrigger>
                        <CollapsibleContent>
                            <CardContent class="pt-0 space-y-3">
                                <div>
                                    <p class="text-sm font-medium text-muted-foreground">تاريخ الإنشاء</p>
                                    <p class="text-sm">{{ formatDateTime(brand.created_at) }}</p>
                                </div>

                                <div class="flex justify-end pt-2 space-x-2">
                                    <Button v-if="can('brands.delete')" @click="deleteBrand(brand)" type="button" variant="destructive" size="sm">
                                        <Trash2 />
                                    </Button>
                                    <!--
                                        <Button v-else @click="restoreBrand(brand)" type="button" variant="secondary" size="sm">
                                            <RotateCcw />
                                        </Button>
                                    -->

                                    <CustomDialog title="عرض العلامة" description="">
                                        <template #trigger>
                                            <Button type="button" variant="default" size="sm"><Eye /></Button>
                                        </template>
                                        <template #content>
                                            <Show :id="brand.id" />
                                        </template>
                                    </CustomDialog>

                                    <Link v-if="can('brands.edit')" :href="route('brands.edit', { brand: brand.id })">
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
