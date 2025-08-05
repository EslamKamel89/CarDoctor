<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Brand, CarModel } from '@/types/app';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    action: 'create' | 'edit' | 'show';
    car_model?: CarModel;
    brands?: Brand[];
}>();

const form = useForm({
    brand_id: props.car_model?.brand_id ?? '',
    name_ar: props.car_model?.name_ar ?? '',
    name_en: props.car_model?.name_en ?? '',
    year_range: props.car_model?.year_range ?? [undefined, undefined],
});
const submit = async () => {
    if (props.action === 'create') {
        form.post(route('car-models.store'));
    } else if (props.action === 'edit') {
        form.put(route('car-models.update', { car_model: props.car_model?.id }));
    }
};
</script>

<template>
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
        <form @submit.prevent="submit" class="flex w-full flex-col items-start space-y-3">
            <div class="grid w-full items-center gap-1.5">
                <Label for="brand_id">العلامة التجارية</Label>
                <select v-if="action != 'show'" id="filter-brand" v-model="form.brand_id" class="rounded-lg border border-gray-600 px-3 py-2">
                    <option disabled>جميع العلامات</option>
                    <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name_ar }}</option>
                </select>
                <div v-else>
                    {{ car_model?.brand.name_ar }}
                </div>
                <div class="text-xs font-thin text-red-700" v-if="form.errors.brand_id">
                    {{ form.errors.brand_id }}
                </div>
            </div>

            <div class="grid w-full items-center gap-1.5">
                <Label for="name_ar">الاسم</Label>
                <Input :disabled="action === 'show'" v-model="form.name_ar" id="name_ar" type="text" />
                <div class="text-xs font-thin text-red-700" v-if="form.errors.name_ar">
                    {{ form.errors.name_ar }}
                </div>
            </div>

            <div class="grid w-full items-center gap-1.5">
                <Label for="year_range">نطاق السنوات</Label>
                <div class="flex space-x-2 space-x-reverse">
                    <div class="flex w-full flex-col">
                        <Input :disabled="action === 'show'" v-model.number="form.year_range[0]" type="number" placeholder="من" class="w-1/2" />
                        <div class="text-xs font-thin text-red-700">
                            {{ (form.errors as any)['year_range.0'] ?? null }}
                        </div>
                    </div>
                    <div class="flex w-full flex-col">
                        <Input :disabled="action === 'show'" v-model.number="form.year_range[1]" type="number" placeholder="إلى" class="w-1/2" />
                        <div class="text-xs font-thin text-red-700">
                            {{ (form.errors as any)['year_range.1'] ?? null }}
                        </div>
                    </div>
                </div>
            </div>

            <Button type="submit" class="max-w-sm" v-if="action !== 'show'">
                {{ action === 'create' ? 'إنشاء' : 'تحديث' }}
            </Button>
        </form>
    </div>
</template>
