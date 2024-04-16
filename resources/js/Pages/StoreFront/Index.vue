<!-- <script>
        import FrontLayout from '@/Layouts/FrontLayout.vue'

    export default {
        layout: (h, page) => h(FrontLayout, [page]),
    }

</script> -->

<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import FrontLayout from '@/Layouts/FrontLayout.vue'

    import useBasket from '@/Composables/Basket';

    const props = defineProps({ categories: Array, products: Array, store: Object });

    const  { order } = useBasket(props.store?.id);

    const addToBasket = (product) => {
        const line = order.products.find(i => i.id === product.id);
        line && line.qty++ || order.products.push({...product, qty: 1 });
    }



</script>

<template >
    <Head :title="store.name"  />

    <FrontLayout :store="store ?? null" >
        <template #nav>
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
        <template #basket="{ orderDetailModal }">
            <span class="font-bold text-lg"> {{ order.products.length }} Items</span>
            <span class="text-info">Subtotal: ${{ order.total/100 }}</span>
            <div class="card-actions">
                <button  class="btn btn-primary btn-block" @click=" orderDetailModal.showModal() "> View cart</button>
            </div>
        </template>``
        <table class="table xl">
            <thead >
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Add</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="p in products" :key="p.id">
                    <td>{{ p.name }}</td>
                    <td>{{ p.price/100 }}</td>
                    <td>
                        <button @click="addToBasket(p)">
                            add
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>
        <template #cart>
            <table class="table sm">
                <thead >
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in order.products" :key="product.id">
                        <td>{{ product.name }}</td>
                        <td>{{ product.price/100 }}</td>
                        <td>{{ product.qty }}</td>
                        <td>
                            <button @click="order.products = order.products.filter(i => i.id !== product.id)">remove</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </template>
    </FrontLayout>


</template>
