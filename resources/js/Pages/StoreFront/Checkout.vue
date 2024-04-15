<script setup>
    import { Head, Link, router } from '@inertiajs/vue3';
    import FrontLayout from '@/Layouts/FrontLayout.vue'
    import useBasket from '@/Composables/Basket';

    defineProps({ store: Object });

    const  { order } = useBasket();

</script>

<template>

    <FrontLayout :store="store" >
        <template #nav>
            <nav class="flex flex-wrap items-center justify-center space-x-4">
                <Link preserve-state :only="['products']"
                    v-for="{ slug, name } in store.categories"
                    :href="`/${store.slug}/${slug}`" class="btn btn-ghost"
                    :class="{ 'btn-active': $page.url.startsWith(`/${store.slug}/${slug}`) }"
                    >
                    {{ name }}
                </Link>
            </nav>
        </template>

        <form @submit.prevent="order.post(route('order.store'))" method="post">
            <template v-for="i in Object.keys(order.customer)" :key="i">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">{{  i.charAt(0).toUpperCase() + i.slice(1) }}</span>
                    </label>
                </div>
                <div class="form-control">
                    <input type="text" :name="i" v-model="order.customer[i]" class="input input-bordered" :placeholder="i.charAt(0).toUpperCase() + i.slice(1)">
                </div>
            </template>
            <button type="submit" class="btn btn-primary" :disabled="order.processing">Checkout</button>
        </form>
        <!-- <template #basket="{ orderDetailModal }">
            <span class="font-bold text-lg"> {{ order.products.length }} Items</span>
            <span class="text-info">Subtotal: ${{ total }}</span>
            <div class="card-actions">
                <button  class="btn btn-primary btn-block" @click=" orderDetailModal.showModal() "> View cart</button>
            </div>
        </template> -->

    </FrontLayout>
</template>
