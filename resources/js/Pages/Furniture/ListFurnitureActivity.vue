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
    activities: {
        type: Array,
    },
});


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
                                            <th scope="col" class=" px-6 py-4">Old</th>
                                            <th scope="col" class=" px-6 py-4">New</th>
                                            <th scope="col" class=" px-6 py-4">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(activity, index) in activities" :key="activity.id" class="border-b dark:border-neutral-500">
                                            <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ activity.id }}</td>
                                            <td class="whitespace-nowrap  px-6 py-4">{{ activity.furniture.name }}</td>
                                            <td class="whitespace-nowrap  px-6 py-4">
                                                {{ activity.old_field }}
                                            </td>
                                            <td class="whitespace-nowrap  px-6 py-4">
                                                {{ activity.new_field }}
                                            </td>
                                            <td class="whitespace-nowrap  px-6 py-4">
                                                {{ activity.status }}
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


