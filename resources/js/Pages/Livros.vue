<template>
  <Head title="Livros" />
  <AuthenticatedLayout>
    <section class="flex flex-col gap-4">
      <!-- Formulário de Cadastro -->
      <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <header>
            <h2 class="text-2xl font-medium text-gray-900 mb-4">
              Cadastrar Livro
            </h2>
          </header>
          <form @submit.prevent="submitForm" class="mt-6 space-y-6 max-w-xl">
            <div>
              <InputLabel for="nome_livro" value="Nome" />
              <TextInput
                id="nome_livro"
                type="text"
                class="mt-1 block w-full"
                v-model="nome_livro"
                required
              />
            </div>
            <div class="flex items-center gap-4">
              <PrimaryButton :disabled="submitForm.processing"
                >Salvar</PrimaryButton
              >
            </div>
          </form>
        </div>
      </div>

      <!-- Lista de Livros Cadastrados -->
      <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <header>
            <h2 class="text-2xl font-medium text-gray-900 mb-4">
              Livros Cadastrados
            </h2>
          </header>
          <table class="min-w-full">
            <thead>
              <tr class="border-b-2 border-t-2">
                <th class="py-2 text-left">Nome</th>
                <th class="py-2 text-left">Cadastrado</th>
                <th class="py-2 text-left">Alterado</th>
                <th class="py-2 text-left">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="livro in livros" :key="livro.id">
                <td class="py-2">{{ livro.nome_livro }}</td>
                <td class="py-2">{{ livro.dt_inclusao }}</td>
                <td class="py-2">{{ livro.dt_alteracao }}</td>
                <td class="py-2">
                  <button
                    @click="abrirModalEditar(livro)"
                    class="px-4 py-1 bg-blue-500 text-white rounded-md mr-2"
                  >
                    Editar
                  </button>
                  <button
                    @click="deletarLivro(livro.livro_id)"
                    class="px-4 py-1 bg-red-500 text-white rounded-md"
                  >
                    Deletar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal de Edição -->
      <TransitionRoot :show="isOpen">
        <Dialog @close="setIsOpen">
          <DialogPanel
            class="fixed inset-0 flex items-center justify-center z-50"
          >
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0"
              enter-to="opacity-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100"
              leave-to="opacity-0"
            >
              <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="z-10 w-[500px] mx-5 transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              >
                <div class="flex flex-col" v-if="livroEditando">
                  <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Editar Livro
                  </h2>
                  <form @submit.prevent="editarLivro">
                    <div>
                      <InputLabel for="nome" value="Nome" />
                      <TextInput
                        id="nome_livro"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="novoLivro"
                        required
                      />
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                      <PrimaryButton :disabled="submitForm.processing">
                        Salvar
                      </PrimaryButton>
                      <SecondaryButton @click="setIsOpen(false)">
                        Fechar
                      </SecondaryButton>
                    </div>
                  </form>
                </div>
              </DialogPanel>
            </TransitionChild>
          </DialogPanel>
        </Dialog>
      </TransitionRoot>
    </section>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Head } from "@inertiajs/vue3";
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from "@headlessui/vue";

import { ref } from "vue";
import axios from "axios";

const nome_livro = ref("");
const isOpen = ref(false);
const livroEditando = ref(null);
const novoLivro = ref("");

const abrirModalEditar = (livro) => {
  livroEditando.value = livro;
  novoLivro.value = livro.nome;
  setIsOpen(true);
};

function setIsOpen(value) {
  isOpen.value = value;
  if (!value) {
    livroEditando.value = null;
    novoLivro.value = "";
  }
}

const submitForm = () => {
  axios
    .post("/api/livros", { nome_livro: nome_livro.value })
    .then((response) => {
      alert(response.data.message);
      nome_livro.value = "";
      location.reload();
    })
    .catch((error) => {
      if (error.response && error.response.data && error.response.data.error) {
        alert(error.response.data.error);
      } else {
        console.error(error);
      }
    });
};

const editarLivro = () => {
  axios
    .put(`/api/livros/${livroEditando.value.livro_id}`, {
      nome_livro: novoLivro.value,
    })
    .then((response) => {
      console.log(response.data);
      setIsOpen(false);
      location.reload();
    })
    .catch((error) => {
      console.error(error);
    });
};

const deletarLivro = (livro_id) => {
  axios
    .delete(`/api/livros/${livro_id}`)
    .then((response) => {
      console.log(response.data);
      location.reload();
    })
    .catch((error) => {
      console.error(error);
    });
};
</script>

<script>
export default {
  props: ["livros"],
};
</script>
