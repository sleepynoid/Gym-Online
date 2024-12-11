<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdateGymInfoForm from '@/Pages/Gym/Partials/UpdateGymInfoForm.vue';

// Simulated data for the gym (replace with actual data fetched from the backend)
// const gym = {
//     id: 1,
//     name: 'Awesome Gym',
//     location: 'Longitude: 106.827153, Latitude: -6.17511',
// };
defineProps({
    gym: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <header>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Edit Gym Information
                </h2>
                <!-- <p class="mt-1 text-sm text-gray-600">
                    Update the details of the gym below.
                </p> -->
            </header>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <UpdateGymInfoForm :gym="gym" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
