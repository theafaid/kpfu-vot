<style>
.welcome-card{
    border: 1.3px solid rgb(0, 0, 0);
    border-radius: 12px;
    box-shadow: rgb(0, 0, 0) 4px 4px;
    position: relative;
    outline: none !important;
    width: 100%;
}

.welcome-card-1 {
    background: url(data:image/png;base64,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);
}

.welcome-card-2 {
    background: url(data:image/png;base64,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);
}

.welcome-card-3 {
    background: url(data:image/png;base64,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);
}
</style>
<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Добро пожаловать" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50" style="background: url('/imgs/welcome-bg.jpg'); background-size: cover">
<!--        <img-->
<!--            id="background"-->
<!--            class="absolute -left-20 top-0 max-w-[877px]"-->
<!--            src="/imgs/welcome-bg.jpg"-->
<!--        />-->
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <img src="/imgs/logo-f.png" style="max-height: 200px"/>
                    </div>
                        <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="
                            bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded
                            rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            <i class="fa fa-home"></i>
                            Дом
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="
                                bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded
                                rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Вход
                                <i class="fa fa-sign-in"></i>

                            </Link>

                            &nbsp;
                            &nbsp;
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="
                                bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded
                                rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Регистрация
                                <i class="fa fa-plus"></i>

                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        <div
                            id="docs-card"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                        >
                            <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                <img
                                    src="/imgs/sample.png"
                                    alt="Laravel documentation screenshot"
                                    class="aspect-video h-full w-full flex-1 rounded-[10px] object-top drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)] dark:hidden"
                                    @error="handleImageError"
                                />

                                <img
                                    src="https://laravel.com/assets/img/welcome/docs-dark.svg"
                                    alt="Laravel documentation screenshot"
                                    class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block"
                                />
                                <div
                                    class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"
                                ></div>
                            </div>

                            <div class="relative flex items-center gap-6 lg:items-end">
                                <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                    <div
                                        class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#0080ff]/10 sm:size-16"
                                    >

                                        <i class="fa fa-language text-blue-500"></i>
                                    </div>

                                    <div class="pt-3 sm:pt-5 lg:pt-0">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">Описание</h2>

                                        <p class="mt-4 text-sm text-black">
                                            Простой веб-сайт для перевода текста на русский язык для иностранных студентов. Учителя могут создавать группы студентов, указывая их языки, и получать мгновенный перевод одним нажатием. Быстро, удобно и без лишних усилий.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="welcome-card welcome-card-1 flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                        >
                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16"
                            >
                                <i class="fa fa-copy text-gray-600"></i>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Внутренний перевод</h2>

                                <p class="mt-4 text-sm text-black">
                                   Веб-сайт позволяет переводить текст без необходимости использовать сторонние сервисы, такие как Google Translate или Yandex Translate. Все инструменты доступны на нашем веб-сайте.
                                </p>
                            </div>
                        </div>

                        <div
                            class="welcome-card welcome-card-2 flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                        >
                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#e1ffe6]/10 sm:size-16"
                            >
                                <div
                                    class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16"
                                >
                                    <i class="fa fa-users text-gray-600"></i>
                                </div>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Управление группами</h2>

                                <p class="mt-4 text-sm text-black">
                                    преподаватель может легко управлять группами студентов и их языками, что обеспечивает быструю настройку перевода и удобное взаимодействие между учителем и студентами.
                                </p>
                            </div>
                        </div>
                        <div
                            class="welcome-card welcome-card-3 flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                        >
                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16"
                            >
                                <i class="fas fa-share-square"></i>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Простота использования</h2>

                                <p class="mt-4 text-sm text-black">
                                    Интерфейс веб-сайта прост в использовании для учителя и студентов, что сокращает временные затраты на перевод и делает процесс обучения более эффективным и интересным.
                                </p>
                            </div>
                        </div>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Сделано: Фаид Абдельрахман
                    <br>
                    создан кфу {{new Date().getFullYear()}} под руководством преподавателя: Динары Илгизаровны Фахретдиновой.
                </footer>
            </div>
        </div>
    </div>
</template>
