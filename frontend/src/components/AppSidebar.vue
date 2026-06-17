<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import type { SidebarProps } from '@/components/ui/sidebar'
import { useAuthStore } from '@/stores/auth'
import api from '@/lib/axios'

import {
  LayoutDashboard,
  Users,
  Club,
  Plus,
  ChevronRight,
} from "@lucide/vue"
import NavMain from '@/components/NavMain.vue'
import NavUser from '@/components/NavUser.vue'

import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarRail,
  SidebarMenu,
  SidebarMenuItem,
  SidebarMenuButton,
  SidebarGroup,
  SidebarGroupLabel,
} from '@/components/ui/sidebar'

import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from '@/components/ui/collapsible'

const props = withDefaults(defineProps<SidebarProps>(), {
  collapsible: "icon",
})

const auth = useAuthStore()

const userData = computed(() => ({
  name: auth.user?.full_name || 'User',
  email: auth.user?.email || '',
  avatar: auth.user?.avatar_url || '',
}))

interface UserClub {
  id: number
  name: string
  slug: string
  logo_url: string | null
  role: string
}
const myClubs = ref<UserClub[]>([])
const loadingClubs = ref(true)

onMounted(async () => {
  if (!auth.isLoggedIn) return
  try {
    const { data } = await api.get<UserClub[]>('/me/clubs')
    myClubs.value = data
  } catch {
    // ok
  } finally {
    loadingClubs.value = false
  }
})

const navMain = [
  { title: "Dashboard", url: "/dashboard", icon: LayoutDashboard },
  { title: "Browse Clubs", url: "/clubs", icon: Club },
  { title: "My Clubs", url: "/my-clubs", icon: Users },
  { title: "Create Club", url: "/clubs/create", icon: Plus },
]
</script>

<template>
  <Sidebar v-bind="props">
    <SidebarHeader>
      <div class="flex items-center gap-2 px-4 py-2">
        <div class="w-7 h-7 bg-accent-600 rounded-lg flex items-center justify-center">
          <span class="text-white text-xs font-bold">CF</span>
        </div>
        <span class="text-base font-semibold">ClubFlow</span>
      </div>
    </SidebarHeader>
    <SidebarContent>
      <SidebarGroup>
        <SidebarGroupLabel>Platform</SidebarGroupLabel>
        <SidebarMenu>
          <SidebarMenuItem v-for="item in navMain" :key="item.title">
            <SidebarMenuButton as-child :tooltip="item.title">
              <RouterLink :to="item.url">
                <component :is="item.icon" />
                <span>{{ item.title }}</span>
              </RouterLink>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarGroup>

      <SidebarGroup v-if="myClubs.length > 0">
        <SidebarGroupLabel>My Clubs</SidebarGroupLabel>
        <SidebarMenu>
          <Collapsible v-for="club in myClubs" :key="club.id" as-child default-open>
            <SidebarMenuItem>
              <CollapsibleTrigger as-child>
                <SidebarMenuButton>
                  <span>{{ club.name.charAt(0).toUpperCase() }}</span>
                  <span>{{ club.name }}</span>
                  <ChevronRight class="ml-auto" />
                </SidebarMenuButton>
              </CollapsibleTrigger>
              <CollapsibleContent>
                <SidebarMenu>
                  <SidebarMenuItem>
                    <SidebarMenuButton as-child class="ml-4">
                      <RouterLink :to="`/clubs/${club.slug}`">View</RouterLink>
                    </SidebarMenuButton>
                  </SidebarMenuItem>
                </SidebarMenu>
              </CollapsibleContent>
            </SidebarMenuItem>
          </Collapsible>
        </SidebarMenu>
      </SidebarGroup>
    </SidebarContent>
    <SidebarFooter>
      <NavUser :user="userData" />
    </SidebarFooter>
    <SidebarRail />
  </Sidebar>
</template>
