<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head, useForm} from '@inertiajs/vue3';
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {nextTick, ref} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";

defineProps({
    group: null,
});

const loading = ref(false);
const text = ref(null);
const typingTimer = ref(null);

let result = {}

const handleInput = (group) => {
    loading.value = true;
    typingTimer.value = setTimeout(() => {
        callMethodAfterTypingStopped(group);
    }, 2000);
}

const pluck = (items, field) => {
    if (!items || !items.length) return [];
    return items.map(item => {
        return item[field];
    })
}

const callMethodAfterTypingStopped = (group) => {
    // Call your method here after the user stops typing for 1 second
        axios.post(route('translate'), {
            text: text.value,
            languages: pluck(group.languages, 'slug')
        }).then(res => {
            result = res.data.result;
            text.value = text.value + " ";
            text.value = text.value.slice(0, -1);

            console.log(result);
            loading.value = false;
        })
    }


const form = useForm({
    name: '',
    description: '',
    languages: [],
});

</script>

<template>
    <Head title="Profile"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ group.name }}
            </h2>
        </template>

        <div class="container mx-auto p-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Textarea with Image Upload and Voice Recorder -->
                <div class="relative">

                       <textarea
                           v-model="text"
                           @input="handleInput(group)"
                           class="w-full h-48 border border-gray-300 rounded-md p-3 pr-10 focus:outline-none focus:ring focus:border-blue-500 resize-none mb-4"
                           placeholder="Text Here"
                       ></textarea>

                    <label for="image" class="absolute right-0 top-0 mt-3 mr-3 cursor-pointer">
                        <svg class="w-6 h-6 text-gray-400 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <input id="image" type="file" class="hidden">
                    </label>

                    <!-- Voice Recorder -->
                    <label for="microphone" class="absolute right-12 top-0 mt-3 mr-3 cursor-pointer">
                        <svg class="w-6 h-6 text-gray-400 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13.55v-3.1a7 7 0 0114 0v3.1m-4 0h2m-6 0H7m10-3.1a3 3 0 00-6 0v3.1m-4 0h2m8-3.1a3 3 0 016 0v3.1m-4 0h2"></path></svg>
                        <input id="microphone" type="file" class="hidden">
                    </label>
                </div>

                <!-- Language Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    <div v-for="language in group.languages" class="whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none">
                        <div class="mb-2 flex items-center gap-3">
                            <a :href="''" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors hover:text-pink-500">
                                <div class="flex items-center gap-1">
                                    <h1 class="block font-sans font-normal antialiased" style="font-size: 22px; font-weight: bold">{{ language.name_native }}</h1>
                                </div>
                            </a>
                        </div>
                        <p class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased mb-4" v-if="! loading">
                            {{ result[language.slug] }}
                        </p>
                        <img src="/loading.gif" v-if="loading" />
                    </div>
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
