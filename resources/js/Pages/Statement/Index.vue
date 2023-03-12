<script setup>
import Modal from "@/Components/Modal.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputError from '@/Components/InputError.vue'
import DangerButton from '@/Components/DangerButton.vue'
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
    statements: Array,
    tankers: Array,
    sheets: Array,
    fuels: Array,
    garages: Array,
    bases: Array,
    cities: Array,
});

const bases = props.bases;
const cities = props.cities;
const showModal = ref(false);
const showModalRemove = ref(false);
const editId = ref(0);
const form = useForm({
    fio: null,
    date_of_create: null,
    is_signed: false,
    stamp: null,
    numbers: null,
    gas: null,
    tanker_id: null,
    sheet_id: null,
    fuel_id: null,
    garage_id: null,
})

function submit() {
    if (editId.value) {
        form.patch(route("statement.update", editId.value), {
            onSuccess: () => {
                closeForm();
            }
        })
    } else {
        form.post(route("statement.create"), {
            onSuccess: () => {
                closeForm();
            }
        })
    }
}

function deleteStatement() {
    form.delete(route("statement.delete", editId.value), {
        onSuccess: () => {
            showModalRemove.value = false;
            closeForm();
        },
    });
}

function edit(statement) {
    form.fio = statement.fio;
    form.date_of_create = statement.date_of_create;
    form.stamp = statement.stamp;
    form.numbers = statement.numbers;
    form.gas = statement.gas;
    form.tanker_id = statement.tanker_id;
    form.sheet_id = statement.sheet_id;
    form.fuel_id = statement.fuel_id;
    form.garage_id = statement.garage_id;
    showModal.value = true;
    editId.value = statement.id;
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

function getBase(id) {
    let base;
    bases.forEach(element => {
        if (element.id === id) {
            base = element.name;
        }
    });
    return base;
}

function getCity(id) {
    let city;
    cities.forEach(element => {
        if (element.id === id) {
            city = element.name;
        }
    });
    return city;
}

function signed(id) {
    Inertia.post(route('statement.signed', id))
}

</script>

<template>
    <html>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </html>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex items-center justify-center">
                <h2 class="font-semibold text-xl text-gray-800 mr-5 leading-tight">Ведомости</h2>
                <div>
                    <PrimaryButton @click="(showModal = true)" v-if="statements.length > 0">Добавить ведомость
                    </PrimaryButton>
                </div>
            </div>
        </template>

        <div class="py-12" v-if="statements.length > 0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-xl sm:rounded-lg p-10 grid grid-cols-2">
                    <div v-for="statement in statements" :key="statement.id" class="mb-2 p-5">
                        <div class="max-w-md py-4 px-10 font-extrabold bg-white shadow-lg rounded-lg my-20">
                            <div>
                                <h2 class="text-gray-800 text-3xl font-semibold text-center">{{ statement.fio ||
                                        'Неизвестно'
                                }}
                                </h2>
                                <p class="mt-2 text-gray-600">Подписан: {{ statement.is_signed == 0 ? 'Нет' : 'Да' }}
                                    <span v-if="statement.is_signed == 0" @click="signed(statement.id)"
                                        class="cursor-pointer hover:bg-white">
                                        (подписать)
                                    </span>
                                </p>
                                <p class="mt-2 text-gray-600">Дата создания: {{ statement.date_of_create || 'Неизвестно'
                                }}
                                </p>
                                <p class="mt-2 text-gray-600">Марка авто: {{ statement.stamp || 'Неизвестно' }}
                                </p>
                                <p class="mt-2 text-gray-600">Номера авто: {{ statement.numbers || 'Неизвестно' }}
                                </p>
                                <p class="mt-2 text-gray-600">Тип ГМС: {{ statement.fuel.type || 'Неизвестно' }}
                                </p>
                                <p class="mt-2 text-gray-600">Количество ГМС: {{ statement.gas || 'Неизвестно' }} л.
                                </p>
                                <p class="mt-2 text-gray-600">Гараж: {{ statement.garage.name || 'Неизвестно' }}
                                </p>
                                <p class="mt-2 text-gray-600">Автобаза: {{ getBase(statement.garage.base_id) ||
                                        'Неизвестно'
                                }}
                                </p>
                                <p class="mt-2 text-gray-600">Путевой лист: {{ statement.sheet.name || 'Неизвестно' }}
                                </p>
                                <p class="mt-2 text-gray-600">Куда: {{ getCity(statement.sheet.city_id) || 'Неизвестно'
                                }}
                                </p>
                            </div>
                            <div class="flex justify-end mt-4">
                                <a href="#" class="text-xl font-medium text-indigo-500">Заправщик: {{
                                        statement.tanker.name || 'Неизвестно'
                                }}</a>
                            </div>
                            <div class="mt-5 flex items-center justify-evenly">
                                <PrimaryButton class="mr-2" @click="edit(statement)">Редактировать</PrimaryButton>
                                <DangerButton @click="showDeleteForm(statement.id)">Удалить</DangerButton>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div v-else class="flex items-center justify-center mt-10">
            <PrimaryButton @click="(showModal = true)">Добавить ведомость</PrimaryButton>
        </div>
        <Modal :show="showModal">
            <form class="w-full max-w-sm mx-auto p-10">
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Инициалы водителя
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            type="text" v-model="form.fio">
                        <InputError v-if="form.errors.fio" :message="form.errors.fio"></InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Дата создания
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            type="date" v-model="form.date_of_create">
                        <InputError v-if="form.errors.date_of_create" :message="form.errors.date_of_create">
                        </InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Марка авто
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            type="text" v-model="form.stamp">
                        <InputError v-if="form.errors.stamp" :message="form.errors.stamp">
                        </InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Номера авто
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            type="text" v-model="form.numbers">
                        <InputError v-if="form.errors.numbers" :message="form.errors.numbers">
                        </InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Количество топлива
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            type="number" v-model="form.gas">
                        <InputError v-if="form.errors.gas" :message="form.errors.gas">
                        </InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Выберите заправщика
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            type="text" v-model="form.tanker_id">
                            <option :value=tanker.id v-for="tanker in tankers">{{ tanker.name }}</option>
                        </select>
                        <InputError v-if="form.errors.tanker_id" :message="form.errors.tanker_id"></InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Выберите путевой лист
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            v-model="form.sheet_id">
                            <option v-for="sheet in sheets" :value=sheet.id>{{ sheet.name }}</option>
                        </select>
                        <InputError v-if="form.errors.sheet_id" :message="form.errors.sheet_id"></InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Выберите тип топлива
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            v-model="form.fuel_id">
                            <option :value=fuel.id v-for="fuel in fuels">{{ fuel.type }}</option>
                        </select>
                        <InputError v-if="form.errors.fuel_id" :message="form.errors.fuel_id"></InputError>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Выберите гараж
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                            type="text" v-model="form.garage_id">
                            <option :value=garage.id v-for="garage in garages">{{ garage.name }}</option>
                        </select>
                        <InputError v-if="form.errors.garage_id" :message="form.errors.garage_id"></InputError>
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
                        Удалить этот гараж?
                    </h1>
                    <div class="flex items-center justify-around mt-3 p-10">
                        <button
                            class="shadow mr-2 bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="button" @click="deleteStatement()">
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
