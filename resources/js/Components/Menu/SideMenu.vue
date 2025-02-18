<script setup>
import { markRaw, ref } from 'vue';
import IconRace from '../icons/IconRace.vue';
import IconCar from '../icons/IconCar.vue';
import IconCar2 from '../icons/IconCar2.vue';
import IconEngine from '../icons/IconEngine.vue';


const menu = ref([
        {
            title: 'Races',
            icon: markRaw(IconRace),
        },
        {
            title: 'Marks',
            icon: markRaw(IconCar),
        },
        {
            title: 'Models',
            icon: markRaw(IconCar2),
        },
        {
            title: 'Engines',
            icon: markRaw(IconEngine),
        },
    ]);

const emit = defineEmits(['changePage']);
</script>

<template>
    <div id="Main" class="xl:rounded-r transform  xl:translate-x-0  ease-in-out transition duration-500 flex justify-start items-start h-full w-full flex-col">
        <div class="mt-6 flex flex-col justify-start items-center  pl-4 w-full space-y-3 pb-5 ">
            <button
                v-for="item in menu"
                class="flex jusitfy-start items-center space-x-6 w-full  focus:outline-none  focus:text-indigo-400  text-white rounded "
            >
                <component :is="item.icon"></component>

                <p class="text-base leading-4" @click="emit('changePage', item.title)">{{ item.title }}</p>
            </button>
        </div>
    </div>
</template>
