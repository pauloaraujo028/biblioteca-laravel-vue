<template>
  <Menu as="div" class="relative block text-left">
    <MenuButton
      class="flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
    >
      Criar Novo
      <ChevronDownIcon
        class="ml-2 -mr-1 h-5 w-5 text-gray-800"
        aria-hidden="true"
      />
    </MenuButton>

    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <MenuItems
        class="absolute left-0 mt-1 w-full origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
      >
        <div class="px-1 py-1">
          <MenuItem
            ><a
              :href="route('alugueis')"
              class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 border-l-4 border-transparent hover:border-gray-300"
              >Alguel</a
            >
          </MenuItem>
        </div>
        <div class="px-1 py-1">
          <MenuItem
            ><a
              :href="route('livros')"
              class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 border-l-4 border-transparent hover:border-gray-300"
              >Livro</a
            >
          </MenuItem>
          <MenuItem
            ><a
              :href="route('usuarios')"
              class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 border-l-4 border-transparent hover:border-gray-300"
              >Usuário</a
            >
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
</script>
