<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";

defineProps({
    history: [],
});

const pluck = (items, field) => {
    if (!items || !items.length) return [];
    return items.map(item => {
        return item[field];
    })
}

const recordLangs = (record) => {
    return pluck(record.group.languages, 'name_ru')
}

</script>

<template>
    <Head title="Здравствуйте!"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Здравствуйте!
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <h2 class="text-lg font-medium text-gray-900">последние переводы:</h2>

                <table class="min-w-full divide-y divide-gray-200" v-if="history.length">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Группа
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Текст
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Языки
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Время
                        </th>
                    </tr>

                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Table rows -->
                    <tr v-for="record in history">
                        <td class="px-6 py-4 whitespace-nowrap">
                           <a :href="route('groups.show', record.group.uid)" class="inline-block bg-green-500 text-white text-sm font-semibold px-2 py-1 rounded-full">
                                {{ record.group.name  }}
                           </a>
                        </td>
                        <td class="px-6 py-4 whitespace-wrap break-all">
                            {{ record.text }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                             <span class="inline-block bg-blue-500 text-white text-sm font-semibold px-2 py-1 rounded-full m-1" v-for="lang in recordLangs(record)">
                                    {{ lang }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ record.created_at }}
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md" role="alert" v-if="! history.length">
                    <p class="font-bold">Информация!</p>
                    <p> Вы еще ничего не перевели.</p>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
