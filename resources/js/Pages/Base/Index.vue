<script setup>
import Modal from "@/Components/Modal.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputError from '@/Components/InputError.vue'
import DangerButton from '@/Components/DangerButton.vue'
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
defineProps({
    bases: Array,
});
const showModal = ref(false);
const showModalRemove = ref(false);
const editId = ref(0);
const form = useForm({
    name: null,
    code: null,
})

function submit() {
    if (editId.value) {
        form.patch(route("base.update", editId.value), {
            onSuccess: () => {
                closeForm();
            }
        })
    } else {
        form.post(route("base.create"), {
            onSuccess: () => {
                closeForm();
            }
        })
    }
}

function deleteBase() {
    form.delete(route("base.delete", editId.value), {
        onSuccess: () => {
            showModalRemove.value = false;
            closeForm();
        },
    });
}

function edit(base) {
    form.name = base.name;
    form.code = base.code;
    showModal.value = true;
    editId.value = base.id;
}

function closeForm() {
    form.reset();
    editId.value = 0;
    showModal.value = false;
    form.clearErrors();
}

function showDeleteForm(id) {
    showModalRemove.value = true;
    editId.value = id;
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex items-center justify-center">
                <h2 class="font-semibold text-xl text-gray-800 mr-5 leading-tight">Автобазы</h2>
                <div>
                    <PrimaryButton @click="(showModal = true)" v-if="bases.length > 0">Добавить автобазу</PrimaryButton>
                </div>
            </div>
        </template>

        <div class="py-12" v-if="bases.length > 0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                    <div v-for="base in bases" :key="base.id"
                        class="mb-5 border-4 p-10 flex items-center justify-between border-black">
                        <div class="text-2xl">
                            <h1 class="font-bold">Название автобазы - {{ base.name }}</h1>
                            <h1 class="font-bold">Код автобазы - {{ base.code }}</h1>
                        </div>
                        <div>
                            <PrimaryButton class="mr-2" @click="edit(base)">Редактировать</PrimaryButton>
                            <DangerButton @click="showDeleteForm(base.id)">Удалить</DangerButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="flex items-center justify-center mt-10">
            <PrimaryButton @click="(showModal = true)">Добавить автобазу</PrimaryButton>
        </div>
        <Modal :show="showModal">
            <form class="w-full max-w-sm mx-auto p-10">
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Имя автобазы
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            type="text" v-model="form.name">
                        <InputError v-if="form.errors.name" :message="form.errors.name"></InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                            for="inline-password">
                            Код автобазы
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            id="inline-password" type="text" v-model="form.code">
                        <InputError v-if="form.errors.code" :message="form.errors.code"></InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3 flex items-center justify-center">
                        <button
                            class="shadow mr-2 bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="button" @click="submit()">
                            Сохранить
                        </button>
                        <button
                            class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="button" @click="closeForm()">
                            Отменить
                        </button>
                    </div>
                </div>
            </form>
        </Modal>
        <Modal :show="showModalRemove">
            <div class="mx-auto p-20">
                <div class="bg-gray-700 rounded-xl text-white p-10">
                    <h1 class="text-3xl text-center">
                        Удалить эту базу?
                    </h1>
                    <div class="flex items-center justify-around mt-3 p-10">
                        <button
                            class="shadow mr-2 bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="button" @click="deleteBase()">
                            Да
                        </button>
                        <button
                            class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="button" @click="showModalRemove = false">
                            Нет
                        </button>
                    </div>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>

<style>

</style>
