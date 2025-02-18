<script setup>

import { Head } from '@inertiajs/vue3';
import { onMounted, shallowRef } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SideMenu from '@/Components/Menu/SideMenu.vue';
import Races from '@/Components/CarMechanic/Races.vue';
import Engines from '@/Components/CarMechanic/Engines.vue';
import Marks from '@/Components/CarMechanic/Marks.vue';
import Models from '@/Components/CarMechanic/Models.vue';

const currentPage = shallowRef();

onMounted (() => {
    if(location.hash === "") {
        location.replace(location.origin + "/car#Races");
    }
    currentPage.value = pages[location.hash.substring(1)];
});

const pages = {
    Races: Races,
    Engines: Engines,
    Marks: Marks,
    Models: Models,
};

const changePage = (page) => {
    location.replace(location.origin + "/car#" + page);
    currentPage.value = pages[page];
}

</script>

<template>
    <Head title="Test page" />

    <AuthenticatedLayout>

        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
            Car Mechanic
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-flow-row-dense grid-cols-4">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 mr-2"
                >
                    <SideMenu @changePage="changePage"/>
                </div>

                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 col-span-3"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100 h-full">
                        <component :is="currentPage"></component>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
