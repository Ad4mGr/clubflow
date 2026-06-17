<script setup lang="ts">
import type { HTMLAttributes } from "vue"
import { cn } from '@/lib/utils'
import { Button } from '@/components/ui/button'
import { Card, CardContent } from '@/components/ui/card'
import {
  Field,
  FieldDescription,
  FieldGroup,
  FieldLabel,
  FieldSeparator,
} from '@/components/ui/field'
import { Input } from '@/components/ui/input'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()

const auth   = useAuthStore()
const router = useRouter()

const full_name      = ref('')
const email          = ref('')
const password       = ref('')
const confirmPassword = ref('')
const error          = ref('')
const loading        = ref(false)

async function handleRegister(): Promise<void> {
  error.value   = ''

  if (password.value !== confirmPassword.value) {
    error.value = 'Passwords do not match'
    return
  }

  loading.value = true
  try {
    await auth.signup(full_name.value, email.value, password.value)
    router.push('/login')
  } catch (err: unknown) {
    const axiosErr = err as { response?: { data?: Record<string, string> } }
    const data = axiosErr.response?.data
    error.value = data
      ? Object.values(data).join(', ')
      : 'Registration failed'
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div :class="cn('flex flex-col gap-6', props.class)">
    <Card class="overflow-hidden p-0 border-white/60 shadow-2xl shadow-purple-500/10">
      <CardContent class="grid p-0 md:grid-cols-2">
        <form class="p-6 md:p-8">
          <FieldGroup>
            <div class="flex flex-col items-center gap-2 text-center">
              <div class="text-3xl mb-1">✨</div>
              <h1 class="text-2xl font-black text-gray-900">
                Join the club
              </h1>
              <p class="text-gray-500 text-sm max-w-xs">
                Create your account and start running your club like a boss.
              </p>
            </div>
            <Field>
              <FieldLabel for="full_name">What should we call you?</FieldLabel>
              <Input id="full_name" type="text" placeholder="e.g. Jamie Chen" v-model="full_name" required />
            </Field>
            <Field>
              <FieldLabel for="email">
                Email
              </FieldLabel>
              <Input
                id="email"
                type="email"
                placeholder="you@university.edu"
                v-model="email"
                required
              />
              <FieldDescription class="text-xs text-gray-400">
                Your uni email. We promise not to spam you. 🤞
              </FieldDescription>
            </Field>
            <Field>
              <Field class="grid grid-cols-2 gap-4">
                <Field>
                  <FieldLabel for="password">
                    Password
                  </FieldLabel>
                  <Input id="password" type="password" v-model="password" required />
                </Field>
                <Field>
                  <FieldLabel for="confirm-password">
                    Confirm it
                  </FieldLabel>
                  <Input id="confirm-password" type="password" v-model="confirmPassword" required />
                </Field>
              </Field>
              <FieldDescription class="text-xs text-gray-400">
                At least 8 characters. Make it a good one. 🔒
              </FieldDescription>
            </Field>
            <Field>
              <p v-if="error" class="text-sm text-red-500">{{ error }}</p>
              <Button type="button" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white shadow-lg shadow-purple-500/30 border-0" :disabled="loading" @click="handleRegister">
                {{ loading ? 'Creating account...' : 'Create Account ✨' }}
              </Button>
            </Field>
            <FieldSeparator class="*:data-[slot=field-separator-content]:bg-card">
              Or continue with
            </FieldSeparator>
            <Field class="grid grid-cols-3 gap-4">
              <Button variant="outline" type="button" class="border-gray-200 hover:border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path d="M12.152 6.896c-.948 0-2.415-1.078-3.96-1.04-2.04.027-3.91 1.183-4.961 3.014-2.117 3.675-.546 9.103 1.519 12.09 1.013 1.454 2.208 3.09 3.792 3.039 1.52-.065 2.09-.987 3.935-.987 1.831 0 2.35.987 3.96.948 1.637-.026 2.676-1.48 3.676-2.948 1.156-1.688 1.636-3.325 1.662-3.415-.039-.013-3.182-1.221-3.22-4.857-.026-3.04 2.48-4.494 2.597-4.559-1.429-2.09-3.623-2.324-4.39-2.376-2-.156-3.675 1.09-4.61 1.09zM15.53 3.83c.843-1.012 1.4-2.427 1.245-3.83-1.207.052-2.662.805-3.532 1.818-.78.896-1.454 2.338-1.273 3.714 1.338.104 2.715-.688 3.559-1.701" fill="currentColor"/>
                </svg>
                <span class="text-xs hidden sm:inline">Apple</span>
              </Button>
              <Button variant="outline" type="button" class="border-gray-200 hover:border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" fill="currentColor"/>
                </svg>
                <span class="text-xs hidden sm:inline">Google</span>
              </Button>
              <Button variant="outline" type="button" class="border-gray-200 hover:border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path d="M6.915 4.03c-1.968 0-3.683 1.28-4.871 3.113C.704 9.208 0 11.883 0 14.449c0 .706.07 1.369.21 1.973a6.624 6.624 0 0 0 .265.86 5.297 5.297 0 0 0 .371.761c.696 1.159 1.818 1.927 3.593 1.927 1.497 0 2.633-.671 3.965-2.444.76-1.012 1.144-1.626 2.663-4.32l.756-1.339.186-.325c.061.1.121.196.183.3l2.152 3.595c.724 1.21 1.665 2.556 2.47 3.314 1.046.987 1.992 1.22 3.06 1.22 1.075 0 1.876-.355 2.455-.843a3.743 3.743 0 0 0 .81-.973c.542-.939.861-2.127.861-3.745 0-2.72-.681-5.357-2.084-7.45-1.282-1.912-2.957-2.93-4.716-2.93-1.047 0-2.088.467-3.053 1.308-.652.57-1.257 1.29-1.82 2.05-.69-.875-1.335-1.547-1.958-2.056-1.182-.966-2.315-1.303-3.454-1.303zm10.16 2.053c1.147 0 2.188.758 2.992 1.999 1.132 1.748 1.647 4.195 1.647 6.4 0 1.548-.368 2.9-1.839 2.9-.58 0-1.027-.23-1.664-1.004-.496-.601-1.343-1.878-2.832-4.358l-.617-1.028a44.908 44.908 0 0 0-1.255-1.98c.07-.109.141-.224.211-.327 1.12-1.667 2.118-2.602 3.358-2.602zm-10.201.553c1.265 0 2.058.791 2.675 1.446.307.327.737.871 1.234 1.579l-1.02 1.566c-.757 1.163-1.882 3.017-2.837 4.338-1.191 1.649-1.81 1.817-2.486 1.817-.524 0-1.038-.237-1.383-.794-.263-.426-.464-1.13-.464-2.046 0-2.221.63-4.535 1.66-6.088.454-.687.964-1.226 1.533-1.533a2.264 2.264 0 0 1 1.088-.285z" fill="currentColor"/>
                </svg>
                <span class="text-xs hidden sm:inline">Meta</span>
              </Button>
            </Field>
            <div class="text-center text-sm text-gray-500">
              Already in a club? <RouterLink to="/login" class="text-purple-600 font-bold hover:text-purple-700">Sign in →</RouterLink>
            </div>
          </FieldGroup>
        </form>
        <div class="bg-gradient-to-br from-purple-500 via-pink-500 to-orange-400 relative hidden md:flex flex-col items-center justify-center p-8 text-white">
          <div class="text-6xl mb-4">🚀</div>
          <h3 class="text-xl font-bold text-center mb-2">Your club starts here</h3>
          <p class="text-white/80 text-sm text-center max-w-xs">Create events, manage members, post announcements — all for free, forever.</p>
          <div class="mt-6 grid grid-cols-3 gap-2 w-full max-w-[200px]">
            <div class="bg-white/15 rounded-lg p-2 text-center backdrop-blur-sm">
              <div class="text-lg font-black">0$</div>
              <div class="text-[10px] text-white/70 uppercase tracking-wide">forever</div>
            </div>
            <div class="bg-white/15 rounded-lg p-2 text-center backdrop-blur-sm">
              <div class="text-lg font-black">∞</div>
              <div class="text-[10px] text-white/70 uppercase tracking-wide">members</div>
            </div>
            <div class="bg-white/15 rounded-lg p-2 text-center backdrop-blur-sm">
              <div class="text-lg font-black">2m</div>
              <div class="text-[10px] text-white/70 uppercase tracking-wide">setup</div>
            </div>
          </div>
        </div>
      </CardContent>
    </Card>
  </div>
</template>
