<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';

import { ref, watchEffect } from 'vue';

const props = defineProps({ stores: Object, auth: Object });

const form = useForm({
    id: 0,
    is_active: false,
})

const updateForm = (store) => {
    form.reset();
    Object.keys(store).forEach(element => {
        form[element] = store[element];
    });
}

const toggleStore = (id, is_active) => {
    form.reset();
    form.id = id;
    form.is_active = !is_active;
    form.post(route('stores.store'))
}

const tableHeader = ['Name', 'Slug', 'Address', 'Phone', 'Email', 'Actions'];

</script>

<template>
    <Head title="Stores" />

    <AuthenticatedLayout :auth="auth">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Stores</h2>
        </template>

        <table class="table table-zebra">
            <thead>
                <tr >
                    <th v-for="field in tableHeader" :key="field">
                        {{ field }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="{id, name, slug, address, phone, email, is_active} in stores" :key="id">
                    <td> {{ name }}</td>
                    <td> {{ slug }}</td>
                    <td> {{ address }}</td>
                    <td> {{ phone }}</td>
                    <td> {{ email }}</td>
                    <td>
                        <div class="flex justify-around">
                            <button class="btn btn-circle btn-outline" @click="toggleStore(id, is_active)">
                                <svg  v-if="!is_active" xmlns="http://www.w3.org/2000/svg"  class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-outline" @click="router.get(route('store.emulate') + `/${id}`)">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v5m0 0v-5m0 5h.01m-9-2a9 9 0 112.05-9.95" />
                                </svg> -->
                                Login as
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>
