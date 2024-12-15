<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const googleLoginUrl = route('auth.google'); // Ensure this matches the Laravel route for Google login
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <!-- Email/Password Login Form -->
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>

        <!-- Google Login Button -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Or log in with:</p>
            <a
                :href="googleLoginUrl"
                class="mt-2 inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
            >
                <svg class="h-5 w-5 me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M22.54 12.27c0-.83-.08-1.62-.23-2.39H12v4.52h5.89a5.04 5.04 0 0 1-2.19 3.31v2.76h3.54c2.07-1.91 3.3-4.73 3.3-8.2z"
                        fill="#4285F4"
                    />
                    <path
                        d="M12 24c3.24 0 5.96-1.07 7.95-2.92l-3.54-2.76c-1.01.68-2.33 1.09-4.41 1.09-3.39 0-6.26-2.29-7.29-5.39H1.92v2.84A11.97 11.97 0 0 0 12 24z"
                        fill="#34A853"
                    />
                    <path
                        d="M4.71 14.02a7.18 7.18 0 0 1 0-4.04V7.14H1.92a12.05 12.05 0 0 0 0 9.72l2.79-2.84z"
                        fill="#FBBC05"
                    />
                    <path
                        d="M12 4.76c1.78 0 3.38.61 4.64 1.8l3.47-3.47C18.12 1.23 15.39 0 12 0 7.25 0 3.11 2.69 1.92 7.14l2.79 2.84C5.74 6.65 8.61 4.76 12 4.76z"
                        fill="#EA4335"
                    />
                </svg>
                Google
            </a>
        </div>
    </GuestLayout>
</template>
