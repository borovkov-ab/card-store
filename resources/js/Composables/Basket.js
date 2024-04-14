import { ref, watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';

const order = useForm({
    id: 0, lines: [],
    customer: { name: '', email: '', phone: '', address: '' },
});

const total = ref(0);

export default function useBasket() {

    watchEffect(() => {
        total.value = order.lines.reduce(
                (acc,{ price, qty }) => acc + price * qty,
            0);
    })

    return { total, order }
}
