<script setup lang="ts">
import { ref, onMounted } from 'vue'
import api from '@/lib/axios'
import { useAuthStore } from '@/stores/auth'
import AppSidebar from "@/components/AppSidebar.vue"
import { SidebarProvider, SidebarInset, SidebarTrigger } from "@/components/ui/sidebar"
import { Button } from "@/components/ui/button"
import { Card, CardHeader, CardTitle, CardDescription, CardContent } from "@/components/ui/card"

const auth = useAuthStore()

interface MyClub {
  id: number
  name: string
  slug: string
  logo_url: string | null
  role: string
  status: string
}

const clubs = ref<MyClub[]>([])
const loading = ref(true)

onMounted(async () => {
  try {
    const { data } = await api.get<MyClub[]>('/me/clubs')
    clubs.value = data
  } catch {
    // ok
  } finally {
    loading.value = false
  }
})
</script>

<template>
  <SidebarProvider>
    <AppSidebar />
    <SidebarInset>
      <header class="flex h-14 items-center gap-2 border-b px-4">
        <SidebarTrigger class="-ml-1" />
        <div class="text-sm font-medium">My Clubs</div>
      </header>

      <main class="p-6 space-y-6">
        <div class="flex items-center justify-between">
          <h1 class="text-2xl font-semibold">My Clubs</h1>
          <Button as-child>
            <RouterLink to="/clubs/create">Create Club</RouterLink>
          </Button>
        </div>

        <div v-if="loading" class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
          <div v-for="i in 3" :key="i" class="h-32 rounded-lg bg-muted animate-pulse" />
        </div>

        <div v-else-if="clubs.length === 0" class="text-center py-12">
          <p class="text-muted-foreground mb-4">You haven't joined any clubs yet.</p>
          <Button as-child>
            <RouterLink to="/clubs">Browse Clubs</RouterLink>
          </Button>
        </div>

        <div v-else class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
          <Card v-for="club in clubs" :key="club.id">
            <CardHeader>
              <CardTitle class="text-lg">{{ club.name }}</CardTitle>
              <CardDescription>
                <span class="capitalize">{{ club.role }}</span>
                <span v-if="club.status === 'pending'" class="ml-2 text-yellow-600">(Pending approval)</span>
              </CardDescription>
            </CardHeader>
            <CardContent class="flex gap-2">
              <Button variant="outline" size="sm" as-child>
                <RouterLink :to="`/clubs/${club.slug}`">View</RouterLink>
              </Button>
              <Button v-if="club.role === 'officer' || club.role === 'president'" variant="outline" size="sm" as-child>
                <RouterLink :to="`/clubs/${club.slug}/settings`">Settings</RouterLink>
              </Button>
            </CardContent>
          </Card>
        </div>
      </main>
    </SidebarInset>
  </SidebarProvider>
</template>
