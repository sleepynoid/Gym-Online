<script setup>
import { router } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    users: Array,
});

// const deleteUser = (id) => {
//     if (confirm('Are you sure you want to delete this user?')) {
//         router.delete(route('users.destroy', id), {
//             onSuccess: () => {
//                 alert('User deleted successfully!');
//             },
//             onError: (errors) => {
//                 console.error(errors);
//             },
//         });
//     }
// };

const deleteUserBeta = (name, email) => {
    if (confirm('Are you sure you want to delete this user?')) {
        router.delete(route('users.destroy'), {
            data: { name, email },
            preserveState: true,
            onSuccess: () => {
                alert('User deleted successfully.');
            },
            onError: (errors) => console.error(errors),
        });
    }
};

const redirectToEditUser = (id) => {
    router.visit(route('users.edit', id)); // Navigate to the specified route
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
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="user in users" :key="user.id">
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                            >
                                {{ user.id }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                            >
                                {{ user.name }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"
                            >
                                {{ user.email }}
                            </td>
                            <div class="mt-6 flex justify-end pr-4">
                                <!-- Delete Button -->
                                <SecondaryButton
                                    class="my-4 rounded-lg px-4 py-2 font-semibold shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75"
                                    @click="
                                        deleteUserBeta(user.name, user.email)
                                    "
                                >
                                    Delete
                                </SecondaryButton>

                                <!-- Edit Button -->
                                <SecondaryButton
                                    class="my-4 rounded-lg bg-blue-500 px-4 py-2 font-semibold text-black shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"
                                    @click.prevent="redirectToEditUser(user.id)"
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
