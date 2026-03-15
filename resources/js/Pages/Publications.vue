<template>
    <website-layout>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
            <header class="mb-8">
                <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                    Publicações
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Explore as publicações disponíveis no sistema.
                </p>
            </header>

            <!-- Empty state -->
            <div
                v-if="!publicationItems.length"
                class="rounded-2xl border border-slate-200 bg-white p-8 text-center"
            >
                <h2 class="text-base font-extrabold text-slate-900">Nenhuma publicação encontrada</h2>
                <p class="mt-2 text-sm text-slate-600">
                    Tente outra categoria ou ajuste a busca.
                </p>
            </div>

            <!-- Grid -->
            <div v-else class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <article
                    v-for="pub in publicationItems"
                    :key="pub.id"
                    class="group rounded-2xl border border-slate-200 bg-white p-5 hover:shadow-md transition"
                >
                    <div class="flex gap-4">
                        <!-- Cover -->
                        <a
                            :href="`/publication/${pub.id}`"
                            class="block w-24 shrink-0"
                            aria-label="Ver detalhes da publicação"
                        >
                            <div class="aspect-[3/4] overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                                <img
                                    v-if="coverUrl(pub)"
                                    :src="coverUrl(pub)"
                                    :alt="`Capa: ${pub.name}`"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                />
                                <div
                                    v-else
                                    class="flex h-full w-full items-center justify-center bg-gradient-to-br from-fontoura/15 to-slate-100 p-2 text-center"
                                >
                                    <div class="text-[11px] font-extrabold leading-4 text-slate-700 line-clamp-4">
                                        {{ coverFallbackText(pub.name) }}
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Content -->
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <span
                                    class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold"
                                    :class="categoryBadgeClass(pub.category)"
                                >
                                    {{ categoryLabel(pub.category) }}
                                </span>

                                <span
                                    v-if="pub.category !== 'FREE' && pub.value !== null && pub.value !== undefined"
                                    class="text-sm font-extrabold text-slate-900"
                                >
                                    {{ formatMoney(pub.value) }}
                                </span>
                            </div>

                            <h2 class="mt-2 line-clamp-2 text-base font-extrabold text-slate-900 group-hover:text-fontoura transition">
                                {{ pub.name }}
                            </h2>

                            <p v-if="pub.author" class="mt-2 text-sm text-slate-700 line-clamp-2">
                                <span class="font-bold text-slate-900">Autor:</span>
                                {{ pub.author }}
                            </p>

                            <p v-if="pub.isbn" class="mt-1 text-xs text-slate-500">
                                ISBN: {{ pub.isbn }}
                            </p>

                            <div class="mt-3 flex flex-wrap items-center gap-3">
                                <a
                                    :href="`./publication/${pub.id}`"
                                    class="inline-flex items-center rounded-lg bg-fontoura px-3.5 py-2 text-sm font-bold text-white hover:bg-fontoura/90 transition"
                                >
                                    Ver detalhes
                                </a>

                                <a
                                    v-if="pub.link"
                                    :href="pub.link"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-sm font-bold text-slate-700 hover:text-slate-900 hover:underline underline-offset-4"
                                >
                                    Link externo
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Pagination -->
            <nav
                v-if="publications && publications.links && publications.links.length"
                class="mt-10 flex flex-wrap items-center justify-center gap-2"
                aria-label="Paginação"
            >
                <a
                    v-for="(link, idx) in publications.links"
                    :key="idx"
                    :href="link.url || '#'"
                    class="rounded-lg border px-3 py-2 text-sm font-semibold transition"
                    :class="[
                        link.active
                            ? 'border-fontoura bg-fontoura text-white'
                            : 'border-slate-200 bg-white text-slate-700 hover:bg-slate-50',
                        !link.url ? 'pointer-events-none opacity-50' : ''
                    ]"
                    v-html="link.label"
                />
            </nav>
        </div>
    </website-layout>
</template>

<script>
import WebsiteLayout from "@/Pages/Layouts/WebsiteLayout.vue";

export default {
    components: {
        WebsiteLayout,
    },
    props: {
        publications: {
            type: Object,
        },
    },
    computed: {
        publicationItems() {
            if (!this.publications) return [];
            if (Array.isArray(this.publications.data)) return this.publications.data;
            if (Array.isArray(this.publications)) return this.publications;
            return [];
        },
    },
    methods: {
        // Tenta descobrir o campo de capa sem quebrar caso ainda não exista no backend
        coverUrl(pub) {
            if (!pub) return null;

            // nomes comuns (você pode padronizar um depois)
            return (
                pub.image_url ||
                null
            );
        },
        coverFallbackText(name) {
            if (!name) return 'Sem capa';
            const clean = String(name).trim();
            if (!clean) return 'Sem capa';

            // pequeno “resumo” do título pra ficar com cara de capa
            if (clean.length <= 40) return clean;
            return clean.slice(0, 40) + '…';
        },
        categoryLabel(category) {
            const c = (category || '').toString().toUpperCase();

            if (c === 'FREE') return 'Grátis';
            if (c === 'EPUB') return 'EPUB';
            if (c === 'PRESS') return 'Impresso';

            return category || 'Publicação';
        },
        categoryBadgeClass(category) {
            const c = (category || '').toString().toUpperCase();

            if (c === 'FREE') return 'bg-emerald-50 text-emerald-800 border border-emerald-200';
            if (c === 'EPUB') return 'bg-blue-50 text-blue-800 border border-blue-200';
            if (c === 'PRESS') return 'bg-amber-50 text-amber-800 border border-amber-200';

            return 'bg-slate-50 text-slate-700 border border-slate-200';
        },
        formatMoney(value) {
            const n = Number(value);
            if (isNaN(n)) return String(value);
            return n.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        },
    },
};
</script>
