<script setup>
    import { router } from '@inertiajs/vue3';
    import FrontLayout from '@/Layouts/FrontLayout.vue';
    import useBasket from '@/Composables/Basket';

    defineProps({ store: Object, order: Object });


</script>

<template>

    <FrontLayout :store="store" >
        <template #nav>
            <nav class="flex flex-wrap items-center justify-center space-x-4">

            </nav>
        </template>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Order # {{ order.id }} Successful</h2>
                <div class="glass bg-warning">{{ order.status }}</div>
                <p>Your order has been successfully placed. Thank you for shopping with us.</p>
            </div>

        </div>
        <button
            class="btn btn-block btn-success mb-4"
            @click="router.post(route('order.store'), {id: order.id, status: 'completed'})">
                Completed
        </button>
        <button
            class="btn btn-block btn-error mb-4"
            @click="router.post(route('order.store'), {id: order.id, status: 'declined'})">
            Declined
        </button>
    </FrontLayout>


</template>
