<template>
  <Head title="Usuários" />
  <AuthenticatedLayout>
    <section class="flex flex-col gap-4">
      <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <header>
            <h2 class="text-2xl font-medium text-gray-900 mb-4">
              Cadastrar Usuário
            </h2>
          </header>
          <form @submit.prevent="submitForm" class="mt-6 space-y-6 max-w-xl">
            <div>
              <InputLabel for="nome" value="Nome" />
              <TextInput
                id="nome"
                type="text"
                class="mt-1 block w-full"
                v-model="nome"
                required
              />
            </div>
            <div>
              <InputLabel for="cpf" value="CPF" />
              <TextInput
                id="cpf"
                type="text"
                class="mt-1 block w-full"
                v-model="cpf"
                maxlength="11"
                pattern="\d{11}"
                title="O CPF deve conter exatamente 11 dígitos numéricos."
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

      <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <header>
            <h2 class="text-2xl font-medium text-gray-900 mb-4">
              Usuários Cadastrados
            </h2>
          </header>
          <table class="min-w-full">
            <thead>
              <tr class="border-b-2 border-t-2">
                <th class="py-2 text-left">Nome</th>
                <th class="py-2 text-left">CPF</th>
                <th class="py-2 text-left">Cadastrado</th>
                <th class="py-2 text-left">Alterado</th>
                <th class="py-2 text-left">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="usuario in usuarios" :key="usuario.id">
                <td class="py-2">{{ usuario.nome }}</td>
                <td class="py-2">{{ usuario.cpf }}</td>
                <td class="py-2">{{ usuario.dt_inclusao }}</td>
                <td class="py-2">{{ usuario.dt_alteracao }}</td>
                <td class="py-2">
                  <button
                    @click="abrirModalEditar(usuario)"
                    class="px-4 py-1 bg-blue-500 text-white rounded-md mr-2"
                  >
                    Editar
                  </button>
                  <button
                    @click="deletarUsuario(usuario.usuario_id)"
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
                <div class="flex flex-col" v-if="usuarioEditando">
                  <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Editar Usuário
                  </h2>
                  <form @submit.prevent="editarUsuario">
                    <div>
                      <InputLabel for="nome" value="Nome" />
                      <TextInput
                        id="nome"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="novoNome"
                        required
                      />
                    </div>
                    <div>
                      <InputLabel for="cpf" value="CPF" />
                      <TextInput
                        id="cpf"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="novoCPF"
                        maxlength="11"
                        pattern="\d{11}"
                        title="O CPF deve conter exatamente 11 dígitos numéricos."
                        required
                      />
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                      <PrimaryButton :disabled="submitForm.processing"
                        >Salvar</PrimaryButton
                      >
                      <SecondaryButton @click="setIsOpen(false)"
                        >Fechar</SecondaryButton
                      >
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

const nome = ref("");
const cpf = ref("");
const isOpen = ref(false);
const usuarioEditando = ref(null);
const novoNome = ref("");
const novoCPF = ref("");

const abrirModalEditar = (usuario) => {
  usuarioEditando.value = usuario;
  setIsOpen(true);
};

function setIsOpen(value) {
  isOpen.value = value;
  if (!value) {
    usuarioEditando.value = null;
  }
}

const submitForm = () => {
  axios
    .post("/api/usuarios", { nome: nome.value, cpf: cpf.value })
    .then((response) => {
      console.log(response.data);

      if (response.data.error) {
        alert(response.data.error);
      } else {
        alert("Usuário criado com sucesso");
        nome.value = "";
        cpf.value = "";
        location.reload();
      }
    })
    .catch((error) => {
      console.error(error);
      alert(
        "Ocorreu um erro ao cadastrar o usuário. Verifique a numeração ou quantidade de digitos."
      );
    });
};

const editarUsuario = () => {
  axios
    .put(`/api/usuarios/${usuarioEditando.value.usuario_id}`, {
      nome: novoNome.value,
      cpf: novoCPF.value,
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

const deletarUsuario = (usuario_id) => {
  axios
    .delete(`/api/usuarios/${usuario_id}`)
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
  props: ["usuarios"],
};
</script>
