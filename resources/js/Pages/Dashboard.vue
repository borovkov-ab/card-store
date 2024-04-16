<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    auth: {
        type: Object,
        required: true,
    },
    stores: {
        type: Object,
    },
    ordersCount: Number, productsCount: Number, totalByDate: Array
});

const shopsCount = computed(() => Object.keys(props.stores).filter(i => props.stores[i].is_active ).length );

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :auth="auth">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
                <!-- <div class="card w-96 bg-base-100 shadow-xl mt-4">
                    <div class="card-body">
                        <h2 class="card-title">Card title!</h2>
                        <p>If a dog chews shoes whose shoes does he choose?</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div> -->
                <div class="stats shadow mt-4">

                    <div class="stat place-items-center">
                        <div class="stat-title">Number of stores</div>
                        <div class="stat-value">{{ shopsCount }}</div>
                        <div class="stat-desc">From January 1st to February 1st</div>
                    </div>

                    <div class="stat place-items-center">
                        <div class="stat-title">Orders</div>
                        <div class="stat-value text-secondary">{{ ordersCount }}</div>
                        <div class="stat-desc text-secondary">↗︎ 40 (2%)</div>
                    </div>

                    <div class="stat place-items-center">
                        <div class="stat-title">Registred products</div>
                        <div class="stat-value">{{ productsCount }}</div>
                        <div class="stat-desc">↘︎ 90 (14%)</div>
                    </div>

                </div>

                <div class="stats stats-vertical shadow ms-6">

                    <div v-for="date in totalByDate" :key="date" class="stat">
                        <div class="stat-title">{{ date.date }}</div>
                        <div class="stat-value">{{ date.total }}</div>
                        <div class="stat-desc">{{ date.amount }} orders</div>
                    </div>

                    <!-- <div class="stat">
                        <div class="stat-title">New Users</div>
                        <div class="stat-value">4,200</div>
                        <div class="stat-desc">↗︎ 400 (22%)</div>
                    </div>

                    <div class="stat">
                        <div class="stat-title">New Registers</div>
                        <div class="stat-value">1,200</div>
                        <div class="stat-desc">↘︎ 90 (14%)</div>
                    </div> -->

                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
