<script setup>
defineProps({
    messages: {
        type: Array,
    },
});
</script>

<template>
    <div v-show="messages">
        <p
            v-for="message in messages"
            class="text-sm text-red-600 dark:text-red-400"
        >
            {{ message }}
        </p>
    </div>
</template>
