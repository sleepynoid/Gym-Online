<script setup lang="ts">
import HomeLayout from '@/Layouts/HomeLayout.vue';
</script>

<template>
    <HomeLayout>
        <div class="relative">
            <div class="relative">
                <img
                    src="https://images.pexels.com/photos/1954524/pexels-photo-1954524.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    alt="Guy Doing Gym"
                    class="mx-auto h-[200px] w-full object-cover brightness-50"
                />
                <div
                    class="absolute inset-0 flex items-center justify-center text-white"
                >
                    <h1 class="text-4xl font-bold">Join Our Membership</h1>
                </div>
            </div>
            <div class="flex items-center space-x-4 bg-white p-10 px-6 py-4">
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
                <div class="flex w-1/2 flex-col space-y-4">
                    <div class="rounded-lg bg-white p-6 shadow-md">
                        <h3 class="mb-2 text-lg font-bold">Card 1</h3>
                        <p class="text-gray-700">This is the third card.</p>
                    </div>
                    <div class="rounded-lg bg-white p-6 shadow-md">
                        <h3 class="mb-2 text-lg font-bold">Card 2</h3>
                        <p class="text-gray-700">This is the fourth card.</p>
                    </div>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>
