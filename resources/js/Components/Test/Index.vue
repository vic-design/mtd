<script setup>
import { computed } from 'vue';
import moment from 'moment';

const props = defineProps({
    article: {
        type: Object,
        required: true,
    },
});

const articleDate = computed(() => moment(props.article.created_at).format('DD.MM.YYYY hh:mm'))

</script>

<template>
    <div class="font-semibold text-lg">{{ article.id }}. {{ article.title }}</div>
    <div class="py-3">{{ article.content }}</div>
    <div class="text-gray-400 text-xs text-right">{{ articleDate }}</div>
    <hr/>
</template>
