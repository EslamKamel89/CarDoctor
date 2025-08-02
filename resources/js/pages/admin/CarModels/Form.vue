<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import Select from '@/components/ui/select/Select.vue';
import { CarModel } from '@/types/app';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    action: 'create' | 'edit' | 'show';
    car_model?: CarModel;
    brands?: Record<string, string>;
}>();

const form = useForm({
    brand_id: props.car_model?.brand_id ?? '',
    name_ar: props.car_model?.name_ar ?? '',
    name_en: props.car_model?.name_en ?? '',
    year_range: props.car_model?.year_range ?? [2015, 2020],
});
</script>

<template>
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
        <form @submit.prevent="$emit('submit')" class="flex w-full flex-col items-start space-y-3">
            <div class="grid w-full items-center gap-1.5">
                <Label for="brand_id">العلامة التجارية</Label>
                <Select :disabled="action === 'show'" v-model="form.brand_id" id="brand_id" :options="brands" placeholder="اختر العلامة" />
                <div class="text-xs font-thin text-red-700" v-if="form.errors.brand_id">
                    {{ form.errors.brand_id }}
                </div>
            </div>

            <div class="grid w-full items-center gap-1.5">
                <Label for="name_ar">الاسم</Label>
                <Input :disabled="action === 'show'" v-model="form.name_ar" id="name_ar" type="text" placeholder="كورولا" />
                <div class="text-xs font-thin text-red-700" v-if="form.errors.name_ar">
                    {{ form.errors.name_ar }}
                </div>
            </div>

            <div class="grid w-full items-center gap-1.5">
                <Label for="year_range">نطاق السنوات</Label>
                <div class="flex space-x-2 space-x-reverse">
                    <Input :disabled="action === 'show'" v-model.number="form.year_range[0]" type="number" placeholder="من" class="w-1/2" />
                    <Input :disabled="action === 'show'" v-model.number="form.year_range[1]" type="number" placeholder="إلى" class="w-1/2" />
                </div>
                <div class="text-xs font-thin text-red-700" v-if="form.errors.year_range">
                    {{ form.errors.year_range }}
                </div>
            </div>

            <Button type="submit" class="max-w-sm" v-if="action !== 'show'">
                {{ action === 'create' ? 'إنشاء' : 'تحديث' }}
            </Button>
        </form>
    </div>
</template>
