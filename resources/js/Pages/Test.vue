<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, provide, ref } from 'vue';
import axios from 'axios';
import Test from '@/Components/Test/Index.vue';
import Pagination from '@/Components/Pagination.vue';


const tests = ref();
const pages = ref();

onMounted (() => {
    changePage(route('test.list'))
});

const changePage = (url) => {
    axios.get(url).then((data) => {
        tests.value = data.data.data;
        pages.value = data.data;
        pages.value.data = null;
        // console.log(data.data);
    });
}

</script>

<template>
    <Head title="Test page" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
            Test page
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="pages"
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <Pagination :pages="pages" @changePage="changePage"></Pagination>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div>
                            <div v-for="test in tests" class="pb-6 text-gray-900 dark:text-gray-100">
                                <Test
                                    :article="test"
                                />
                            </div>
                        </div>
                    </div>
                    <Pagination :pages="pages" @changePage="changePage"></Pagination>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
