<template>
    <div class="min-h-dvh bg-white text-slate-800">
        <!-- Top bar -->
        <div class="bg-fontoura text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-10 items-center justify-between text-sm">
                    <div class="hidden sm:flex items-center gap-4">
                        <a href="./" class="hover:underline underline-offset-4">Sobre a Editora</a>
                        <a href="./contact" class="hover:underline underline-offset-4">Fale Conosco</a>
                    </div>

                    <div class="flex items-center gap-3">
                        <a
                            v-if="!$page.props.auth.user"
                            :href="route('login')"
                            class="rounded-md bg-white/10 px-3 py-1.5 hover:bg-white/15 transition"
                        >
                            Entrar
                        </a>
                        <a
                            v-if="!$page.props.auth.user"
                            :href="route('register')"
                            class="rounded-md bg-white px-3 py-1.5 text-fontoura hover:bg-slate-100 transition"
                        >
                            Criar conta
                        </a>

                        <div v-if="$page.props.auth.user" class="flex items-center gap-3">
                            <span class="hidden sm:inline">Olá, <b>{{ $page.props.auth.user.name }}</b></span>
                            <a
                                :href="route('dashboard')"
                                class="rounded-md bg-white/10 px-3 py-1.5 hover:bg-white/15 transition"
                            >
                                Painel
                            </a>
                            <a
                                :href="route('logout')"
                                class="rounded-md bg-white/10 px-3 py-1.5 hover:bg-white/15 transition"
                            >
                                Sair
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="border-b border-slate-200">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between gap-4">
                    <a href="./" class="flex items-center gap-3">
                        <img
                            class="h-9 w-auto"
                            src="public/img/logo_fontoura.png"
                            alt="Fontoura Editora"
                        >
                        <span class="sr-only">Fontoura Editora</span>
                    </a>

                    <!-- Desktop nav -->
                    <nav class="hidden lg:flex items-center gap-2">
                        <a
                            href="http://fontouraeditora.com.br/periodico"
                            target="_blank"
                            class="rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                        >
                            Periódicos
                        </a>
                        <a
                            href="./publications/free"
                            class="rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                        >
                            Livros Grátis
                        </a>
                        <a
                            href="./publications/epub"
                            class="rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                        >
                            EPUBs
                        </a>
                        <a
                            href="./publications/press"
                            class="rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                        >
                            Livros Físicos
                        </a>
                    </nav>

                    <!-- Mobile menu button -->
                    <button
                        type="button"
                        class="lg:hidden inline-flex items-center justify-center rounded-md p-2 text-slate-700 hover:bg-slate-100"
                        @click="mobileOpen = !mobileOpen"
                        aria-label="Abrir menu"
                    >
                        <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>

                <!-- Mobile nav -->
                <div v-if="mobileOpen" class="lg:hidden pb-4">
                    <div class="grid gap-2">
                        <a href="./publications/periodicals" class="rounded-md px-3 py-2 text-sm font-semibold hover:bg-slate-100">
                            Periódicos
                        </a>
                        <a href="./publications/free" class="rounded-md px-3 py-2 text-sm font-semibold hover:bg-slate-100">
                            Livros Grátis
                        </a>
                        <a href="./publications/epub" class="rounded-md px-3 py-2 text-sm font-semibold hover:bg-slate-100">
                            EPUBs
                        </a>
                        <a href="./publications/printed" class="rounded-md px-3 py-2 text-sm font-semibold hover:bg-slate-100">
                            Livros Físicos
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="mt-16 border-t border-slate-200 bg-slate-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
                <div class="grid gap-8 md:grid-cols-4">
                    <div>
                        <div class="flex items-center gap-3">
                            <img class="h-8 w-auto" src="/public/img/logo_fontoura.png" alt="Fontoura Editora">
                        </div>
                        <p class="mt-3 text-sm text-slate-600">
                            Editora especializada em publicações acadêmicas e científicas.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Navegação</h3>
                        <ul class="mt-3 space-y-2 text-sm">
                            <li><a class="text-slate-600 hover:text-slate-900" href="./">Sobre a Editora</a></li>
                            <li><a class="text-slate-600 hover:text-slate-900" href="./contact">Fale Conosco</a></li>
                            <li><a class="text-slate-600 hover:text-slate-900" href="./publications/free">Livros Grátis</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Atalhos</h3>
                        <ul class="mt-3 space-y-2 text-sm">
                            <li><a class="text-slate-600 hover:text-slate-900" href="./">Homepage</a></li>
                            <li><a class="text-slate-600 hover:text-slate-900" href="http://fontouraeditora.com.br/periodico" target="_blank">Periódico</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Redes Sociais & Contato</h3>
                        <ul class="mt-3 space-y-2 text-sm">
                            <li>
                                <a
                                    class="text-slate-600 hover:text-slate-900"
                                    href="https://www.instagram.com/fontouraeditora/"
                                    target="_blank"
                                >
                                    Instagram
                                </a>
                            </li>

                            <li>
                                <a
                                    class="text-slate-600 hover:text-slate-900"
                                    href="https://www.facebook.com/fontoura.editora"
                                    target="_blank"
                                >
                                    Facebook
                                </a>
                            </li>

                            <li>
                                <a
                                    class="text-slate-600 hover:text-slate-900"
                                    href="http://wa.me/5511998878777"
                                    target="_blank"
                                >
                                    Whatsapp
                                </a>
                            </li>

                            <li>
                                <a
                                    class="text-slate-600 hover:text-slate-900"
                                    href="mailto:paula@editorafontoura.com.br"
                                    target="_blank"
                                >
                                    Email
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-10 text-xs text-slate-500">
                    © {{ new Date().getFullYear() }} Fontoura Editora. Todos os direitos reservados.
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import { Bars3Icon } from '@heroicons/vue/24/outline'

export default {
    components: { Bars3Icon },
    data() {
        return {
            mobileOpen: false,
        }
    },
}
</script>
