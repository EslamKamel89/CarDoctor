<script setup lang="ts">
import Badge from '@/components/ui/badge/Badge.vue';
import Skeleton from '@/components/ui/skeleton/Skeleton.vue';
import { Role } from '@/types/app';
import { onMounted, ref } from 'vue';

const props = defineProps<{
    roleId: number;
}>();

const role = ref<Role>();
const isLoading = ref(false);

onMounted(async () => {
    try {
        isLoading.value = true;
        const res = await fetch(route('roles.show', { role: props.roleId }));
        role.value = await res.json();
    } catch (error) {
        console.log(error);
    } finally {
        isLoading.value = false;
    }
});
</script>

<template>
    <div class="space-y-4" v-if="!isLoading">
        <div>
            <div class="text-xs font-thin">الاسم:</div>
            <div>{{ role?.name_ar }}</div>
        </div>

        <div>
            <div class="text-xs font-thin">الصلاحيات</div>
            <div class="mt-1 flex flex-wrap gap-1">
                <Badge v-for="permission in role?.permissions" :key="permission.id" variant="secondary">{{ permission.name_ar }}</Badge>
            </div>
        </div>
    </div>
    <div v-else class="space-y-4">
        <div class="space-y-2">
            <Skeleton class="h-4 w-1/3" />
            <Skeleton class="h-8 w-full" />
        </div>
        <div class="space-y-2">
            <Skeleton class="h-4 w-1/3" />
            <Skeleton class="h-8 w-full" />
        </div>
        <div class="space-y-2">
            <Skeleton class="h-4 w-1/3" />
            <div class="mt-1 flex flex-wrap gap-1">
                <Badge v-for="i in 6" :key="i" variant="secondary"> <Skeleton class="h-4 w-20" /></Badge>
            </div>
        </div>
    </div>
</template>
