<template>
  <div class="h-screen bg-gray-50 flex w-full">
    <Navigation />

    <main class="flex flex-col flex-1 px-4 overflow-hidden">
      <div class="flex items-center justify-between w-full">
        <SearchForm />
        <UserSettingsDropdown />
      </div>
      <div class="flex-1 flex flex-col overflow-y-auto">
        <slot />
      </div>
    </main>
  </div>
</template>

<script setup>
import Navigation from "@/Components/app/Navigation.vue";
import SearchForm from "@/Components/app/SearchForm.vue";
import UserSettingsDropdown from "@/Components/app/UserSettingsDropdown.vue";
</script>
