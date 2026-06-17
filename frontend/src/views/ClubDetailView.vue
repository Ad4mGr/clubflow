<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import api from '@/lib/axios'
import { useAuthStore } from '@/stores/auth'
import AppSidebar from "@/components/AppSidebar.vue"
import { SidebarProvider, SidebarInset, SidebarTrigger } from "@/components/ui/sidebar"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Card, CardHeader, CardTitle, CardDescription, CardContent } from "@/components/ui/card"
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import { Badge } from "@/components/ui/badge"
import { Separator } from "@/components/ui/separator"
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import {
  Calendar,
  ChevronDown,
  MapPin,
  Clock,
  Plus,
  Trash2,
  Edit,
  Users,
  Megaphone,
  Info,
} from "@lucide/vue"

const route = useRoute()
const auth = useAuthStore()
const activeTab = ref<'info' | 'events' | 'announcements'>('info')

// --- Club ---
interface ClubMember {
  id: number
  full_name: string
  email: string
  avatar_url: string | null
  role: string
  status: string
  membership_id?: number
}
interface Club {
  id: number
  name: string
  slug: string
  description: string | null
  logo_url: string | null
  is_active: boolean
  members: ClubMember[]
  my_membership: { id: number; role: string; status: string } | null
}
const club = ref<Club | null>(null)
const allMembers = ref<ClubMember[]>([])
const loading = ref(true)
const error = ref('')

const isOfficer = computed(() =>
  club.value?.my_membership?.role === 'officer' || club.value?.my_membership?.role === 'president'
)
const isPresident = computed(() => club.value?.my_membership?.role === 'president')
const pendingMembers = computed(() => allMembers.value.filter(m => m.status === 'pending'))

// --- Events ---
interface EventItem {
  id: number
  club_id: number
  title: string
  description: string | null
  location: string | null
  start_time: string
  end_time: string | null
  created_by: number
  creator_name: string
  rsvp_count: number
  my_rsvp: string | null
}
const events = ref<EventItem[]>([])
const eventsLoading = ref(false)
const showEventForm = ref(false)
const editingEventId = ref<number | null>(null)
const eventForm = ref({ title: '', description: '', location: '', start_time: '', end_time: '' })
const eventFormError = ref('')
const eventFormSubmitting = ref(false)

function resetEventForm() {
  eventForm.value = { title: '', description: '', location: '', start_time: '', end_time: '' }
  editingEventId.value = null
  showEventForm.value = false
  eventFormError.value = ''
}

async function fetchEvents() {
  if (!club.value) return
  eventsLoading.value = true
  try {
    const { data } = await api.get<EventItem[]>(`/clubs/${club.value.id}/events`)
    events.value = data
  } catch {
    // ok
  } finally {
    eventsLoading.value = false
  }
}

async function submitEvent() {
  eventFormError.value = ''
  if (!eventForm.value.title || !eventForm.value.start_time) {
    eventFormError.value = 'Title and start time are required'
    return
  }
  if (!club.value) return
  eventFormSubmitting.value = true
  try {
    if (editingEventId.value) {
      await api.put(`/clubs/${club.value.id}/events/${editingEventId.value}`, eventForm.value)
    } else {
      await api.post(`/clubs/${club.value.id}/events`, eventForm.value)
    }
    resetEventForm()
    await fetchEvents()
  } catch (e: any) {
    eventFormError.value = 'Failed to save event'
  } finally {
    eventFormSubmitting.value = false
  }
}

async function deleteEvent(eventId: number) {
  if (!club.value) return
  try {
    await api.delete(`/clubs/${club.value.id}/events/${eventId}`)
    await fetchEvents()
  } catch {
    // ok
  }
}

function editEvent(event: EventItem) {
  editingEventId.value = event.id
  eventForm.value = {
    title: event.title,
    description: event.description || '',
    location: event.location || '',
    start_time: event.start_time.slice(0, 16),
    end_time: event.end_time ? event.end_time.slice(0, 16) : '',
  }
  showEventForm.value = true
}

async function rsvp(eventId: number, status: string) {
  if (!club.value) return
  try {
    await api.post(`/clubs/${club.value.id}/events/${eventId}/rsvp`, { status })
    await fetchEvents()
  } catch {
    // ok
  }
}

// --- Announcements ---
interface Announcement {
  id: number
  club_id: number
  title: string
  body: string
  created_by: number
  creator_name: string
  created_at: string
}
const announcements = ref<Announcement[]>([])
const announcementsLoading = ref(false)
const showAnnouncementForm = ref(false)
const editingAnnouncementId = ref<number | null>(null)
const announcementForm = ref({ title: '', body: '' })
const announcementFormError = ref('')
const announcementFormSubmitting = ref(false)

function resetAnnouncementForm() {
  announcementForm.value = { title: '', body: '' }
  editingAnnouncementId.value = null
  showAnnouncementForm.value = false
  announcementFormError.value = ''
}

async function fetchAnnouncements() {
  if (!club.value) return
  announcementsLoading.value = true
  try {
    const { data } = await api.get<Announcement[]>(`/clubs/${club.value.id}/announcements`)
    announcements.value = data
  } catch {
    // ok
  } finally {
    announcementsLoading.value = false
  }
}

async function submitAnnouncement() {
  announcementFormError.value = ''
  if (!announcementForm.value.title || !announcementForm.value.body) {
    announcementFormError.value = 'Title and body are required'
    return
  }
  if (!club.value) return
  announcementFormSubmitting.value = true
  try {
    if (editingAnnouncementId.value) {
      await api.put(`/clubs/${club.value.id}/announcements/${editingAnnouncementId.value}`, announcementForm.value)
    } else {
      await api.post(`/clubs/${club.value.id}/announcements`, announcementForm.value)
    }
    resetAnnouncementForm()
    await fetchAnnouncements()
  } catch (e: any) {
    announcementFormError.value = 'Failed to save announcement'
  } finally {
    announcementFormSubmitting.value = false
  }
}

async function deleteAnnouncement(id: number) {
  if (!club.value) return
  try {
    await api.delete(`/clubs/${club.value.id}/announcements/${id}`)
    await fetchAnnouncements()
  } catch {
    // ok
  }
}

function editAnnouncement(a: Announcement) {
  editingAnnouncementId.value = a.id
  announcementForm.value = { title: a.title, body: a.body }
  showAnnouncementForm.value = true
}

// --- General ---
async function fetchClub() {
  loading.value = true
  try {
    const { data } = await api.get<Club>(`/clubs/${route.params.slug}`)
    club.value = data
    if (auth.isLoggedIn) {
      if (isOfficer.value && club.value) {
        const { data: members } = await api.get<ClubMember[]>(`/clubs/${club.value.id}/members`)
        allMembers.value = members
      }
      if (club.value) {
        await fetchEvents()
        await fetchAnnouncements()
      }
    }
  } catch {
    error.value = 'Club not found'
  } finally {
    loading.value = false
  }
}

async function joinClub() {
  if (!club.value) return
  try {
    await api.post(`/clubs/${club.value.id}/join`)
    await fetchClub()
  } catch {
    // ok
  }
}

async function approveMember(userId: number) {
  if (!club.value) return
  try {
    await api.patch(`/clubs/${club.value.id}/members/${userId}/approve`)
    await fetchClub()
  } catch {
    // ok
  }
}

async function updateRole(userId: number, role: string) {
  if (!club.value) return
  try {
    await api.patch(`/clubs/${club.value.id}/members/${userId}/role`, { role })
    await fetchClub()
  } catch {
    // ok
  }
}

onMounted(fetchClub)

function initials(name: string) {
  return name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2)
}
function formatDate(iso: string) {
  return new Date(iso).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}
function formatTime(iso: string) {
  return new Date(iso).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' })
}
function isUpcoming(iso: string) {
  return new Date(iso) > new Date()
}
</script>

<template>
  <SidebarProvider>
    <AppSidebar />
    <SidebarInset>
      <header class="flex h-14 items-center gap-2 border-b px-4">
        <SidebarTrigger class="-ml-1" />
        <div class="text-sm font-medium">{{ club?.name || 'Club' }}</div>
      </header>

      <main class="p-6">
        <div v-if="loading" class="space-y-4">
          <div class="h-8 w-64 rounded bg-muted animate-pulse" />
          <div class="h-4 w-96 rounded bg-muted animate-pulse" />
        </div>

        <div v-else-if="error" class="text-center py-12">
          <p class="text-destructive">{{ error }}</p>
          <Button variant="outline" class="mt-4" as-child>
            <RouterLink to="/clubs">Back to Clubs</RouterLink>
          </Button>
        </div>

        <template v-else-if="club">
          <!-- Club Header -->
          <div class="flex items-start justify-between mb-6">
            <div>
              <h1 class="text-3xl font-semibold">{{ club.name }}</h1>
              <p v-if="club.description" class="text-muted-foreground mt-2 max-w-xl">
                {{ club.description }}
              </p>
            </div>
            <div class="flex gap-2 shrink-0">
              <Button v-if="!club.my_membership" @click="joinClub">Join Club</Button>
              <Badge v-else-if="club.my_membership.status === 'pending'" variant="outline" class="text-yellow-600">Request Pending</Badge>
              <div v-else-if="isOfficer" class="flex gap-2">
                <Button variant="outline" as-child>
                  <RouterLink :to="`/clubs/${club.slug}/settings`">Settings</RouterLink>
                </Button>
              </div>
            </div>
          </div>

          <!-- Tabs -->
          <div class="flex gap-1 border-b mb-6">
            <button @click="activeTab = 'info'" :class="['px-4 py-2 text-sm font-medium border-b-2 transition-colors', activeTab === 'info' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground']">
              <Info class="inline h-4 w-4 mr-1.5" />Info
            </button>
            <button @click="activeTab = 'events'" :class="['px-4 py-2 text-sm font-medium border-b-2 transition-colors', activeTab === 'events' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground']">
              <Calendar class="inline h-4 w-4 mr-1.5" />Events
            </button>
            <button @click="activeTab = 'announcements'" :class="['px-4 py-2 text-sm font-medium border-b-2 transition-colors', activeTab === 'announcements' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground']">
              <Megaphone class="inline h-4 w-4 mr-1.5" />Announcements
            </button>
          </div>

          <!-- === INFO TAB === -->
          <div v-if="activeTab === 'info'" class="space-y-6">
            <div v-if="isOfficer && pendingMembers.length > 0">
              <h2 class="text-lg font-semibold mb-3">Pending Requests ({{ pendingMembers.length }})</h2>
              <div class="space-y-2">
                <Card v-for="member in pendingMembers" :key="member.id">
                  <CardContent class="flex items-center justify-between py-3">
                    <div class="flex items-center gap-3">
                      <Avatar class="h-8 w-8">
                        <AvatarImage :src="member.avatar_url || ''" />
                        <AvatarFallback>{{ initials(member.full_name) }}</AvatarFallback>
                      </Avatar>
                      <div>
                        <p class="text-sm font-medium">{{ member.full_name }}</p>
                        <p class="text-xs text-muted-foreground">{{ member.email }}</p>
                      </div>
                    </div>
                    <Button size="sm" @click="approveMember(member.id)">Approve</Button>
                  </CardContent>
                </Card>
              </div>
            </div>

            <div>
              <h2 class="text-lg font-semibold mb-3">Members ({{ club.members.length }})</h2>
              <div class="space-y-2">
                <template v-if="isOfficer">
                  <Card v-for="member in allMembers.filter(m => m.status === 'active' || m.status === 'pending')" :key="member.id">
                    <CardContent class="flex items-center justify-between py-3">
                      <div class="flex items-center gap-3">
                        <Avatar class="h-8 w-8">
                          <AvatarImage :src="member.avatar_url || ''" />
                          <AvatarFallback>{{ initials(member.full_name) }}</AvatarFallback>
                        </Avatar>
                        <div>
                          <p class="text-sm font-medium">{{ member.full_name }}</p>
                          <div class="flex items-center gap-2">
                            <p class="text-xs text-muted-foreground">{{ member.email }}</p>
                            <Badge v-if="member.status === 'pending'" variant="outline" class="text-yellow-600 text-[10px]">Pending</Badge>
                          </div>
                        </div>
                      </div>
                      <div class="flex items-center gap-2">
                        <Badge :variant="member.role === 'president' ? 'default' : member.role === 'officer' ? 'secondary' : 'outline'">{{ member.role }}</Badge>
                        <DropdownMenu v-if="isPresident && member.role !== 'president'">
                          <DropdownMenuTrigger as-child>
                            <Button variant="ghost" size="icon" class="h-8 w-8"><ChevronDown class="h-4 w-4" /></Button>
                          </DropdownMenuTrigger>
                          <DropdownMenuContent align="end">
                            <DropdownMenuItem v-if="member.role !== 'officer'" @click="updateRole(member.id, 'officer')">Promote to Officer</DropdownMenuItem>
                            <DropdownMenuItem v-if="member.role !== 'member'" @click="updateRole(member.id, 'member')">Demote to Member</DropdownMenuItem>
                          </DropdownMenuContent>
                        </DropdownMenu>
                      </div>
                    </CardContent>
                  </Card>
                </template>
                <template v-else>
                  <Card v-for="member in club.members" :key="member.id">
                    <CardContent class="flex items-center justify-between py-3">
                      <div class="flex items-center gap-3">
                        <Avatar class="h-8 w-8">
                          <AvatarImage :src="member.avatar_url || ''" />
                          <AvatarFallback>{{ initials(member.full_name) }}</AvatarFallback>
                        </Avatar>
                        <div>
                          <p class="text-sm font-medium">{{ member.full_name }}</p>
                          <p class="text-xs text-muted-foreground">{{ member.email }}</p>
                        </div>
                      </div>
                      <Badge :variant="member.role === 'president' ? 'default' : member.role === 'officer' ? 'secondary' : 'outline'">{{ member.role }}</Badge>
                    </CardContent>
                  </Card>
                </template>
              </div>
            </div>
          </div>

          <!-- === EVENTS TAB === -->
          <div v-if="activeTab === 'events'" class="space-y-4">
            <div class="flex items-center justify-between">
              <h2 class="text-lg font-semibold">Events</h2>
              <Button v-if="isOfficer" size="sm" @click="showEventForm = !showEventForm">
                <Plus class="h-4 w-4 mr-1" />{{ showEventForm ? 'Cancel' : 'New Event' }}
              </Button>
            </div>

            <!-- Event Form (create/edit) -->
            <Card v-if="showEventForm" class="border-primary/30">
              <CardContent class="pt-4">
                <form @submit.prevent="submitEvent" class="space-y-3">
                  <div class="space-y-1">
                    <Label>Title</Label>
                    <Input v-model="eventForm.title" placeholder="Event title" required />
                  </div>
                  <div class="space-y-1">
                    <Label>Description</Label>
                    <textarea v-model="eventForm.description" rows="2" class="flex w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring" placeholder="Optional description" />
                  </div>
                  <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                      <Label>Location</Label>
                      <Input v-model="eventForm.location" placeholder="Room 301" />
                    </div>
                    <div class="space-y-1"></div>
                    <div class="space-y-1">
                      <Label>Start Time</Label>
                      <Input v-model="eventForm.start_time" type="datetime-local" required />
                    </div>
                    <div class="space-y-1">
                      <Label>End Time</Label>
                      <Input v-model="eventForm.end_time" type="datetime-local" />
                    </div>
                  </div>
                  <p v-if="eventFormError" class="text-sm text-destructive">{{ eventFormError }}</p>
                  <div class="flex gap-2">
                    <Button type="submit" size="sm" :disabled="eventFormSubmitting">{{ editingEventId ? 'Update' : 'Create' }} Event</Button>
                    <Button type="button" variant="ghost" size="sm" @click="resetEventForm">Cancel</Button>
                  </div>
                </form>
              </CardContent>
            </Card>

            <div v-if="eventsLoading" class="space-y-2">
              <div v-for="i in 3" :key="i" class="h-24 rounded-lg bg-muted animate-pulse" />
            </div>
            <div v-else-if="events.length === 0" class="text-center py-8 text-muted-foreground">
              No events yet.
            </div>
            <div v-else class="space-y-2">
              <Card v-for="event in events" :key="event.id" :class="isUpcoming(event.start_time) ? '' : 'opacity-60'">
                <CardContent class="py-3">
                  <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                      <div class="flex items-center gap-2">
                        <h3 class="font-medium">{{ event.title }}</h3>
                        <Badge v-if="isUpcoming(event.start_time)" variant="outline" class="text-green-600 text-[10px]">Upcoming</Badge>
                      </div>
                      <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1 text-sm text-muted-foreground">
                        <span class="inline-flex items-center gap-1"><Calendar class="h-3.5 w-3.5" />{{ formatDate(event.start_time) }}</span>
                        <span class="inline-flex items-center gap-1"><Clock class="h-3.5 w-3.5" />{{ formatTime(event.start_time) }}</span>
                        <span v-if="event.location" class="inline-flex items-center gap-1"><MapPin class="h-3.5 w-3.5" />{{ event.location }}</span>
                        <span class="inline-flex items-center gap-1"><Users class="h-3.5 w-3.5" />{{ event.rsvp_count }} going</span>
                      </div>
                      <p v-if="event.description" class="text-sm text-muted-foreground mt-1 line-clamp-2">{{ event.description }}</p>
                    </div>
                    <div class="flex items-center gap-2 shrink-0 ml-4">
                      <Button v-if="event.my_rsvp" variant="outline" size="sm" @click="rsvp(event.id, event.my_rsvp === 'going' ? 'not_going' : 'going')">
                        {{ event.my_rsvp === 'going' ? 'Not Going' : 'Going' }}
                      </Button>
                      <Button v-else size="sm" @click="rsvp(event.id, 'going')">RSVP</Button>
                      <DropdownMenu v-if="isOfficer">
                        <DropdownMenuTrigger as-child>
                          <Button variant="ghost" size="icon" class="h-8 w-8"><ChevronDown class="h-4 w-4" /></Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                          <DropdownMenuItem @click="editEvent(event)"><Edit class="h-4 w-4 mr-2" />Edit</DropdownMenuItem>
                          <DropdownMenuItem @click="deleteEvent(event.id)"><Trash2 class="h-4 w-4 mr-2" />Delete</DropdownMenuItem>
                        </DropdownMenuContent>
                      </DropdownMenu>
                    </div>
                  </div>
                </CardContent>
              </Card>
            </div>
          </div>

          <!-- === ANNOUNCEMENTS TAB === -->
          <div v-if="activeTab === 'announcements'" class="space-y-4">
            <div class="flex items-center justify-between">
              <h2 class="text-lg font-semibold">Announcements</h2>
              <Button v-if="isOfficer" size="sm" @click="showAnnouncementForm = !showAnnouncementForm">
                <Plus class="h-4 w-4 mr-1" />{{ showAnnouncementForm ? 'Cancel' : 'New Post' }}
              </Button>
            </div>

            <!-- Announcement Form -->
            <Card v-if="showAnnouncementForm" class="border-primary/30">
              <CardContent class="pt-4">
                <form @submit.prevent="submitAnnouncement" class="space-y-3">
                  <div class="space-y-1">
                    <Label>Title</Label>
                    <Input v-model="announcementForm.title" placeholder="Announcement title" required />
                  </div>
                  <div class="space-y-1">
                    <Label>Body</Label>
                    <textarea v-model="announcementForm.body" rows="4" class="flex w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring" placeholder="Write your announcement..." required />
                  </div>
                  <p v-if="announcementFormError" class="text-sm text-destructive">{{ announcementFormError }}</p>
                  <div class="flex gap-2">
                    <Button type="submit" size="sm" :disabled="announcementFormSubmitting">{{ editingAnnouncementId ? 'Update' : 'Post' }} Announcement</Button>
                    <Button type="button" variant="ghost" size="sm" @click="resetAnnouncementForm">Cancel</Button>
                  </div>
                </form>
              </CardContent>
            </Card>

            <div v-if="announcementsLoading" class="space-y-2">
              <div v-for="i in 3" :key="i" class="h-32 rounded-lg bg-muted animate-pulse" />
            </div>
            <div v-else-if="announcements.length === 0" class="text-center py-8 text-muted-foreground">
              No announcements yet.
            </div>
            <div v-else class="space-y-3">
              <Card v-for="a in announcements" :key="a.id">
                <CardHeader class="pb-2">
                  <div class="flex items-start justify-between">
                    <div>
                      <CardTitle class="text-base">{{ a.title }}</CardTitle>
                      <CardDescription>
                        {{ a.creator_name }} &middot; {{ formatDate(a.created_at) }}
                      </CardDescription>
                    </div>
                    <DropdownMenu v-if="isOfficer">
                      <DropdownMenuTrigger as-child>
                        <Button variant="ghost" size="icon" class="h-8 w-8"><ChevronDown class="h-4 w-4" /></Button>
                      </DropdownMenuTrigger>
                      <DropdownMenuContent align="end">
                        <DropdownMenuItem @click="editAnnouncement(a)"><Edit class="h-4 w-4 mr-2" />Edit</DropdownMenuItem>
                        <DropdownMenuItem @click="deleteAnnouncement(a.id)"><Trash2 class="h-4 w-4 mr-2" />Delete</DropdownMenuItem>
                      </DropdownMenuContent>
                    </DropdownMenu>
                  </div>
                </CardHeader>
                <CardContent>
                  <p class="text-sm whitespace-pre-wrap">{{ a.body }}</p>
                </CardContent>
              </Card>
            </div>
          </div>
        </template>
      </main>
    </SidebarInset>
  </SidebarProvider>
</template>
