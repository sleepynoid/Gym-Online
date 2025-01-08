<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import HomeLayout from '@/Layouts/HomeLayout.vue';
</script>

<template>
    <HomeLayout>
        <div class="relative">
            <div class="relative">
                <img
                    src="/pexels-photo-1954524.webp"
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
                        <h3 class="mb-2 text-lg font-bold">Rp. 385.000</h3>
                        <p class="text-gray-700">per bulan</p>
                        <p>only 1.555.000</p>
                        <hr class="my-4 border-gray-500" />
                        <div class="flex items-center justify-center">
                            <PrimaryButton
                                class="flex w-48 justify-center bg-blue-500 text-center"
                                >Join Now</PrimaryButton
                            >
                        </div>
                        <!-- <p class="text-gray-700">This is the first card.</p> -->
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
