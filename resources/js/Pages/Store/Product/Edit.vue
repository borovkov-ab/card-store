<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Multiselect from '@/Components/Multiselect.vue';

import { ref, watchEffect} from 'vue';

const props = defineProps({
    product: Object,
    categories: Array,
});

const dialog = ref();
const visible = ref(false);

const emit = defineEmits(['reset-product']);
const showModal = () => {
    dialog.value.showModal();
    visible.value = true;
};

const close = () => {
    dialog.value.close();
    visible.value = false;
    // product = { name: 'Product Name'};
    props.product.reset();
    //emit('reset-product');
};

const deleteProduct = () => {
    props.product.delete(route('products.delete'), {
        onSuccess: () => close(),
        // onError: () => nameInput.value.focus(),
        onFinish: () => props.product.reset(),
    })
}

defineExpose({
    showModal,
    visible,
    close,
});

</script>

<template>
    <dialog class="modal" ref="dialog" @close="visible = false">
        <div class="modal-box">
            <caption class="caption-top">
                <h2 class="text-lg font-semibold text-green-800 leading-tight">Product</h2>
            </caption>

            <div>
                <form @submit.prevent="product.post(route('products.store'), { onSuccess: () => close()})">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" v-model="product.name" class="mt-1 block
                            w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                            border-gray-300 rounded-md">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input id="price" type="text" v-model="product.price" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" />
                        <label for="qty" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input id="qty" type="text" v-model="product.qty" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" />
                        <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                        <Multiselect id="categories" v-model:selected.onlyname="product.categories" :options="categories" />
                    </div>
                    <footer>
                        <PrimaryButton type="submit" class="ms-3" :disabled="product.processing" > Save </PrimaryButton>
                        <SecondaryButton class="ms-3" @click="close"> Cancel </SecondaryButton>
                        <DangerButton
                            class="ms-3"
                            :class="{ 'opacity-25':  product.processing }"
                            :disabled="product.processing"
                            @click="deleteProduct"
                        >
                            Delete
                        </DangerButton>
                    </footer>
                </form>

            </div>
        </div>
    </dialog>
</template>
