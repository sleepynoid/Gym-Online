<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

// Create a form instance
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

// Refs for focusing fields
const passwordRef = ref(null);
const passwordConfirmationRef = ref(null);

const submit = () => {
    form.post(route('users'), {
        preserveScroll: true, // Retain scroll position
        onSuccess: () => {
            // Clear all form fields and error messages
            form.reset();
            form.clearErrors();
        },
        onError: () => {
            // Handle specific field errors
            if (form.errors.password) {
                form.reset('password', 'password_confirmation'); // Reset password fields
                passwordRef.value?.focus(); // Focus on password input
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Insert your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <!-- Name Field -->
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Email Field -->
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Password Field -->
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    autocomplete="new-password"
                    required
                    ref="passwordRef"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Password Confirmation Field -->
            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    ref="passwordConfirmationRef"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <!-- Submit Button and Status -->
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
