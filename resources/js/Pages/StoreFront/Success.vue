<script setup>
    import FrontLayout from '@/Layouts/FrontLayout.vue';
    import useBasket from '@/Composables/Basket';

    defineProps({ store: Object, order: Object });


</script>

<template>

    <FrontLayout :store="store" >
        <template #nav>
            <nav class="flex flex-wrap items-center justify-center space-x-4">
                <router-link :to="`/${store.slug}`" class="btn btn-ghost">
                    Home
                </router-link>
            </nav>
        </template>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Order Successful</h2>
                <p>Your order has been successfully placed. Thank you for shopping with us.</p>
            </div>
        </div>
    </FrontLayout>


</template>
