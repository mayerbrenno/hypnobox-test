<template>
    <div id="app">
      <router-view v-slot="{ Component }">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </div>
  </template>

  <script setup>
  import { onMounted } from 'vue'

  import { useAuthStore } from '../stores/auth'

  const authStore = useAuthStore()

  onMounted(() => {
    // Check for existing token on page load
    if (authStore.token) {
      // You might want to validate the token here
      router.push({ name: 'dashboard' })
    }
  })
  </script>

  <style>
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.3s ease;
  }

  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
  </style>
