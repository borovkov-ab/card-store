<script setup>
import { ref } from 'vue';

const props = defineProps({
    options: Array,
    label: String,
    placeholder: String,
});


const selected = ref();
const [ selectedList, modifiers ] = defineModel('selected', {
    set(value) {
        if (!modifiers.onlyname) return value;
        return value?.map(i => props.options.find(o => o.name === i)) ?? [];
    },
    get(value) {
        if (!modifiers.onlyname) return value ?? [];
        return value?.map(i => i.name) ?? [];
    }
});

const selectOption = () => {
    if (selected.value && !selectedList.value?.includes(selected.value)) {
        selectedList.value = [...selectedList.value, selected.value];
    }
    selected.value = '';
};

// const open = ref(false);


</script>

<template>
    <div class="relative">

        <div>
            <button v-if="!!selectedList" v-for="name in selectedList"
                class="badge badge-info me-1 hover:badge-warning"
                @click="selectedList=selectedList.filter( i => i !== name)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-4 h-4 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    {{ name }}
            </button>
            <input list='options' v-model="selected"
                class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                @change="selectOption"
            />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <!-- <div v-show="open" class="fixed inset-0 z-40" @click="open = false"></div> -->

        <Transition
            enter-active-class="transition ease-out duration-700"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >

                <div class="py-1" >
                    <datalist id="options" >
                        <option v-for="{name, id} in options.filter(i => !selectedList || !selectedList.includes(i.name) )"
                            :key="id"
                            :value="name">
                        </option>
                    </datalist>
                </div>
        </Transition>
    </div>
</template>
