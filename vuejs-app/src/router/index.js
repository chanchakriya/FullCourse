import { createRouter, createWebHistory } from 'vue-router'
import Signin from '@/components/auth/Signin.vue';
import Signup from '@/components/auth/Signup.vue';
import Signout from '@/components/auth/Signout.vue';
import Dashboard from '@/components/pages/Dashboard.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'auth.signin',
      component: Signin,
    },
    {
      path: '/signup',
      name: 'auth.signup',
      component: Signup,
    },
    {
      path: '/signout',
      name: 'auth.signout',
      component: Signout,
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard,
    }
  ],
})

export default router
