<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import FrontLayout from '@/Layouts/FrontLayout.vue'
    import { useBasket } from '@/Composables/Basket';

    defineProps({ categories: Array, products: Array, store: Object });

    const  { total, order } = useBasket();

</script>

<template>
    <Head :title="store.name" />

    <FrontLayout :store="store" :order="order">
        <template #menu>
            <nav class="flex flex-wrap items-center justify-center space-x-4">
                <Link preserve-state :only="['products']"
                    v-for="{ slug, name } in categories"
                    :href="`/${store.slug}/${slug}`" class="btn btn-ghost"
                    :class="{ 'btn-active': $page.url.startsWith(`/${store.slug}/${slug}`) }"
                    >
                    {{ name }}
                </Link>
            </nav>
        </template>
        <template #basket>
            <span class="font-bold text-lg"> {{ order.lines.length }} Items</span>
            <span class="text-info">Subtotal: ${{ total }}</span>
            <div class="card-actions">
                <button class="btn btn-primary btn-block">View cart</button>
            </div>
        </template>
        <table class="table xl">
            <thead >
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Add</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td><button @click="order.lines.push(product)" >add</button></td>
                </tr>
            </tbody>
        </table>
    </FrontLayout>


</template>
