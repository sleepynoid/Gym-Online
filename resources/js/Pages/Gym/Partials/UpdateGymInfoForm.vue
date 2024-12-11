<script setup>
import { watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import MapboxMap from '@/Components/MapboxMap.vue';

// Form setup
const props = defineProps({
    gym: Object, // Pre-filled gym data passed as a prop
});

const form = useForm({
    name: props.gym.name || '',
    location: props.gym.location || '',
});

watch(
    () => props.gym,
    (newGym) => {
        if (newGym) {
            form.name = newGym.name || '';
            form.location = newGym.location || '';
        }
    },
    { immediate: true },
);

// Mapbox token
const mapboxToken = import.meta.env.VITE_MAPS_API_KEY;

// Handle map marker addition
const handleMarkerAdded = ({ lng, lat }) => {
    form.location = `Longitude: ${lng}, Latitude: ${lat}`;
    console.log('Updated location:', form.location);
};

// Parse the location string into [longitude, latitude]
const parseCoordinates = (location) => {
    if (!location) return [106.827153, -6.17511]; // Default center if location is not available

    const matches = location.match(
        /Longitude:\s*(-?\d+(\.\d+)?),\s*Latitude:\s*(-?\d+(\.\d+)?)/,
    );
    if (matches) {
        const lng = parseFloat(matches[1]);
        const lat = parseFloat(matches[3]);
        return [lng, lat];
    }

    return [106.827153, -6.17511]; // Default center if parsing fails
};

// Submit form
const submit = () => {
    form.put(route('gym.update', { id: props.gym.id }), {
        onSuccess: () => {
            console.log('Gym info updated successfully');
        },
        onError: (errors) => {
            console.log('Error updating gym info:', errors);
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Edit Gym Information
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Update the details of the gym below.
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
                        :center="parseCoordinates(gym.location)"
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

            <!-- Submit Button -->
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing"
                    >Update</PrimaryButton
                >
            </div>
        </form>
    </section>
</template>
