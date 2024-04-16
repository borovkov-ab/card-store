<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';

    const props = defineProps({ orders: Array, auth: Object});


</script>

<template>
    <Head title="Orders" />

    <AuthenticatedLayout :auth="auth">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orders</h2>
        </template>

        <main class="card w-150 bg-base-100 shadow-xl m-10">
            <div class="card-body">
                <!-- <h2 class="card-title">Orders</h2> -->
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th> Date </th> <th> Total </th> <th> Status </th> <th> Customer Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="{ created_at, status, total, customer, id  } in orders" :key="id">
                            <td> {{ created_at.slice(0,16) }}</td>
                            <td> {{ total }}</td>
                            <td> {{ status }}</td>
                            <td> {{ customer.name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </AuthenticatedLayout>
</template>
