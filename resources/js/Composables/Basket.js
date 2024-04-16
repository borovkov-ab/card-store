import { ref, watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';

const order = useForm(`Order`,{
    id: 0, products: [], total: 0, store_id: null,
    customer: { name: '', email: '', phone: '', address: '' },
});

const total = ref(0);

export default function useBasket(store_id = null) {

    watchEffect(() => order.store_id = store_id)


    watchEffect(() => {
        order.total = order.products.reduce(
                (acc,{ price, qty }) => acc + price * qty,
            0);
    })

    return { order }
}
