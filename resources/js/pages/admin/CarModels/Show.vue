<script setup lang="ts">
import Skeleton from '@/components/ui/skeleton/Skeleton.vue';
import { CarModel } from '@/types/app';
import { onMounted, ref } from 'vue';
import Form from './Form.vue';

const carModel = ref<CarModel>();
const isLoading = ref(false);
const props = defineProps<{ id: number }>();

onMounted(async () => {
    try {
        isLoading.value = true;
        const res = await fetch(route('car-models.show', { car_model: props.id }));
        carModel.value = await res.json();
    } catch (error) {
        console.log(error);
    } finally {
        isLoading.value = false;
    }
});
</script>

<template>
    <Form action="show" :car_model="carModel" v-if="carModel" />
    <template v-else>
        <div class="flex flex-col space-y-2">
            <Skeleton class="h-5 w-[250px]" />
            <Skeleton class="h-5 w-full" />
        </div>
    </template>
</template>
