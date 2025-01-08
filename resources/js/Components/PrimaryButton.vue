<template>
    <button
        class="inline-flex items-center rounded-md border border-transparent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2"
        :class="`bg-${color || 'gray'}-800 hover:bg-${color || 'gray'}-700 focus:bg-${color || 'gray'}-700 focus:ring-${color || 'gray'}-500 focus:ring-offset-2 active:bg-${color || 'gray'}-900`"
    >
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        color: {
            type: String,
            default: null,
        },
    },
};
</script>
