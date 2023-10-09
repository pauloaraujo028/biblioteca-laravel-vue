<template>
  <nav class="min-w-[180px] bg-[#1e293b] text-white">
    <Link href="/" class="h-[80px] px-3 flex items-center gap-3">
      <ApplicationLogo class="block h-9 w-auto fill-current text-white" />
      Digital Book
    </Link>
    <div class="px-3">
      <CreateNewDropdown />

      <div class="py-3">
        <NavLink :href="route('dashboard')" :active="$page.url === '/dashboard'"
          >Dashboard</NavLink
        >
        <NavLink :href="route('usuarios')" :active="$page.url === '/usuarios'"
          >Usuários</NavLink
        >
        <NavLink :href="route('livros')" :active="$page.url === '/livros'"
          >Livros</NavLink
        >
        <NavLink :href="route('alugueis')" :active="$page.url === '/alugueis'"
          >Aluguel</NavLink
        >
      </div>
    </div>
  </nav>
</template>
<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import CreateNewDropdown from "@/Components/app/CreateNewDropdown.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/vue3";
</script>
