<script setup lang="ts">
import AppSidebar from "@/components/AppSidebar.vue"
import { SidebarProvider, SidebarInset, SidebarTrigger } from "@/components/ui/sidebar"
</script>

<template>
  <SidebarProvider>
    <AppSidebar />
    <SidebarInset>
      <header class="flex h-14 items-center gap-2 border-b px-4">
        <SidebarTrigger class="-ml-1" />
        <div class="text-sm font-medium">Dashboard</div>
      </header>

      <main class="p-6">
        <h1 class="text-2xl font-semibold">Welcome</h1>
        <p class="text-muted-foreground">Your dashboard content goes here.</p>
      </main>
    </SidebarInset>
  </SidebarProvider>
</template>