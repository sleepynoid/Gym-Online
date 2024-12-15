<script setup>
import { router } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    gyms: Array,
});

const deleteGym = (gymId) => {
    if (confirm('Are you sure you want to delete this gym?')) {
        const gymToDelete = props.gyms.find((g) => g.id === gymId);
        if (gymToDelete) {
            router.delete(route('gym.destroy', { gym: gymId }), {
                preserveScroll: true,
                onSuccess: () => {
                    alert('Gym deleted successfully.');
                    gyms.value = gyms.value.filter((gym) => gym.id !== gymId); // Remove deleted gym from local data
                },
                onError: (errors) => {
                    console.error('Failed to delete gym:', errors);
                },
            });
        }
    }
};

const redirectToEditGym = (gymId) => {
    router.visit(route('gym.edit', { gym: gymId })); // Navigate to the specified route
};
</script>

<template>
    <section>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table
                    class="min-w-full divide-y divide-gray-200 bg-white shadow-md sm:rounded-lg"
                >
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                            >
                                Name
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                            >
                                Location
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="gym in gyms" :key="gym.id">
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                            >
                                {{ gym.name }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                            >
                                {{ gym.location }}
                            </td>
                            <div class="mt-6 flex justify-end pr-4">
                                <!-- Delete Button -->
                                <SecondaryButton
                                    class="my-4 rounded-lg px-4 py-2 font-semibold shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75"
                                    @click="deleteGym(gym.id)"
                                >
                                    Delete
                                </SecondaryButton>

                                <!-- Edit Button -->
                                <SecondaryButton
                                    class="my-4 rounded-lg bg-blue-500 px-4 py-2 font-semibold text-black shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"
                                    @click.prevent="redirectToEditGym(gym.id)"
                                >
                                    Edit
                                </SecondaryButton>
                            </div>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>
