<style>
textarea {
    background-image: url(/imgs/paper.jpg);
    background-color: #FFF;
    color: #222;
    font-weight: normal;
    font-size: 24px;
    resize: none;
    line-height: 40px;
    padding: 20px;
    width: 100%;
    background-repeat: repeat;
    overflow: scroll;
    min-height: 200px;
    outline: none;
    border-radius: 5px;
    border: 1px solid #ccc; /* Default border style */
    transition: border-color 0.3s ease, transform 0.3s ease; /* Transition effect for border color and transform */
}

textarea:focus {
    outline: none !important;
    border-color: #007bff; /* Border color when focused */
    transform: scale(1.01); /* Scale transformation when focused */
}
</style>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {nextTick, ref} from "vue";

defineProps({
    group: null,
});

const loading = ref(false);
const text = ref(null);
const typingTimer = ref(null);

let result = {}

const handleInput = (group) => {
    if (text.value.trim() == '') {
        return;
    }

    loading.value = true;

    if (typingTimer.value) {
        clearTimeout(typingTimer.value);
    }
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
            group_id: group.id,
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
    <Head :title="group.name"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Группа:
                <span class="inline-block bg-blue-500 text-white text-sm font-semibold px-2 py-1 rounded-full">
                  {{ group.name }}
                </span>

                <br>
                <div class="mt-2 shadow-sm">
                    <span v-for="language in group.languages" class="m-1">
                    <img class="rounded-lg" :src="language.icon_path" style="object-fit: contain; display: inline; width: 25px">
                    </span>
                </div>
            </h2>
        </template>

        <div class="container mx-auto p-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="relative">
                    <textarea
                        v-model="text"
                        @input="handleInput(group)"
                        class=""
                        placeholder="введите свой текст здесь..."
                    ></textarea>


<!--                    <label for="image" class="absolute right-0 top-0 mt-3 mr-3 cursor-pointer">-->
<!--                        <svg class="w-6 h-6 text-gray-400 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>-->
<!--                        <input id="image" type="file" class="hidden">-->
<!--                    </label>-->

<!--                    &lt;!&ndash; Voice Recorder &ndash;&gt;-->
<!--                    <label for="microphone" class="absolute right-12 top-0 mt-3 mr-3 cursor-pointer">-->
<!--                        <svg class="w-6 h-6 text-gray-400 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13.55v-3.1a7 7 0 0114 0v3.1m-4 0h2m-6 0H7m10-3.1a3 3 0 00-6 0v3.1m-4 0h2m8-3.1a3 3 0 016 0v3.1m-4 0h2"></path></svg>-->
<!--                        <input id="microphone" type="file" class="hidden">-->
<!--                    </label>-->
                </div>

                <!-- Language Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    <div style="background-image: url('/imgs/paper.jpg'); text-align: center" v-for="language in group.languages" class="whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500  shadow-blue-gray-500/1 focus:outline-none">
                        <div class=" flex items-center gap-3">
                            <a style="margin: auto" href="#" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors hover:text-pink-500">
                                <div class="flex items-center gap-1">
                                    <h1 class="block font-sans font-normal antialiased" style="font-size: 22px; font-weight: bold">
                                        <img :src="language.icon_path" style="object-fit: contain; display: inline; max-height: 50px">
                                        {{ language.name_native }}
                                    </h1>
                                </div>
                            </a>
                        </div>
                        <p class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased mb-4" v-if="! loading && result[language.slug]" style="background: #fff; font-size: 25px; padding: 10px">
                            {{ result[language.slug] }}
                        </p>

                        <span class="flex justify-center items-center" v-if="loading">
                            <span class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></span>
                        </span>

                    </div>
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
