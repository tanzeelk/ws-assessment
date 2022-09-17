<script setup>
    const navigation = [
        { name: 'Home', href: '/', component: 'home' },
        { name: 'Contact', href: '/contact', component: 'contact' },
    ]
</script>
<template>
    <Link v-for="item in navigation" :key="item.name" :href="item.href" class="font-medium text-gray-500 hover:text-red-600" :class="{'text-red-600' : $page.component === item.component}">{{ item.name }}</Link>			
</template>