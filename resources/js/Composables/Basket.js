import { ref, watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';

const order = useForm({
    id: 0, products: [], total: 0,
    customer: { name: '', email: '', phone: '', address: '' },
});

const total = ref(0);

export default function useBasket() {

    watchEffect(() => {
        order.total = order.products.reduce(
                (acc,{ price, qty }) => acc + price * qty,
            0);
    })

    return { order }
}
