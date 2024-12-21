<script setup lang="ts">
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <HomeLayout :laravel-version="laravelVersion" :php-version="phpVersion">
        <div class="relative">
            <img
                src="https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                alt="Guy Doing Gym"
                class="mx-auto h-screen w-full object-cover brightness-50"
            />
            <div
                class="absolute left-[121px] top-[270px] transform text-4xl font-bold leading-[1.5rem] text-white"
            >
                <h1>MINIMUM PRICE</h1>
                <br />
                <h1>PREMIUM GYM</h1>
            </div>
            <PrimaryButton class="absolute left-[121px] top-[360px] transform"
                >Start Your Journey</PrimaryButton
            >
        </div>
        <div class="flex items-center bg-white p-10">
            <div class="flex w-1/2 flex-col space-y-4">
                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h3 class="mb-2 text-lg font-bold">Card 1</h3>
                    <p class="text-gray-700">This is the first card.</p>
                </div>
                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h3 class="mb-2 text-lg font-bold">Card 2</h3>
                    <p class="text-gray-700">This is the second card.</p>
                </div>
            </div>
            <div
                class="ml-4 h-[232px] w-1/2 rounded-lg bg-blue-500 p-6 shadow-md"
            >
                <h3 class="mb-2 text-lg font-bold">Card 3</h3>
                <p class="text-gray-700">
                    This is the third card, which is the same height as the
                    combined height of the first and second cards.
                </p>
            </div>
            <div
                class="ml-4 flex h-full w-full flex-col items-center justify-center rounded-lg bg-red-500 p-8 shadow-md"
            >
                <p class="text-center text-2xl font-bold">
                    Join Our Premium Gym
                </p>
                <p class="mt-4 text-center text-lg">
                    Fill out the form below to join our premium gym at a
                    promotional price of Rp 249,000.
                </p>
                <div class="mt-8 w-full">
                    <PrimaryButton class="w-full">Join Now</PrimaryButton>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>
