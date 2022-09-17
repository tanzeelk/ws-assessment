<script setup>
    const navigation = [
        { name: 'Home', href: '/', component: 'home' },
        { name: 'Contact', href: '/contact', component: 'contact' },
    ]
</script>
<template>
    <Link v-for="item in navigation" :key="item.name" :href="item.href" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-red-600" :class="{'text-red-600' : $page.component === item.component}">{{ item.name }}</Link>					
</template>