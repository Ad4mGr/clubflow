import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/',         component: () => import('@/views/Landing.vue') },
    { path: '/login',    component: () => import('@/views/LoginView.vue') },
    { path: '/signup',   component: () => import('@/views/SignupView.vue') },

    // Authenticated routes
    { path: '/dashboard',     component: () => import('@/views/DashboardView.vue'),  meta: { requiresAuth: true } },
    { path: '/clubs',         component: () => import('@/views/ClubsView.vue'),       meta: { requiresAuth: true } },
    { path: '/clubs/create',  component: () => import('@/views/CreateClubView.vue'),  meta: { requiresAuth: true } },
    { path: '/clubs/:slug',   component: () => import('@/views/ClubDetailView.vue'),  meta: { requiresAuth: true } },
    { path: '/clubs/:slug/settings', component: () => import('@/views/EditClubView.vue'), meta: { requiresAuth: true } },
    { path: '/my-clubs',      component: () => import('@/views/MyClubsView.vue'),     meta: { requiresAuth: true } },
  ],
})

router.beforeEach(to => {
  const auth = useAuthStore()
  if (to.meta.requiresAuth && !auth.isLoggedIn) return '/login'
})

export default router
