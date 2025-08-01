<script setup lang="ts">
import Skeleton from '@/components/ui/skeleton/Skeleton.vue';
import { Brand } from '@/types/app';
import { onMounted, ref } from 'vue';
import Form from './Form.vue';
const brand = ref<Brand>();
const isLoading = ref(false);
const props = defineProps<{ id: number }>();
onMounted(async () => {
    try {
        isLoading.value = true;
        const res = await fetch(route('brands.show', { brand: props.id }));
        brand.value = await res.json();
    } catch (error) {
        console.log(error);
    } finally {
        isLoading.value = false;
    }
});
</script>
<template>
    <Form action="show" :brand="brand" v-if="brand" />
    <template v-else>
        <div class="flex flex-col space-y-2">
            <Skeleton class="h-5 w-[250px]" />
            <Skeleton class="w-full h-5" />
        </div>
    </template>
</template>
