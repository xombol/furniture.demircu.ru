<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

const confirmingUserDeletion = ref(false);
let selectedFurniture = ref(null);

defineProps({
    furnitures: {
        type: Array,
    },
    warehouses: {
        type: Array,
    }
});

const form = useForm({
    warehouse: null,
});


// const changeWarehouse = (warehouseWord) => {
//     console.log(warehouseWord)
//     form.warehouse = warehouseWord;
// }

const submitForm = (warehouse) => {
    form.post(route('furnitures.update', warehouse.id), {
        preserveScroll: true,
        onSuccess: () => {
        },
        onError: () => {
            if (form.errors.warehouse) {
                alert('131231')
            }

        },
    });
}

const onepModalChangeWarehouse = (furniture) => {
    confirmingUserDeletion.value = true;
    selectedFurniture = furniture;
    form.warehouse = furniture.warehouses[0].location
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
}


</script>

<template>
    <Head title="Profile"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Furniture list</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <p>List furniture main</p>

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-12 lg:-mx-12">
                            <div class="inline-block min-w-full py-2 sm:px-12 lg:px-12">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-center text-sm font-light" style="width: 100%">
                                        <thead
                                            class="border-b bg-neutral-50 font-medium dark:border-neutral-500 dark:text-neutral-800">
                                        <tr>
                                            <th scope="col" class=" px-6 py-4">#</th>
                                            <th scope="col" class=" px-6 py-4">Name</th>
                                            <th scope="col" class=" px-6 py-4">Colors</th>
                                            <th scope="col" class=" px-6 py-4">Warehouse</th>
                                            <th scope="col" class=" px-6 py-4">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(furniture, index) in furnitures" :key="furniture.id" class="border-b dark:border-neutral-500">
                                            <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ furniture.id }}</td>
                                            <td class="whitespace-nowrap  px-6 py-4">{{ furniture.name }}</td>
                                            <td class="whitespace-nowrap  px-6 py-4">
                                                <ul>
                                                    <li v-for="(color, index_color) in furniture.colors" :key="color.id">{{ color.name }}</li>
                                                </ul>
                                            </td>
                                            <td class="whitespace-nowrap  px-6 py-4">
                                                <p class="change-warehouse" v-for="(warehouse, index_warehouse) in furniture.warehouses" :key="warehouse.id"
                                                   @click="onepModalChangeWarehouse(furniture)">{{ warehouse.location }}

                                                    <svg style="max-width: 20px; margin-left: 1rem;     width: 100%;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         strokeWidth={1.5} stroke="currentColor"
                                                         className="w-6 h-6">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                    </svg>
                                                </p>
                                            </td>
                                            <td class="whitespace-nowrap  px-6 py-4">
                                                <div class="d-flex">

                                                    <svg style="max-width: 20px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor"
                                                         className="w-6 h-6">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                    </svg>
                                                </div>


                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>


        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6" v-if="selectedFurniture">
                <h2 class="text-lg font-medium text-gray-900">
                    Edit <b> "{{ selectedFurniture.name }}" </b> warehouse <b>[{{ selectedFurniture.warehouses[0].location }} - selected]</b>
                </h2>


                <div class="mt-6">
                    <InputLabel for="warehouse" value="Warehouses"/>

                    <select class="mt-2 block w-full" name="warehouse" v-model="form.warehouse">
                        <option v-for="(warehouse, index) in warehouses" :key="index"> {{ warehouse }}</option>
                    </select>

                    <InputError :message="form.errors.warehouse" class="mt-2"/>
                </div>


                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Updated success!</p>
                </Transition>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel</SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="submitForm(selectedFurniture)"
                    >
                        Update
                    </PrimaryButton>
                </div>
            </div>
        </Modal>


    </AuthenticatedLayout>
</template>


