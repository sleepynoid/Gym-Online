<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import UserTable from './Partials/UserTable.vue';

const redirectToCreateUser = () => {
    router.visit(route('users.create')); // Navigate to the specified route
};

defineProps({
    users: Array,
});
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard Users
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <PrimaryButton
                    class="my-4 rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"
                    @click.prevent="redirectToCreateUser"
                >
                    Create Users
                </PrimaryButton>
                <UserTable :users="users" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
