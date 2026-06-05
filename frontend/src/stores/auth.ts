import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '@/lib/axios'

interface User {
  id: number
  full_name: string
  email: string
  student_id: string | null
  avatar_url: string | null
}

export const useAuthStore = defineStore('auth', () => {
  const token = ref<string | null>(localStorage.getItem('token'))
  const user  = ref<User | null>(JSON.parse(localStorage.getItem('user') || 'null'))

  const isLoggedIn = computed(() => !!token.value)

  async function login(email: string, password: string): Promise<void> {
    const { data } = await api.post<{ token: string; user: User }>('/login', { email, password })
    token.value = data.token
    user.value  = data.user
    localStorage.setItem('token', data.token)
    localStorage.setItem('user', JSON.stringify(data.user))
  }

  async function signup(full_name: string, email: string, password: string): Promise<void> {
    await api.post('/signup', { full_name, email, password })
  }

  function logout(): void {
    token.value = null
    user.value  = null
    localStorage.removeItem('token')
    localStorage.removeItem('user')
  }

  return { token, user, isLoggedIn, login, signup, logout }
})