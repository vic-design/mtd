<script setup>
import { ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';

const links = ref([
        {
            href: 'dashboard',
            title: 'Dashboard'
        },
        {
            href: 'test.index',
            title: 'Test'
        },
        {
            href: 'car-mechanic',
            title: 'Car Mechanic'
        },
    ]);
</script>

<template>
    <NavLink v-for="link in links"
        :href="route(link.href)"
        :active="route().current(link.href)"
    >
        {{link.title}}
    </NavLink>
</template>
