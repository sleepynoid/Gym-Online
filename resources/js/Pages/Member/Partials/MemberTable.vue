<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { router } from '@inertiajs/vue3';

defineProps({
    members: Array,
});

const deleteMember = (memberId) => {
    if (confirm('Are you sure you want to delete this member?')) {
        router.delete(route('member.destroy', { member: memberId }), {
            preserveScroll: true,
            onSuccess: () => {
                alert('Member deleted successfully.');
            },
            onError: (errors) => {
                console.error('Failed to delete member:', errors);
            },
        });
    }
};

const redirectToEditMember = (memberId) => {
    router.visit(route('member.edit', { member: memberId })); // Navigate to the specified route
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
                                ID
                            </th>
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
                                Email
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                            >
                                Address
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                            >
                                Phone Number
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                            >
                                Tier
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="member in members" :key="member.id">
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                            >
                                {{ member.id }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                            >
                                {{ member.name }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                            >
                                {{ member.email }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                            >
                                {{ member.address }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                            >
                                {{ member.phone_number }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                            >
                                {{ member.tier }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                            >
                                <div class="flex space-x-2">
                                    <!-- Delete Button -->
                                    <SecondaryButton
                                        class="rounded-lg px-4 py-2 font-semibold shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75"
                                        @click="deleteMember(member.id)"
                                    >
                                        Delete
                                    </SecondaryButton>

                                    <!-- Edit Button -->
                                    <SecondaryButton
                                        class="rounded-lg bg-blue-500 px-4 py-2 font-semibold text-black shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"
                                        @click.prevent="
                                            redirectToEditMember(member.id)
                                        "
                                    >
                                        Edit
                                    </SecondaryButton>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>
