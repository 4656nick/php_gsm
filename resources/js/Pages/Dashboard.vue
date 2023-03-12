<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    statements: Array,
});

function first() {
    Inertia.get(route('firstQuery'));
}

function third() {
    Inertia.get(route('thirdQuery'));
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
                <div class="flex items-center justify-around mt-3">
                    <h1 class="cursor-pointer" @click="first">1 запрос (не до конца)</h1>
                    <h1 class="cursor-pointer">2 (не готов)</h1>
                    <h1 class="cursor-pointer" @click="third">3 запрос</h1>
                </div>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="statements" class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                    <div>
                        <div class="grid grid-cols-3 font-extrabold text-lg">
                            <h1>Количество топлива</h1>
                            <h1>Тип топлива</h1>
                            <h1>Гараж</h1>
                        </div>
                        <div v-for="statement in statements" class="grid grid-cols-3">
                            <h1>{{ statement.gas }}</h1>
                            <h1>{{ statement.fuel.type }}</h1>
                            <h1>{{ statement.garage.name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
