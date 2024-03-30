<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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
    groups: [],
    languages: [],
    success: null,
});

let selectedGroup = ref(null);
const creatingNewGroup = ref(false);
const deletingGroup = ref(false);
const updatingGroup = ref(false);

const newGroupForm = useForm({
    name: '',
    description: '',
    languages: [],
});

const updateGroupForm = useForm({
    name: '',
    description: '',
    languages: [],
});

const deleteGroupForm = useForm({});


const toggleCreatingLang = (lang) => {
    const idx = newGroupForm.languages.indexOf(lang.id);
    if (idx !== -1) {
        newGroupForm.languages.splice(idx, 1);
    } else {
        newGroupForm.languages.push(lang.id);
    }
};

const toggleUpdatingLang = (lang) => {
    const idx = updateGroupForm.languages.indexOf(lang.id);
    if (idx !== -1) {
        updateGroupForm.languages.splice(idx, 1);
    } else {
        updateGroupForm.languages.push(lang.id);
    }
};

const pluck = (items, field) => {
    if (!items || !items.length) return [];
    return items.map(item => {
        return item[field];
    })
}

const adding = () => {
    creatingNewGroup.value = true;
};

const deleting = (group) => {
    selectedGroup = group;
    deletingGroup.value = true;
}

const updating = (group) => {
    selectedGroup = group;
    updateGroupForm.name = selectedGroup.name;
    updateGroupForm.description = selectedGroup.description;
    updateGroupForm.languages = pluck(selectedGroup.languages, 'id');
    updatingGroup.value = true;
}

const closeCreateGroupModal = () => {
    creatingNewGroup.value = false;

    newGroupForm.reset();
};

const closeDeleteGroupModal = () => {
    deletingGroup.value = false;

    deleteGroupForm.reset();
};

const closeUpdateGroupModal = () => {
    updatingGroup.value = false;

    updateGroupForm.reset();
};

const addGroup = () => {
    if (! newGroupForm.name) return false;

    newGroupForm.post(route('groups.store'), {
        preserveScroll: true,
        onSuccess: () => {
            closeCreateGroupModal();
            window.$toast.success('Группа успешно создана!');
        },
        onError: () => console.log("errrrrrrrrrrror"),
        onFinish: () => newGroupForm.reset(),
    });
};

const deleteGroup = () => {
    if (! selectedGroup) return false;

    deleteGroupForm.delete(route('groups.destroy', selectedGroup.id), {
        preserveScroll: true,
        onSuccess: () => {
            closeDeleteGroupModal();
            window.$toast.success('Группа успешно удалена.!');
        },
        onError: () => console.log("errrrrrrrrrrror"),
        onFinish: () => newGroupForm.reset(),
    });
};

const updateGroup = () => {
    if (! selectedGroup || ! updateGroupForm.name) return false;

    updateGroupForm.put(route('groups.update', selectedGroup.id), {
        preserveScroll: true,
        onSuccess: () => {
            closeUpdateGroupModal();
            window.$toast.success('Группа успешно обновлена!');
        },
        onError: () => console.log("errrrrrrrrrrror"),
        onFinish: () => updateGroupForm.reset(),
    });
};

</script>

<template>
    <Head title="Группы"/>

    <AuthenticatedLayout>
        <template #header>
            {{ success }}

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Группы</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!--                new group modal -->
                <Modal :show="creatingNewGroup" @close="closeCreateGroupModal">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Добавить новую группу
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
<!--                            Once your account is deleted, all of its resources and data will be permanently deleted.-->
<!--                            Please-->
<!--                            enter your password to confirm you would like to permanently delete your account.-->
                        </p>

                        <div class="mt-6">
                            <InputLabel for="name" value="Название группы" class=""/>

                            <TextInput
                                id="name"
                                ref="nameInput"
                                v-model="newGroupForm.name"
                                type="text"
                                class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                placeholder="Название группы"
                            />

                            <InputError :message="newGroupForm.errors.name" class="mt-2"/>
                        </div>


                        <div class="mt-6">
                            <InputLabel for="name" value="Описание группы" class=""/>

                            <TextInput
                                id="name"
                                ref="nameInput"
                                v-model="newGroupForm.description"
                                type="text"
                                class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                placeholder="Описание группы"
                            />

                            <InputError :message="newGroupForm.errors.description" class="mt-2"/>
                        </div>

                        <div class="mt-6">
                            <InputLabel for="name" value="Языки" class=""/>

                            <div class="bg-white dark:bg-gray-900">
                                <div class="container px-6 py-8 mx-auto">
                                    <div class="grid grid-cols-3 gap-4">
                                        <span v-for="lang in languages">
                                            <label>
                                                <input type="checkbox"
                                                       @click="toggleCreatingLang(lang)"
                                                       class="peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all checked:border-blue-500 checked:bg-blue-500 checked:before:bg-blue-500 hover:before:opacity-10">
                                            {{ lang.name_ru }}
                                            </label>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <InputError :message="newGroupForm.errors.description" class="mt-2"/>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <SecondaryButton @click="closeCreateGroupModal"> Отмена</SecondaryButton>

                            <PrimaryButton
                                class="ms-3"
                                :class="{ 'opacity-25': newGroupForm.processing }"
                                :disabled="newGroupForm.processing"
                                @click="addGroup"
                            >
                                Добавить
                            </PrimaryButton>
                        </div>
                    </div>
                </Modal>

                <!--                update group modal -->
                <Modal :show="updatingGroup" @close="closeUpdateGroupModal">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Обновить группу
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            <!--                            Once your account is deleted, all of its resources and data will be permanently deleted.-->
                            <!--                            Please-->
                            <!--                            enter your password to confirm you would like to permanently delete your account.-->
                        </p>

                        <div class="mt-6">
                            <InputLabel for="name" value="Название группы" class=""/>

                            <TextInput
                                id="name"
                                ref="nameInput"
                                v-model="updateGroupForm.name"
                                type="text"
                                class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                placeholder="Название группы"
                            />

                            <InputError :message="updateGroupForm.errors.name" class="mt-2"/>
                        </div>


                        <div class="mt-6">
                            <InputLabel for="name" value="Описание группы" class=""/>

                            <TextInput
                                id="name"
                                ref="nameInput"
                                v-model="updateGroupForm.description"
                                type="text"
                                class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                placeholder="Описание группы"
                            />

                            <InputError :message="updateGroupForm.errors.description" class="mt-2"/>
                        </div>

                        <div class="mt-6">
                            <InputLabel for="name" value="Языки" class=""/>

                            <div class="bg-white dark:bg-gray-900">
                                <div class="container px-6 py-8 mx-auto">
                                    <div class="grid grid-cols-3 gap-4">
                                        <span v-for="lang in languages">
                                            <label>
                                                <input type="checkbox"
                                                       :checked="updateGroupForm.languages.includes(lang.id)"
                                                       @click="toggleUpdatingLang(lang)"
                                                       class="peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all checked:border-blue-500 checked:bg-blue-500 checked:before:bg-blue-500 hover:before:opacity-10">
                                            {{ lang.name_ru }}
                                            </label>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <InputError :message="updateGroupForm.errors.description" class="mt-2"/>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <SecondaryButton @click="closeUpdateGroupModal"> Отмена</SecondaryButton>

                            <PrimaryButton
                                class="ms-3"
                                :class="{ 'opacity-25': updateGroupForm.processing }"
                                :disabled="updateGroupForm.processing"
                                @click="updateGroup"
                            >
                                Обновить
                            </PrimaryButton>
                        </div>
                    </div>
                </Modal>

<!--                delete group modal -->
                <Modal :show="deletingGroup" @close="closeDeleteGroupModal">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Вы уверены, что хотите удалить группу?
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
<!--                            Once your account is deleted, all of its resources and data will be permanently deleted. Please-->
<!--                            enter your password to confirm you would like to permanently delete your account.-->
                        </p>

                        <div class="mt-6 flex justify-end">
                            <SecondaryButton @click="closeDeleteGroupModal"> Отмена </SecondaryButton>

                            <DangerButton
                                class="ms-3"
                                :class="{ 'opacity-25': deleteGroupForm.processing }"
                                :disabled="deleteGroupForm.processing"
                                @click="deleteGroup"
                            >
                                Удалить группу
                            </DangerButton>
                        </div>
                    </div>
                </Modal>


                <div class="container mx-auto p-6">

                    <PrimaryButton @click="adding" class="mb-5">
                        Добавить новую группу
                        <i class="fa fa-plus"></i>
                    </PrimaryButton>


                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div
                            v-for="group in groups"
                            class="whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none"
                        >
                            <div class="relative">
                                <div class="">
                                    <div class="mb-2 flex items-center gap-3">
                                        <link
                                            :href="route('groups.show', group.uid)"
                                            class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors hover:text-blue-500">
                                            <div class="flex items-center gap-1">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    aria-hidden="true"
                                                    class="-mt-0.5 h-4 w-4 text-yellow-400"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <h2 class="block font-sans font-normal antialiased">
                                                    {{ group.name }}
                                                </h2>
                                            </div>
                                        </link>
                                    </div>
                                    <div class="absolute top-0 right-0 flex gap-2 mt-2 mr-2">
                                        <a :href="route('groups.show', group.uid)" class="text-green-500 hover:text-green-600">
                                            <i class="fa fa-sign-in"></i>
                                        </a>
                                        <button class="text-blue-500 hover:text-blue-600" @click="updating(group)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-600" @click="deleting(group)">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                                <p class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased mb-4">
                                {{ group.description }}
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div v-if="group.languages.length" class="flex items-center gap-1" v-for="language in group.languages">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        aria-hidden="true"
                                        class="-mt-px h-4 w-4 text-green-300"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                    <p class="block font-sans text-xs font-normal text-gray-700 antialiased">
                                        {{  language.name_ru }}
                                    </p>
                                </div>
                                <div class="" v-else>
                                    <!-- Success Alert -->
                                    <div class="max-w-lg mx-auto">
                                        Нет языков!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md" role="alert" v-if="! groups.length">
                        <p class="font-bold">Внимание!</p>
                        <p> вы пока не создали ни одной группы.</p>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
