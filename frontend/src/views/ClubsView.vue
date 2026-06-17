<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import api from '@/lib/axios'
import AppSidebar from "@/components/AppSidebar.vue"
import { SidebarProvider, SidebarInset, SidebarTrigger } from "@/components/ui/sidebar"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Card, CardHeader, CardTitle, CardDescription, CardContent } from "@/components/ui/card"
import { Search } from "@lucide/vue"

interface Club {
  id: number
  name: string
  slug: string
  description: string | null
  logo_url: string | null
  member_count?: number
}

const clubs = ref<Club[]>([])
const search = ref('')
const loading = ref(true)

onMounted(async () => {
  try {
    const { data } = await api.get<Club[]>('/clubs')
    clubs.value = data
  } catch {
    // ok
  } finally {
    loading.value = false
  }
})

const filteredClubs = computed(() => {
  if (!search.value) return clubs.value
  const q = search.value.toLowerCase()
  return clubs.value.filter(c =>
    c.name.toLowerCase().includes(q) ||
    (c.description && c.description.toLowerCase().includes(q))
  )
})

</script>

<template>
  <SidebarProvider>
    <AppSidebar />
    <SidebarInset>
      <header class="flex h-14 items-center gap-2 border-b px-4">
        <SidebarTrigger class="-ml-1" />
        <div class="text-sm font-medium">Browse Clubs</div>
      </header>

      <main class="p-6 space-y-6">
        <div class="flex items-center justify-between">
          <h1 class="text-2xl font-semibold">All Clubs</h1>
          <Button as-child>
            <RouterLink to="/clubs/create">Create Club</RouterLink>
          </Button>
        </div>

        <div class="relative max-w-sm">
          <Search class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
          <Input v-model="search" placeholder="Search clubs..." class="pl-9" />
        </div>

        <div v-if="loading" class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
          <div v-for="i in 6" :key="i" class="h-40 rounded-lg bg-muted animate-pulse" />
        </div>

        <div v-else-if="filteredClubs.length === 0" class="text-center py-12">
          <p class="text-muted-foreground">No clubs found.</p>
        </div>

        <div v-else class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
          <Card v-for="club in filteredClubs" :key="club.id">
            <CardHeader>
              <CardTitle class="text-lg">{{ club.name }}</CardTitle>
              <CardDescription v-if="club.description" class="line-clamp-2">
                {{ club.description }}
              </CardDescription>
            </CardHeader>
            <CardContent>
              <Button variant="outline" size="sm" as-child>
                <RouterLink :to="`/clubs/${club.slug}`">View Club</RouterLink>
              </Button>
            </CardContent>
          </Card>
        </div>
      </main>
    </SidebarInset>
  </SidebarProvider>
</template>
