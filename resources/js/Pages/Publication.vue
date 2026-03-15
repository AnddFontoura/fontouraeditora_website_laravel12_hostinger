<template>
    <website-layout>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
            <!-- Header -->
            <header class="mb-8">
                <p class="text-xs font-extrabold uppercase tracking-wide text-slate-500">Publicação</p>

                <div class="mt-2 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="min-w-0">
                        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                            {{ publication?.name || "—" }}
                        </h1>

                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            <span
                                v-if="publication?.category"
                                class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold"
                                :class="categoryBadgeClass(publication.category)"
                            >
                                {{ categoryLabel(publication.category) }}
                            </span>

                            <span
                                v-if="publication?.category !== 'FREE' && publication?.value !== null && publication?.value !== undefined"
                                class="inline-flex items-center rounded-full bg-slate-900 px-2.5 py-1 text-xs font-extrabold text-white"
                            >
                                {{ formatMoney(publication.value) }}
                            </span>

                            <span
                                v-if="publication?.isbn"
                                class="inline-flex items-center rounded-full bg-slate-50 px-2.5 py-1 text-xs font-bold text-slate-700 border border-slate-200"
                            >
                                ISBN: {{ publication.isbn }}
                            </span>
                        </div>

                        <p v-if="publication?.author" class="mt-3 text-sm text-slate-700">
                            <span class="font-bold text-slate-900">Autor:</span>
                            {{ publication.author }}
                        </p>
                    </div>

                    <div class="shrink-0 flex flex-wrap gap-2">
                        <a
                            href="./publications/FREE"
                            class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm font-extrabold text-slate-700 hover:bg-slate-50 transition"
                        >
                            Ver lista
                        </a>

                        <a
                            v-if="isFreeWithLink"
                            :href="safeExternalUrl(publication.link)"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center rounded-lg bg-fontoura px-3.5 py-2 text-sm font-extrabold text-white hover:bg-fontoura/90 transition"
                        >
                            Visualizar grátis
                        </a>

                        <a
                            v-else-if="publication?.link"
                            :href="safeExternalUrl(publication.link)"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm font-extrabold text-slate-700 hover:bg-slate-50 transition"
                        >
                            Abrir link externo
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="grid gap-6 lg:grid-cols-12">
                <!-- Cover card -->
                <aside class="lg:col-span-4">
                    <div class="rounded-2xl border border-slate-200 bg-white p-5">
                        <div class="aspect-[3/4] overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                            <img
                                v-if="coverUrl(publication)"
                                :src="coverUrl(publication)"
                                :alt="`Capa: ${publication?.name || 'Publicação'}`"
                                class="h-full w-full object-cover"
                                loading="lazy"
                            />
                            <div
                                v-else
                                class="flex h-full w-full items-center justify-center bg-gradient-to-br from-fontoura/15 to-slate-100 p-4 text-center"
                            >
                                <div class="text-sm font-extrabold leading-5 text-slate-700 line-clamp-6">
                                    {{ coverFallbackText(publication?.name) }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 gap-3">
                            <div class="rounded-xl bg-slate-50 p-4 border border-slate-200">
                                <p class="text-xs font-extrabold text-slate-500">Categoria</p>
                                <p class="mt-1 text-sm font-extrabold text-slate-900">
                                    {{ categoryLabel(publication?.category) }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-slate-50 p-4 border border-slate-200">
                                <p class="text-xs font-extrabold text-slate-500">Preço</p>
                                <p class="mt-1 text-sm font-extrabold text-slate-900">
                                    <span v-if="publication?.category === 'FREE'">Grátis</span>
                                    <span
                                        v-else-if="publication?.value !== null && publication?.value !== undefined"
                                    >
                                        {{ formatMoney(publication.value) }}
                                    </span>
                                    <span v-else>—</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Details -->
                <section class="lg:col-span-8">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <h2 class="text-base font-extrabold text-slate-900">Detalhes</h2>

                        <div class="mt-4 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-xl bg-slate-50 p-4 border border-slate-200">
                                <p class="text-xs font-extrabold text-slate-500">Autor</p>
                                <p class="mt-1 text-sm font-extrabold text-slate-900">{{ publication?.author || "—" }}</p>
                            </div>

                            <div class="rounded-xl bg-slate-50 p-4 border border-slate-200">
                                <p class="text-xs font-extrabold text-slate-500">ISBN</p>
                                <p class="mt-1 text-sm font-extrabold text-slate-900">{{ publication?.isbn || "—" }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-xs font-extrabold text-slate-500">Descrição</p>
                            <div v-if="publication?.description" v-html="publication.description" class="mt-2 text-sm text-slate-700 whitespace-pre-line">

                            </div>
                            <p v-else class="mt-2 text-sm text-slate-600">
                                Nenhuma descrição informada.
                            </p>
                        </div>

                        <div class="mt-6 rounded-xl border border-slate-200 bg-white p-4">
                            <p class="text-xs font-extrabold text-slate-500">Link</p>

                            <a
                                v-if="publication?.link"
                                :href="safeExternalUrl(publication.link)"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-2 inline-flex items-center text-sm font-extrabold text-slate-900 hover:underline underline-offset-4"
                            >
                                {{ safeExternalUrl(publication.link) }}
                            </a>

                            <p v-else class="mt-2 text-sm text-slate-600">
                                Sem link cadastrado.
                            </p>

                            <p v-if="publication?.category === 'FREE' && !publication?.link" class="mt-3 text-xs text-slate-500">
                                Dica: para publicações grátis, preencha o campo <strong>link</strong> para liberar o botão
                                <strong>“Visualizar grátis”</strong>.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </website-layout>
</template>

<script lang="ts">
import WebsiteLayout from "@/Pages/Layouts/WebsiteLayout.vue";

export default {
    components: {
        WebsiteLayout,
    },
    props: {
        publication: {
            type: Object,
            required: true,
        },
        canLogin: {
            type: Boolean,
            required: false,
        },
        canRegister: {
            type: Boolean,
            required: false,
        },
    },
    computed: {
        isFreeWithLink() {
            const c = (this.publication?.category || "").toString().toUpperCase();
            return c === "FREE" && !!this.publication?.link;
        },
    },
    methods: {
        // Mantém o mesmo “modelo”/helpers do Publications.vue
        coverUrl(pub: any) {
            if (!pub) return null;
            return pub.image_url || null;
        },
        coverFallbackText(name: any) {
            if (!name) return "Sem capa";
            const clean = String(name).trim();
            if (!clean) return "Sem capa";
            if (clean.length <= 60) return clean;
            return clean.slice(0, 60) + "…";
        },
        categoryLabel(category: any) {
            const c = (category || "").toString().toUpperCase();

            if (c === "FREE") return "Grátis";
            if (c === "EPUB") return "EPUB";
            if (c === "PRESS") return "Impresso";

            return category || "Publicação";
        },
        categoryBadgeClass(category: any) {
            const c = (category || "").toString().toUpperCase();

            if (c === "FREE") return "bg-emerald-50 text-emerald-800 border border-emerald-200";
            if (c === "EPUB") return "bg-blue-50 text-blue-800 border border-blue-200";
            if (c === "PRESS") return "bg-amber-50 text-amber-800 border border-amber-200";

            return "bg-slate-50 text-slate-700 border border-slate-200";
        },
        formatMoney(value: any) {
            const n = Number(value);
            if (Number.isNaN(n)) return String(value);
            return n.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
        },
        safeExternalUrl(url: any) {
            try {
                const u = new URL(String(url));
                if (u.protocol !== "http:" && u.protocol !== "https:") return "#";
                return u.toString();
            } catch {
                return "#";
            }
        },
    },
};
</script>

<style scoped>
/* Layout todo em Tailwind, como em Publications.vue */
</style>
