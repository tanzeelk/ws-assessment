<script setup lang="ts">
    
    import { useForm } from '@inertiajs/inertia-vue3'

	const form = useForm({
		name: null,
		email: null,
		phone: null,
		message: ''
	});

	let submit = () => {

		form.post('/contact', {
			preserveScroll: true,
			onSuccess: () => form.reset(),
		});
	};

</script>
<template>
    <form @submit.prevent="submit">
        <div class="bg-white px-4 py-5 sm:mt-4 sm:p-0">
            <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input v-model="form.name" type="text" name="name" id="name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-300 focus:ring-red-300 sm:text-sm" />
                <p v-if="form.errors.name" v-text="form.errors.name" class="mt-2 text-sm text-red-500"></p>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input v-model="form.email" type="email" name="email" id="email" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-300 focus:ring-red-300 sm:text-sm" />
                <p v-if="form.errors.email" v-text="form.errors.email" class="mt-2 text-sm text-red-500"></p>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input v-model="form.phone" type="tel" name="phone" id="phone" autocomplete="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-300 focus:ring-red-300 sm:text-sm" />
                <p v-if="form.errors.phone" v-text="form.errors.phone" class="mt-2 text-sm text-red-500"></p>
            </div>
            
            <div class="col-span-6 sm:col-span-5">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea v-model="form.message" id="message" name="message" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-300 focus:ring-red-300 sm:text-sm" placeholder="Type your message here" />
                <p v-if="form.errors.message" v-text="form.errors.message" class="mt-2 text-sm text-red-500"></p>
            </div>

            </div>
        </div>

        <p v-if="$page.props.flash.message" v-text="$page.props.flash.message" class="mt-2 text-md text-green-700"></p>

        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
            <div class="rounded-md shadow">
                <button type="submit" :disabled="form.processing" class="flex w-full items-center justify-center rounded-md border border-transparent bg-red-600 px-8 py-3 text-base font-medium text-white hover:bg-red-700 md:py-4 md:px-10 md:text-lg">Send Message</button>
            </div>
        </div>
            
    </form>
</template>