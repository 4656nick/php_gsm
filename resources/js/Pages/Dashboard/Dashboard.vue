<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    statements: Array,
    fuels: Array,
});

function first() {
    Inertia.get(route('firstQuery'));
}

function third() {
    Inertia.get(route('thirdQuery'));
}

function getSum(arr) {
    let newArr = [];
    arr.forEach(element => {
        newArr.push(+element.gas);
    });
    console.log(newArr);
    let sum = newArr.reduce((num, sum) => num + sum, 0)
    console.log(sum);
    return sum;
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
                <div class="flex items-center justify-around mt-3">
                    <h1 class="cursor-pointer" @click="first">1 запрос</h1>
                    <h1 class="cursor-pointer">2 (не готов)</h1>
                    <h1 class="cursor-pointer" @click="third">3 запрос</h1>
                </div>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                    <div v-if="fuels.length > 0">
                        <div class="grid grid-cols-2 font-extrabold text-lg">
                            <h1>Тип топлива</h1>
                            <h1>Количество топлива</h1>
                        </div>
                        <div v-for="fuel in fuels" class="mb-5 mt-3 grid grid-cols-2">
                            <h1>{{ fuel.type }}</h1>
                            <h1>{{ getSum(fuel.statements) }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
