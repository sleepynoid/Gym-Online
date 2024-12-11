<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import MapboxMap from '@/Components/MapboxMap.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    location: '',
    errors: { name: null, location: null },
    processing: false,
    recentlySuccessful: false,
});
const handleMarkerAdded = ({ lng, lat }) => {
    form.location = `Longitude: ${lng}, Latitude: ${lat}`;
    console.log('Selected location:', form.location);
};
const submit = () => {
    form.processing = true;
    // Reset errors before submission
    form.errors.name = null;
    form.errors.location = null;

    // Submit form data to the server using Inertia.js
    form.post(route('gym.insert'), {
        onSuccess: () => {
            form.processing = false;
            form.recentlySuccessful = true;

            // Reset success message after 3 seconds
            setTimeout(() => {
                form.recentlySuccessful = false;
            }, 3000);

            // Reset form fields after successful submission
            form.name = '';
            form.location = '';
        },
        onError: (errors) => {
            form.processing = false;
            // Set errors for fields
            if (errors.name) {
                form.errors.name = errors.name[0];
            }
            if (errors.location) {
                form.errors.location = errors.location[0];
            }
            console.log('Form submission errors:', errors);
        },
        preserveScroll: true, // Retain scroll position
    });

    console.log('Form submitted with:', {
        name: form.name,
        location: form.location,
    });
};

const mapboxToken = import.meta.env.VITE_MAPS_API_KEY; // Replace with your token
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Gym Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Insert Gym information and Location.
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

            <!-- Map Section for Location -->
            <div>
                <InputLabel for="location" value="Location" />
                <div
                    style="
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        flex-direction: column;
                        height: 400px;
                        width: 100%;
                        border: 1px solid #ddd;
                        border-radius: 5px;
                        overflow: hidden;
                    "
                >
                    <MapboxMap
                        :accessToken="mapboxToken"
                        :center="[106.827153, -6.17511]"
                        :zoom="10"
                        @marker-added="handleMarkerAdded"
                    />
                </div>
                <TextInput
                    id="location"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.location"
                    required
                    readonly
                    autocomplete="location"
                />
                <InputError class="mt-2" :message="form.errors.location" />
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
