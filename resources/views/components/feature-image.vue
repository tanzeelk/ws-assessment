<template>
    <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:h-full lg:w-full" :src="source" alt="Unsplash Image" />    
</template>
<script setup lang="ts">
    defineProps<{
        source: string
    }>()
</script>