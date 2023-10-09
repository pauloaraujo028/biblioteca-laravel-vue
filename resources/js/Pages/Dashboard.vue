<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div class="flex w-full gap-4">
      <div class="w-full mx-auto">
        <div class="bg-red-300 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">Usuários</div>
        </div>
      </div>
      <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">Usuários</div>
        </div>
      </div>
      <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">Usuários</div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>
