<template>
  <website-layout>
    <section class="bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-10 pb-8">
        <div class="grid gap-8 lg:grid-cols-12 lg:items-center">
          <div class="lg:col-span-7">
            <p class="text-sm font-semibold tracking-wide text-fontoura">
              Editora Fontoura
            </p>
            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
              Publicações acadêmicas, periódicos e livros para sua pesquisa
            </h1>
            <p class="mt-4 text-base text-slate-600">
              Acesse periódicos, livros gratuitos, EPUBs e títulos físicos em um só lugar.
            </p>

            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
              <a
                  href="./publications/free"
                  class="inline-flex items-center justify-center rounded-lg bg-fontoura px-5 py-3 text-sm font-bold text-white hover:bg-fontoura/90 transition"
              >
                Ver Livros Grátis
              </a>
              <a
                  href="http://fontouraeditora.com.br/periodico"
                  class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-5 py-3 text-sm font-bold text-slate-800 hover:bg-slate-50 transition"
                  target="_blank"
              >
                Acessar Periódicos
              </a>
            </div>
          </div>

          <div class="lg:col-span-5">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
              <img src="public/img/logo_fontoura.png" alt="Logo Fontoura"/>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-slate-50">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
        <h2 class="text-xl font-extrabold text-slate-900">Explore</h2>
        <p class="mt-2 text-sm text-slate-600">Atalhos para as principais seções do site.</p>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <a href="http://fontouraeditora.com.br/periodico" target="_blank" class="group rounded-xl border border-slate-200 bg-white p-5 hover:shadow-md transition">
            <div class="text-sm font-bold text-slate-900 group-hover:text-fontoura">Periódicos</div>
            <div class="mt-1 text-sm text-slate-600">Acesse volumes e edições.</div>
          </a>
          <a href="./publications/free" class="group rounded-xl border border-slate-200 bg-white p-5 hover:shadow-md transition">
            <div class="text-sm font-bold text-slate-900 group-hover:text-fontoura">Livros Grátis</div>
            <div class="mt-1 text-sm text-slate-600">Baixe títulos disponíveis.</div>
          </a>
          <a href="./publications/epub" class="group rounded-xl border border-slate-200 bg-white p-5 hover:shadow-md transition">
            <div class="text-sm font-bold text-slate-900 group-hover:text-fontoura">EPUBs</div>
            <div class="mt-1 text-sm text-slate-600">Leitura digital.</div>
          </a>
          <a href="./publications/press" class="group rounded-xl border border-slate-200 bg-white p-5 hover:shadow-md transition">
            <div class="text-sm font-bold text-slate-900 group-hover:text-fontoura">Livros Físicos</div>
            <div class="mt-1 text-sm text-slate-600">Catálogo impresso.</div>
          </a>
        </div>
      </div>
    </section>

    <section class="bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid gap-8 lg:grid-cols-12">
          <div class="lg:col-span-7">
            <p class="mt-3 text-sm leading-6 text-slate-600">
              Idealizada pelos professores de Educação Física: Ricardo Fontoura e Paula Fontoura,
              teve sua fundação em dezembro de 1997.
            </p>

            <p class="mt-3 text-sm leading-6 text-slate-600">
              A Fontoura Editora atua no mercado editorial brasileiro, acreditando no potencial do
              profissional de Educação Física, que a cada dia vem melhorando seu grau de conhecimento e
              aumentando seu interesse no estudo e na pesquisa, colaborando para o aniquilamento do
              empirismo na Educação Física.
            </p>

            <p class="mt-3 text-sm leading-6 text-slate-600">
              Publicamos na área da Motricidade Humana, Esporte e Saúde, nossas publicações visam
              atender às necessidades dos profissionais de Educação Física, em suas várias feições e
              demais áreas da saúde - aliando a prática à teoria - indicando elementos para a formação
              de um corpo teórico-prático; oferecendo assim, possibilidades aos leitores, a encontrar
              soluções adequadas para a prática efetiva da atividade profissional.
            </p>
          </div>

          <div class="lg:col-span-5">
            <div class="rounded-2xl border border-slate-200 p-6">
              <div class="text-sm font-bold text-slate-900">Precisa de ajuda?</div>
              <p class="mt-2 text-sm text-slate-600">
                Fale conosco para dúvidas sobre publicações e acesso.
              </p>
              <a
                  href="/site/contact"
                  class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-fontoura px-5 py-3 text-sm font-bold text-white hover:bg-fontoura/90 transition"
              >
                Fale Conosco
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </website-layout>
</template>

<script>
import WebsiteLayout from "@/Pages/Layouts/WebsiteLayout.vue";

export default {
  components: { WebsiteLayout },
  props: {
    homePage: {
      type: Object,
    },
  },
}
</script>
