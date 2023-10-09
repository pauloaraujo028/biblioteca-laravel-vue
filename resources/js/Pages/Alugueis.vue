<template>
  <Head title="Alugueis" />
  <AuthenticatedLayout>
    <section class="flex flex-col gap-4">
      <!-- Formulário de Cadastro -->
      <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <header class="flex justify-between">
            <h2 class="text-2xl font-medium text-gray-900 mb-4">
              Cadastrar Aluguel
            </h2>
            <PrimaryButton onclick="exportarAlugueis()"
              >Exportar Aluguéis</PrimaryButton
            >
          </header>
          <form
            @submit.prevent="cadastrarAluguel"
            class="mt-6 space-y-6 max-w-xl"
          >
            <div>
              <InputLabel for="livro" value="Livro" />
              <select
                required
                v-model="livroSelecionado"
                id="livro"
                class="block w-full p-2 border border-gray-300 rounded-md"
              >
                <option value="" disabled selected>Selecione um Livro</option>
                <option
                  v-for="livro in livros"
                  :key="livro.livro_id"
                  :value="livro.livro_id"
                >
                  {{ livro.nome_livro }}
                </option>
              </select>
            </div>
            <div>
              <InputLabel for="usuario" value="Usuário" />
              <select
                required
                v-model="usuarioSelecionado"
                id="usuario"
                class="block w-full p-2 border border-gray-300 rounded-md"
              >
                <option value="" disabled selected>Selecione um Usuário</option>
                <option
                  v-for="usuario in usuarios"
                  :key="usuario.usuario_id"
                  :value="usuario.usuario_id"
                >
                  {{ usuario.nome }}
                </option>
              </select>
            </div>
            <div>
              <InputLabel for="dataInicio" value="Data de Início" />
              <input
                required
                type="date"
                v-model="dataInicio"
                id="dataInicio"
                class="block w-full p-2 border border-gray-300 rounded-md"
              />

              <InputLabel for="dataDevolucao" value="Data de Devolução" />
              <input
                required
                type="date"
                v-model="dataDevolucao"
                id="dataDevolucao"
                class="block w-full p-2 border border-gray-300 rounded-md"
              />
            </div>
            <div class="flex items-center gap-4">
              <PrimaryButton :disabled="cadastrarAluguel.processing"
                >Salvar</PrimaryButton
              >
            </div>
          </form>
        </div>
      </div>

      <!-- Lista de Alugueis Cadastrados -->
      <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <header>
            <h2 class="text-2xl font-medium text-gray-900 mb-4">
              Alugueis Cadastrados
            </h2>
          </header>
          <table class="min-w-full">
            <thead>
              <tr class="border-b-2 border-t-2">
                <th class="py-2 text-left">Usuário</th>
                <th class="py-2 text-left">Livro</th>
                <th class="py-2 text-left">Data de Início</th>
                <th class="py-2 text-left">Data de Devolução</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="aluguel in alugueis" :key="aluguel.id">
                <td class="py-2">{{ aluguel.nomeUsuario }}</td>
                <td class="py-2">{{ aluguel.nomeLivro }}</td>
                <td class="py-2">{{ aluguel.dt_aluguel_ini }}</td>
                <td class="py-2">{{ aluguel.dt_aluguel_fim }}</td>
                <td class="py-2">
                  <button
                    @click="abrirModalEditar(aluguel)"
                    class="px-4 py-1 bg-blue-500 text-white rounded-md mr-2"
                  >
                    Editar
                  </button>
                  <button
                    @click="deletarLivro(aluguel.aluguel_id)"
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
                <div class="flex flex-col" v-if="AluguelEditando">
                  <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Editar Aluguel
                  </h2>
                  <form @submit.prevent="editarAluguel">
                    <div class="hidden">
                      <InputLabel for="livro_id" value="ID do Livro" />
                      <input
                        type="text"
                        v-model="AluguelEditando.livro_id"
                        id="livro_id"
                        class="block w-full p-2 border border-gray-300 rounded-md"
                        readonly
                      />
                    </div>
                    <div class="hidden">
                      <InputLabel for="usuario_id" value="ID do Usuário" />
                      <input
                        type="text"
                        v-model="AluguelEditando.usuario_id"
                        id="usuario_id"
                        class="block w-full p-2 border border-gray-300 rounded-md"
                        readonly
                      />
                    </div>
                    <div>
                      <InputLabel
                        for="dataInicio"
                        value="Nova Data de Início"
                      />
                      <input
                        type="date"
                        v-model="novaDataInicio"
                        id="dataInicio"
                        class="block w-full p-2 border border-gray-300 rounded-md"
                      />
                    </div>
                    <div>
                      <InputLabel for="dataFim" value="Nova Data de Fim" />
                      <input
                        type="date"
                        v-model="novaDataFim"
                        id="dataFim"
                        class="block w-full p-2 border border-gray-300 rounded-md"
                      />
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                      <PrimaryButton :disabled="cadastrarAluguel.processing">
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
import moment from "moment";
import { ref, onMounted } from "vue";
import axios from "axios";
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from "@headlessui/vue";

const livroSelecionado = ref(null);
const usuarioSelecionado = ref(null);
const dataInicio = ref(null);
const dataDevolucao = ref(null);
const isOpen = ref(false);
const AluguelEditando = ref(null);
const novoAluguel = ref("");
const novaDataInicio = ref(null);
const novaDataFim = ref(null);

const livros = ref([]);
const usuarios = ref([]);
const alugueis = ref([]);

function encontrarNomePorID(id, array) {
  const item = array.find((item) => item.usuario_id === id);
  return item ? item.nome : "Nome não encontrado";
}

function encontrarNomeLivroPorID(id, array) {
  const item = array.find((item) => item.livro_id === id);
  return item ? item.nome_livro : "Livro não encontrado";
}

const abrirModalEditar = (aluguel) => {
  AluguelEditando.value = aluguel;
  novoAluguel.value = aluguel.nome;
  setIsOpen(true);
};

function setIsOpen(value) {
  isOpen.value = value;
  if (!value) {
    AluguelEditando.value = null;
    novoAluguel.value = "";
  }
}

function exportarAlugueis() {
  window.location.href = "/alugueis-txt";
}

onMounted(async () => {
  try {
    const responseLivros = await axios.get("/api/livros");
    const responseUsuarios = await axios.get("/api/usuarios");
    const responseAlugueis = await axios.get("/api/alugueis");

    livros.value = responseLivros.data;
    usuarios.value = responseUsuarios.data;
    alugueis.value = responseAlugueis.data;

    alugueis.value.forEach((aluguel) => {
      aluguel.nomeUsuario = encontrarNomePorID(
        aluguel.usuario_id,
        usuarios.value
      );
      aluguel.nomeLivro = encontrarNomeLivroPorID(
        aluguel.livro_id,
        livros.value
      );
    });
  } catch (error) {
    console.error(error);
  }
});

const cadastrarAluguel = async () => {
  if (
    livroSelecionado.value &&
    usuarioSelecionado.value &&
    dataInicio.value &&
    dataDevolucao.value
  ) {
    try {
      const response = await axios.post("/api/alugueis", {
        livro_id: livroSelecionado.value,
        usuario_id: usuarioSelecionado.value,
        dt_aluguel_ini: dataInicio.value,
        dt_aluguel_fim: dataDevolucao.value,
      });

      if (response.data.message) {
        alert(response.data.message);
      }

      livroSelecionado.value = null;
      usuarioSelecionado.value = null;
      dataInicio.value = null;
      dataDevolucao.value = null;

      location.reload();
    } catch (error) {
      if (
        error.response &&
        error.response.data &&
        error.response.data.message
      ) {
        alert(error.response.data.message);
      } else {
        console.error("Erro ao cadastrar aluguel:", error);
      }
    }
  } else {
    alert("Por favor, preencha todos os campos.");
  }
};

const editarAluguel = () => {
  const novoAluguelData = {
    aluguel_id: AluguelEditando.value.aluguel_id,
    livro_id: AluguelEditando.value.livro_id,
    usuario_id: AluguelEditando.value.usuario_id,
    dt_aluguel_ini: novaDataInicio.value,
    dt_aluguel_fim: novaDataFim.value,
  };

  axios
    .put(`/api/alugueis/${AluguelEditando.value.aluguel_id}`, novoAluguelData)
    .then((response) => {
      console.log(response.data);
      setIsOpen(false);
      location.reload();
    })
    .catch((error) => {
      console.error("Erro na requisição POST:", error);
    });
};

const deletarLivro = (aluguel_id) => {
  axios
    .delete(`/api/alugueis/${aluguel_id}`)
    .then((response) => {
      console.log(response.data);
      location.reload();
    })
    .catch((error) => {
      console.error(error);
    });
};
</script>
