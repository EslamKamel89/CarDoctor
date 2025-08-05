<script setup lang="ts">
import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input/Input.vue';
import { AppPageProps } from '@/types';
import { Brand } from '@/types/app';
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage<
    AppPageProps & {
        brands: Brand[];
        filters: {
            brand_id: string | null;
            year_from: string | null;
            year_to: string | null;
        };
    }
>();

// State
const filters = ref({
    brand_id: page.props.filters.brand_id ?? '',
    year_from: page.props.filters.year_from ?? '',
    year_to: page.props.filters.year_to ?? '',
});

const errors = ref({
    year_range: '',
});

// Validate year range
const validate = (): boolean => {
    const from = filters.value.year_from ? parseInt(filters.value.year_from) : null;
    const to = filters.value.year_to ? parseInt(filters.value.year_to) : null;

    if (from !== null && to !== null && from > to) {
        errors.value.year_range = 'يجب أن تكون "من سنة" أقل من أو تساوي "إلى سنة"';
        return false;
    }

    errors.value.year_range = '';
    return true;
};

// Apply Filters
const applyFilters = () => {
    if (!validate()) return;

    router.get(
        route('car-models.index'),
        {
            'filter[brand_id]': filters.value.brand_id || undefined,
            'filter[year_from]': filters.value.year_from || undefined,
            'filter[year_to]': filters.value.year_to || undefined,
        },
        {
            preserveState: true,
            replace: true,
        },
    );
};

// Reset Filters
const resetFilters = () => {
    filters.value = {
        brand_id: '',
        year_from: '',
        year_to: '',
    };
    errors.value.year_range = '';

    router.get(
        route('car-models.index'),
        {},
        {
            preserveState: true,
            replace: true,
        },
    );
};
</script>

<template>
    <div class="mb-4 space-y-4">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            <!-- Brand -->
            <div class="grid w-full items-center gap-1.5">
                <label for="filter-brand" class="text-sm font-medium">العلامة التجارية</label>
                <select id="filter-brand" v-model="filters.brand_id" class="rounded-lg border border-gray-600 px-3 py-2">
                    <option disabled>جميع العلامات</option>
                    <option v-for="brand in page.props.brands" :key="brand.id" :value="brand.id">{{ brand.name_ar }}</option>
                </select>
            </div>

            <!-- Year From -->
            <div class="grid w-full items-center gap-1.5">
                <label for="filter-year-from" class="text-sm font-medium">من سنة</label>
                <Input id="filter-year-from" v-model="filters.year_from" type="number" />
            </div>

            <!-- Year To -->
            <div class="grid w-full items-center gap-1.5">
                <label for="filter-year-to" class="text-sm font-medium">إلى سنة</label>
                <Input id="filter-year-to" v-model="filters.year_to" type="number" />
            </div>

            <!-- Actions -->
            <div class="flex items-end space-x-2 space-x-reverse">
                <Button type="button" variant="default" size="sm" @click="applyFilters"> تصفية </Button>
                <Button type="button" variant="secondary" size="sm" @click="resetFilters"> إلغاء </Button>
            </div>
        </div>

        <!-- Validation Error -->
        <div v-if="errors.year_range" class="mt-1 text-sm text-destructive">
            {{ errors.year_range }}
        </div>
    </div>
</template>
