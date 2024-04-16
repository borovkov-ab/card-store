<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Edit from '@/Pages/Store/Product/Edit.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, reactive, watchEffect } from 'vue';

defineProps({ products: Array, categories: Array, auth: Object, stores: Object});

const isProductModalOpen = ref(false);

const editDialog = ref();
const productEditing = reactive({});
productEditing.item = { name: 'Name' };

const form = useForm({
    id: 0,
    name: '',
    price: 0,
    categories: [],
});

const updateForm = (product) => {
    form.reset();
    Object.keys(product).forEach(element => {
        form[element] = element==='price' ? product[element]/100 : product[element];
    });
}

watchEffect(

    () => console.log(productEditing)
)

</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout :auth="auth">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>


        <!-- <table class="min-w-full divide-y divide-gray-200"> -->
        <main class="card w-150 bg-base-100 shadow-xl m-10">
            <div class="card-body">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Categories
                            </th>
                            <th v-if="auth?.is_admin" class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Stores
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            <!-- <th class="px-6 py-3 bg-gray-50"></th> -->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="product in products" :key="product.id">
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ product.name }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ (product.price/100).toFixed(2) }}
                            </td>
                            <td class="px-6 py-4">
                                <div v-for="category in product.categories" :key="category.id" class="badge badge-info me-1">
                                    {{ category.name }}
                                </div>
                            </td>
                            <td v-if="auth?.is_admin" class="px-6 py-4">

                                    {{ product.store_id in stores ? stores[product.store_id].name : '' }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                <button @click=" () => { updateForm(product); editDialog.showModal() }" class="text-indigo-600 hover:text-indigo-900">Edit</button>

                            </td>
                            <!-- <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                <a :href="route('products.edit', product.id)" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div> -->
        <PrimaryButton class="ml-4" @click="editDialog.showModal()">Create Product</PrimaryButton>

    </AuthenticatedLayout>
    <Edit ref="editDialog" v-model:product="form" @reset-product="form.reset()" :categories="categories"
        />
    <!-- <Edit :show="isProductModalOpen" :product="{name: 'Product Name'}" @close="isProductModalOpen = false" /> -->
</template>
