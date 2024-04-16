<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, useForm } from '@inertiajs/vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import Modal from '@/Components/Modal.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';

    import { ref } from 'vue';

    const props = defineProps({ users: Array, auth: Object });

    const isEditModalOpen = ref(false);

    const form = useForm ({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const closeEditModal = () => {
        isEditModalOpen.value = false;
        form.reset();
    }

    const deleteUser = () => {
        form.delete(route('user.delete'), {
            onSuccess: () => closeEditModal(),
            onFinish: () => form.reset()
        })
    }


</script>

<template>
    <Head title="Admins" />

    <AuthenticatedLayout :auth="auth">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admins</h2>
        </template>

        <div class="card w-96 bg-base-100 shadow-xl m-10">
            <div class="card-body">
                <h2 class="card-title">Admin list</h2>
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th> Name </th> <th> Email </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="{ name, email } in users" :key="email">
                            <td> {{ name }}</td>
                            <td> {{ email }}</td>

                        </tr>
                    </tbody>
                </table>
                <div class="card-actions justify-end">
                    <button class="btn btn-primary" @click="isEditModalOpen=true">New</button>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>

    <Modal :show="isEditModalOpen" @close="closeEditModal">
        <div class="p-6">
            <h2> Create admin </h2>

            <form @submit.prevent="form.post(route('user.store'), { onSuccess: () => closeEditModal() })">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <footer class="mt-6 flex justify-end">
                    <PrimaryButton class="me-3" type="submit" :disabled="form.processing">Save</PrimaryButton>
                    <SecondaryButton @click="closeEditModal"> Cancel </SecondaryButton>
                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25':  form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete
                    </DangerButton>
                </footer>

            </form>
        </div>
    </Modal>

</template>
