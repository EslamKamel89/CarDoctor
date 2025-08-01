<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Brand } from '@/types/app';
import { useForm } from '@inertiajs/vue3';
const props = defineProps<{
    action: 'create' | 'edit' | 'show';
    brand?: Brand;
}>();

const form = useForm({
    name_ar: props.brand?.name_ar ?? '',
    name_en: props.brand?.name_en ?? '',
});
const submit = async () => {
    if (props.action === 'create') {
        form.post(route('brands.store'));
    } else if (props.action === 'edit') {
        form.put(route('brands.update', { brand: props.brand?.id }));
    }
};
</script>

<template>
    <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
        <form @submit.prevent="submit" class="flex flex-col items-start w-full space-y-3">
            <div class="grid w-full items-center gap-1.5">
                <Label for="name_ar">الاسم</Label>
                <Input :disabled="props.action === 'show'" v-model="form.name_ar" id="name_ar" type="text" placeholder=" علامة تجارية" />
                <div class="text-xs font-thin text-red-700" v-if="form.errors.name_ar">{{ form.errors.name_ar }}</div>
            </div>

            <div class="grid w-full items-center gap-1.5" v-if="false">
                <Label for="name_en">الاسم (إنجليزي)</Label>
                <Input v-model="form.name_en" id="name_en" type="text" placeholder="Toyota" />
                <div class="text-xs font-thin text-red-700" v-if="form.errors.name_en">{{ form.errors.name_en }}</div>
            </div>

            <Button type="submit" class="max-w-sm" v-if="props.action != 'show'">{{ props.action == 'create' ? 'إنشاء' : 'تحديث' }}</Button>
        </form>
    </div>
</template>
