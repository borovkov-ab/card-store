import { ref, watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';

export function useBasket() {
    const order = useForm({ lines: []});
    const total = ref(0);

    watchEffect(() => {
        total.value = order.lines.reduce(
                (acc,{ price, qty }) => acc + price,
            0);
    })

    return { total, order }
}
