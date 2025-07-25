<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import Select from '@/components/ui/select/Select.vue';
import SelectContent from '@/components/ui/select/SelectContent.vue';
import SelectGroup from '@/components/ui/select/SelectGroup.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import SelectLabel from '@/components/ui/select/SelectLabel.vue';
import SelectTrigger from '@/components/ui/select/SelectTrigger.vue';
import SelectValue from '@/components/ui/select/SelectValue.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Role } from '@/types/app';
import { Head, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'المستخدمون',
        href: '/users',
    },
    {
        title: 'إنشاء',
        href: '/users/create',
    },
];

const form = useForm({
    name: '',
    email: '',
    password: '',
    roleId: null as number | null,
});

const props = defineProps<{
    roles: Role[];
}>();
</script>

<template>
    <Head title="إنشاء مستخدم" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-4">
            <form @submit.prevent="form.post(route('users.store'))" class="flex w-full flex-col space-y-3">
                <div class="grid w-full items-center gap-1.5">
                    <Label for="name">الاسم</Label>
                    <Input v-model="form.name" id="name" type="text" placeholder="الاسم" />
                    <div class="text-xs font-thin text-red-700" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div class="grid w-full items-center gap-1.5">
                    <Label for="email">البريد الإلكتروني</Label>
                    <Input v-model="form.email" id="email" type="email" placeholder="البريد الإلكتروني" />
                    <div class="text-xs font-thin text-red-700" v-if="form.errors.email">{{ form.errors.email }}</div>
                </div>
                <div class="grid w-full items-center gap-1.5">
                    <Label for="password">كلمة المرور</Label>
                    <Input v-model="form.password" id="password" type="password" placeholder="كلمة المرور" />
                    <div class="text-xs font-thin text-red-700" v-if="form.errors.password">{{ form.errors.password }}</div>
                </div>
                <div class="grid w-full items-center gap-1.5">
                    <Label>اختر الدور</Label>
                    <Select v-model="form.roleId">
                        <SelectTrigger class="w-full">
                            <SelectValue placeholder="اختر الدور" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectLabel>الأدوار</SelectLabel>
                                <SelectItem v-for="role in roles" :key="role.id" :value="role.id"> {{ role.name_ar }} </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                </div>
                <Button type="submit" class="w-fit">إنشاء</Button>
            </form>
        </div>
    </AppLayout>
</template>
