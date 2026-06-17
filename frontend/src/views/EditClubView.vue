<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '@/lib/axios'
import AppSidebar from "@/components/AppSidebar.vue"
import { SidebarProvider, SidebarInset, SidebarTrigger } from "@/components/ui/sidebar"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Card, CardHeader, CardTitle, CardDescription, CardContent } from "@/components/ui/card"

const route = useRoute()
const router = useRouter()

const name = ref('')
const description = ref('')
const logoUrl = ref('')
const loading = ref(true)
const submitting = ref(false)
const error = ref('')
const clubId = ref<number | null>(null)

onMounted(async () => {
  try {
    const { data } = await api.get(`/clubs/${route.params.slug}`)
    clubId.value = data.id
    name.value = data.name
    description.value = data.description || ''
    logoUrl.value = data.logo_url || ''
  } catch {
    error.value = 'Failed to load club'
  } finally {
    loading.value = false
  }
})

async function submit() {
  if (!name.value || name.value.length < 3) {
    error.value = 'Name must be at least 3 characters'
    return
  }
  submitting.value = true
  error.value = ''
  try {
    await api.put(`/clubs/${clubId.value}`, {
      name: name.value,
      description: description.value,
      logo_url: logoUrl.value || null,
    })
    router.push(`/clubs/${route.params.slug}`)
  } catch (e: any) {
    error.value = e.response?.data?.name?.[0] || e.response?.data?.error || 'Failed to update club'
  } finally {
    submitting.value = false
  }
}
</script>

<template>
  <SidebarProvider>
    <AppSidebar />
    <SidebarInset>
      <header class="flex h-14 items-center gap-2 border-b px-4">
        <SidebarTrigger class="-ml-1" />
        <div class="text-sm font-medium">Club Settings</div>
      </header>

      <main class="p-6 max-w-lg">
        <div v-if="loading" class="space-y-4">
          <div class="h-8 w-48 rounded bg-muted animate-pulse" />
          <div class="h-32 rounded bg-muted animate-pulse" />
        </div>

        <Card v-else>
          <CardHeader>
            <CardTitle>Club Settings</CardTitle>
            <CardDescription>Update your club's information.</CardDescription>
          </CardHeader>
          <CardContent>
            <form @submit.prevent="submit" class="space-y-4">
              <div class="space-y-2">
                <Label for="name">Club Name</Label>
                <Input id="name" v-model="name" required />
              </div>
              <div class="space-y-2">
                <Label for="description">Description</Label>
                <textarea
                  id="description"
                  v-model="description"
                  class="flex min-h-[100px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                />
              </div>
              <div class="space-y-2">
                <Label for="logo">Logo URL</Label>
                <Input id="logo" v-model="logoUrl" placeholder="https://..." />
              </div>
              <p v-if="error" class="text-sm text-destructive">{{ error }}</p>
              <div class="flex gap-2">
                <Button type="submit" :disabled="submitting">
                  {{ submitting ? 'Saving...' : 'Save Changes' }}
                </Button>
                <Button variant="outline" as-child>
                  <RouterLink :to="`/clubs/${route.params.slug}`">Cancel</RouterLink>
                </Button>
              </div>
            </form>
          </CardContent>
        </Card>
      </main>
    </SidebarInset>
  </SidebarProvider>
</template>
