<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import Modal from '@/Components/Modal.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import { useForm } from '@inertiajs/vue3';

    import { ref, watchEffect } from 'vue';

    const props = defineProps({ categories: Array, save_category: String, auth: Object, stores: Object});



    const isEditModalOpen = ref(false);

    const form = useForm({
        id: 0,
        name: '',
    });

    const closeEditModal = () => {
        isEditModalOpen.value = false;
        form.reset();
    }

    const deleteCategory = () => {
        form.delete(route('category.delete'), {
            onSuccess: () => closeEditModal(),
            // onError: () => nameInput.value.focus(),
            onFinish: () => form.reset(),
        })
    }

    const updateForm = (category) => {
        form.reset();
        Object.keys(category).forEach(element => {
            form[element] = category[element];
        });
    }

    const submit = () => {
        form.post('category.index')
    }

    watchEffect(() => {
        console.log(props.save_category);
    });

</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout :auth="auth">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Categories</h2>
        </template>

        <main class="card w-150 bg-base-100 shadow-xl m-10">
            <div class="card-body">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th v-if="auth?.is_admin" class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Store
                            </th>

                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="category in categories" :key="category.id">
                            <td class="px-6 py-4 whitespace-no-wrap">
                                {{ category.name }}
                            </td>
                            <td v-if="auth?.is_admin" class="px-6 py-4 whitespace-no-wrap">
                                {{ category.store_id in stores ? stores[category.store_id].name : '' }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                <button @click="updateForm(category); isEditModalOpen=true">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <PrimaryButton class="ml-4 mt-4" @click="isEditModalOpen=true">New</PrimaryButton>

    </AuthenticatedLayout>

    <Modal :show="isEditModalOpen" @close="closeEditModal">
        <div class="p-6">
            <h2> {{ form.id ? 'Edit' : 'Create' }} Category</h2>
            <form @submit.prevent="form.post(route('category.store')); closeEditModal();">

                <div class="mt-6">
                    <InputLabel for="name" value="Name" class="sr-only" />

                    <TextInput
                        id="name"
                        v-model="form.name"
                        class="mt-1 block w-3/4"
                        placeholder="Category Name"
                    />
                    <InputError :message="form.errors.name" class="mt-2" />

                </div>


                <footer class="mt-6 flex justify-end">
                    <PrimaryButton class="me-3" type="submit" :disabled="form.processing">Save</PrimaryButton>
                    <SecondaryButton @click="closeEditModal"> Cancel </SecondaryButton>
                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25':  form.processing }"
                        :disabled="form.processing"
                        @click="deleteCategory"
                    >
                        Delete Category
                    </DangerButton>
                </footer>
            </form>
        </div>

    </Modal>

</template>
