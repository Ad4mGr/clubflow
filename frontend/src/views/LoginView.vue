<script setup lang="ts">
import LoginForm from "@/components/new-york-v4/blocks/login-04/components/LoginForm.vue"
</script>

<template>
  <div class="min-h-svh relative overflow-hidden bg-gradient-to-b from-purple-50 via-pink-50 to-orange-50 flex flex-col">
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
      <div class="absolute -top-40 -left-40 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-[bob_8s_ease-in-out_infinite]" />
      <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-[bob_10s_ease-in-out_infinite_reverse]" />
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-[bob_12s_ease-in-out_infinite_2s]" />
    </div>

    <nav class="relative z-10 bg-white/70 backdrop-blur-xl border-b border-white/40">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <RouterLink to="/" class="flex items-center gap-2.5">
            <div class="w-9 h-9 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-lg font-extrabold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">ClubFlow</span>
          </RouterLink>
          <RouterLink to="/signup" class="text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors">
            No account? <span class="text-purple-600 font-bold">Sign up</span>
          </RouterLink>
        </div>
      </div>
    </nav>

    <main class="flex-1 flex items-center justify-center relative z-10 px-4 py-8">
      <LoginForm class="mx-auto w-full max-w-3xl" />
    </main>
  </div>
</template>

<style>
@keyframes bob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -30px) scale(1.05); }
  66% { transform: translate(-20px, 20px) scale(0.95); }
}
</style>
