<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NewMemberForm from './Partials/NewMemberForm.vue';
// import NewGymForm from './Partials/NewGymForm.vue';
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Add Member
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <NewMemberForm />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
