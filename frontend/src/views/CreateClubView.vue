<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/lib/axios'
import AppSidebar from "@/components/AppSidebar.vue"
import { SidebarProvider, SidebarInset, SidebarTrigger } from "@/components/ui/sidebar"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Card, CardHeader, CardTitle, CardDescription, CardContent } from "@/components/ui/card"

const router = useRouter()
const name = ref('')
const description = ref('')
const error = ref('')
const submitting = ref(false)

async function submit() {
  error.value = ''
  if (!name.value || name.value.length < 3) {
    error.value = 'Name must be at least 3 characters'
    return
  }
  submitting.value = true
  try {
    await api.post('/clubs', {
      name: name.value,
      description: description.value,
    })
    router.push('/my-clubs')
  } catch (e: any) {
    error.value = e.response?.data?.name?.[0] || e.response?.data?.error || 'Failed to create club'
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
        <div class="text-sm font-medium">Create Club</div>
      </header>

      <main class="p-6 max-w-lg">
        <Card>
          <CardHeader>
            <CardTitle>Create a New Club</CardTitle>
            <CardDescription>Fill in the details to start your club on ClubFlow.</CardDescription>
          </CardHeader>
          <CardContent>
            <form @submit.prevent="submit" class="space-y-4">
              <div class="space-y-2">
                <Label for="name">Club Name</Label>
                <Input id="name" v-model="name" placeholder="e.g. Computer Science Society" required />
              </div>
              <div class="space-y-2">
                <Label for="description">Description</Label>
                <textarea
                  id="description"
                  v-model="description"
                  placeholder="What is your club about?"
                  class="flex min-h-[100px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                />
              </div>
              <p v-if="error" class="text-sm text-destructive">{{ error }}</p>
              <Button type="submit" :disabled="submitting" class="w-full">
                {{ submitting ? 'Creating...' : 'Create Club' }}
              </Button>
            </form>
          </CardContent>
        </Card>
      </main>
    </SidebarInset>
  </SidebarProvider>
</template>
