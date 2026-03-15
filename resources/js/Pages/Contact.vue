<script setup>
  import WebsiteLayout from "@/Pages/Layouts/WebsiteLayout.vue";
</script>

<template>
  <website-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-10 pb-8">
      <header class="mb-8">
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
          Contato
        </h1>
        <p class="mt-2 text-sm text-slate-600">
          Principais canais para falar com a Fontoura Editora.
        </p>
      </header>

      <div class="grid gap-4 sm:grid-cols-2">
        <!-- WhatsApp -->
        <a
            href="https://wa.me/5511998878777"
            target="_blank"
            rel="noopener noreferrer"
            class="group block rounded-2xl border border-emerald-200 bg-emerald-50 p-5 hover:bg-emerald-100/60 transition"
        >
          <div class="flex items-start gap-4">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white">
              <!-- WhatsApp icon (SVG) -->
              <svg viewBox="0 0 32 32" class="h-5 w-5 fill-current" aria-hidden="true">
                <path d="M19.11 17.19c-.27-.14-1.6-.79-1.85-.88-.25-.09-.43-.14-.61.14-.18.27-.7.88-.86 1.06-.16.18-.32.2-.59.07-.27-.14-1.14-.42-2.17-1.34-.8-.71-1.34-1.59-1.49-1.86-.16-.27-.02-.42.12-.55.12-.12.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.14-.61-1.47-.84-2.02-.22-.53-.45-.46-.61-.46h-.52c-.18 0-.48.07-.73.34-.25.27-.95.93-.95 2.27s.98 2.64 1.11 2.82c.14.18 1.93 2.95 4.68 4.13.65.28 1.16.45 1.55.57.65.21 1.25.18 1.72.11.52-.08 1.6-.66 1.83-1.29.23-.64.23-1.18.16-1.29-.07-.11-.25-.18-.52-.32z"/>
                <path d="M16 3C8.83 3 3 8.83 3 16c0 2.29.6 4.53 1.74 6.51L3 29l6.72-1.76A12.93 12.93 0 0 0 16 29c7.17 0 13-5.83 13-13S23.17 3 16 3zm0 23.5c-2.08 0-4.12-.55-5.9-1.59l-.42-.25-3.99 1.04 1.06-3.88-.27-.45A10.44 10.44 0 0 1 5.5 16C5.5 10.76 10.76 5.5 16 5.5S26.5 10.76 26.5 16 21.24 26.5 16 26.5z"/>
              </svg>
            </div>

            <div class="min-w-0">
              <h2 class="text-base font-extrabold text-emerald-900">
                WhatsApp
              </h2>
              <p class="mt-1 text-sm text-emerald-900/80">
                +55 11 99887-8777
              </p>
              <p class="mt-3 inline-flex text-sm font-bold text-emerald-800 group-hover:underline underline-offset-4">
                Abrir conversa →
              </p>
            </div>
          </div>
        </a>

        <!-- E-mail -->
        <a
            href="mailto:atendimento@editorafontoura.com.br"
            class="group block rounded-2xl border border-blue-200 bg-blue-50 p-5 hover:bg-blue-100/60 transition"
        >
          <div class="flex items-start gap-4">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-fontoura text-white">
              <!-- Mail icon (SVG) -->
              <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current" aria-hidden="true">
                <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/>
              </svg>
            </div>

            <div class="min-w-0">
              <h2 class="text-base font-extrabold text-blue-950">
                E-mail
              </h2>
              <p class="mt-1 break-words text-sm text-blue-950/80">
                atendimento@editorafontoura.com.br
              </p>
              <p class="mt-3 inline-flex text-sm font-bold text-blue-900 group-hover:underline underline-offset-4">
                Enviar e-mail →
              </p>
            </div>
          </div>
        </a>
      </div>

      <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-5">
        <h3 class="text-sm font-extrabold text-slate-900">Observação</h3>
        <p class="mt-1 text-sm text-slate-600">
          Horários de atendimento de 09h até 16h.
        </p>
      </div>
    </div>
  </website-layout>
</template>

<style scoped>
</style>