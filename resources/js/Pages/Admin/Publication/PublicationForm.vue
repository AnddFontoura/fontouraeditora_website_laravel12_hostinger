<template>
    <Head :title="this.page.title" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Publicações
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <a :href="route('control-panel.publications.index')">
                        <button
                            type="button"
                            class="
                                rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs
                                hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2
                                focus-visible:outline-indigo-600
                               
                            "
                        >
                            Listar Publicações
                        </button>
                    </a>
                </div>
            </div>

            <div class="py-12">
                <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ this.page.action }} uma nova publicação
                                </h2>
                            </header>

                            <form @submit.prevent="saveOrUpdatePublication()" class="mt-6 space-y-6">
                                <div>
                                    <InputLabel for="category" value="Categoria" />

                                    <select
                                        id="category"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        v-model="form.category"
                                        required
                                    >
                                        <option value="" disabled>Selecione...</option>
                                        <option
                                            v-for="(category, key) in categories"
                                            :key="key"
                                            :value="key"
                                        >
                                            {{ category }}
                                        </option>
                                    </select>

                                    <InputError class="mt-2" :message="form.errors.category" />
                                </div>

                                <div>
                                    <InputLabel for="name" value="Nome da publicação" />

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div>
                                    <InputLabel for="isbn" value="ISBN" />

                                    <TextInput
                                        id="isbn"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.isbn"
                                        required
                                        autocomplete="off"
                                    />

                                    <InputError class="mt-2" :message="form.errors.isbn" />
                                </div>

                                <div>
                                    <InputLabel for="author" value="Autor" />

                                    <TextInput
                                        id="author"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.author"
                                        required
                                        autocomplete="off"
                                    />

                                    <InputError class="mt-2" :message="form.errors.author" />
                                </div>

                                <div>
                                    <InputLabel for="description" value="Descrição" />

                                    <textarea
                                        id="description"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        rows="5"
                                        v-model="form.description"
                                        required
                                    />

                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>

                                <div>
                                    <InputLabel for="value" value="Valor" />

                                    <TextInput
                                        id="value"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        class="mt-1 block w-full"
                                        v-model="form.value"
                                        required
                                        autocomplete="off"
                                    />

                                    <InputError class="mt-2" :message="form.errors.value" />
                                </div>

                                <div>
                                    <InputLabel for="link" value="Link" />

                                    <TextInput
                                        id="link"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.link"
                                        autocomplete="off"
                                    />

                                    <InputError class="mt-2" :message="form.errors.link" />
                                </div>

                                <div>
                                    <InputLabel for="image" value="Imagem (capa)" />

                                    <input
                                        id="image"
                                        type="file"
                                        accept="image/*"
                                        class="mt-1 block w-full"
                                        @change="onImageChange"
                                    />

                                    <InputError class="mt-2" :message="form.errors.image" />

                                    <div v-if="publication?.image_url" class="mt-3">
                                        <p class="text-sm text-gray-600">Imagem atual:</p>
                                        <img
                                            :src="publication.image_url"
                                            alt="Capa"
                                            class="mt-2 h-28 w-auto rounded border"
                                        />
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton :disabled="form.processing">
                                        {{ this.page.action }}
                                    </PrimaryButton>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Swal from "sweetalert2";

export default {
    components: {
        Link,
        PrimaryButton,
        TextInput,
        InputError,
        InputLabel,
        Head,
        AuthenticatedLayout,
    },
    props: {
        publication: Object,
        categories: Object|Array,
    },
    data() {
        return {
            alert: {
                title: "Publicação salva com sucesso!",
                message: "A publicação foi salva.",
            },
            page: {
                title: 'Publicações > Criar',
                action: 'Criar ',
            },
            form: useForm({
                id: this.publication?.id ?? null,
                category: this.publication?.category ?? '',
                name: this.publication?.name ?? '',
                isbn: this.publication?.isbn ?? '',
                author: this.publication?.author ?? '',
                description: this.publication?.description ?? '',
                value: this.publication?.value ?? 0,
                link: this.publication?.link ?? '',
                image: null,
            }),
        }
    },
    mounted() {
        console.log(this.categories)
        if (this.publication) {
            this.page.title = 'Publicações > Editar'
            this.page.action = 'Editar '
            this.alert.title = "Publicação alterada com sucesso!"
            this.alert.message = "A alteração já foi executada."
        }
    },
    methods: {
        onImageChange(e) {
            const file = e.target.files?.[0] ?? null;
            this.form.image = file;
        },

        saveOrUpdatePublication() {
            const url = this.publication
                ? route('control-panel.publications.update', this.publication.id)
                : route('control-panel.publications.save')

            const method = this.publication ? 'post' : 'post'

            this.form[method](url, {
                preserveScroll: true,
                forceFormData: true,

                onSuccess: () => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: this.alert.title,
                        text: this.alert.message,
                        showConfirmButton: false,
                        timer: 2500,
                    })
                },
            })
        }
    },
}
</script>
