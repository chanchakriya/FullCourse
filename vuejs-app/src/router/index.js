import { createRouter, createWebHistory } from 'vue-router'
import Signin from '@/auth/Signin.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'auth.signin',
      component: Signin,
    }
  ],
})

export default router
