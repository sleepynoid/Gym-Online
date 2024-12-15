<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

// Create a form instance
const form = useForm({
    name: '',
    email: '',
    phone_number: '',
    address: '',
    tier: '',
});

const submit = () => {
    form.post(route('member.insert'), {
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
                Member Information
            </h2>

            <p class="mt-1 text-sm text-gray-600">Insert Member information.</p>
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
                    autocomplete="email"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Phone_number Field -->
            <div>
                <InputLabel for="phone_number" value="Phone_number" />
                <TextInput
                    id="phone_number"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone_number"
                    autocomplete="phone-number"
                    required
                />
                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <!-- Address Field -->
            <div class="mt-4">
                <InputLabel for="address" value="Address" />
                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    required
                    autocomplete="address"
                />
                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <!-- tier Field -->
            <div class="mt-4">
                <InputLabel for="tier" value="Tier" />
                <TextInput
                    id="tier"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.tier"
                    required
                    autocomplete="tier"
                />
                <InputError class="mt-2" :message="form.errors.tier" />
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
