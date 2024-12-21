<script setup>
import { Link } from '@inertiajs/vue3';

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
    <main>
        <div class="bg-indigo-500">
            <nav class="container mx-auto flex justify-between py-4">
                <Link
                    href="/"
                    class="text-lg font-bold text-black dark:text-white"
                    >Laravel</Link
                >
                <ul class="flex space-x-6">
                    <li>
                        <Link
                            :href="route('login')"
                            class="text-black dark:text-white"
                            >Login</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('register')"
                            class="text-black dark:text-white"
                            >Register</Link
                        >
                    </li>
                </ul>
            </nav>
        </div>
        <slot />
        <footer
            class="py-16 text-center text-sm text-black dark:bg-black dark:text-white/70"
        >
            Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </footer>
    </main>
</template>
