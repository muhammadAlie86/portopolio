import { createRouter, createWebHistory } from 'vue-router';

// Layouts
import AdminLayout from '../layouts/AdminLayout.vue';

// Portfolio Pages
import Home from '../views/portopolio/Home.vue';
import Article from '../views/portopolio/Article.vue';
import ArticleDetail from '../views/portopolio/ArticleDetail.vue';
import About from '../views/portopolio/About.vue';
import Contact from '../views/portopolio/Contact.vue';
import Experience from '../views/portopolio/Experience.vue';
import Project from '../views/portopolio/Project.vue';
import ProjectDetail from '../views/portopolio/ProjectDetail.vue';
import Skils from '../views/portopolio/Skils.vue';
import PortopolioLayout from '../layouts/PortopolioLayout.vue';

// Admin Pages
import AdminLogin from '../views/admin/Login.vue';
import AdminDashboard from '../views/admin/Dashboard.vue';
import AdminUserManagement from '../views/admin/UserManagement.vue';
import AdminProjectManagement from '../views/admin/ProjectManagement.vue';
import AdminReports from '../views/admin/Reports.vue';
import AdminAddNewUser from '../views/admin/AddNewUser.vue';
import AdminAddNewProject from '../views/admin/AdminAddNewProject.vue';
import AdminEditUser from '../views/admin/EditUser.vue';
import AdminEditProject from '../views/admin/EditProject.vue';

import AdminArticleManagement from '../views/admin/ArticleManagement.vue';
import AdminAddNewArticle from '../views/admin/AddNewArticle.vue';
import AdminEditArticle from '../views/admin/EditArticle.vue';

// General Pages
import NotFound from '../views/NotFound.vue';

const routes = [
  {
    path: '/',
    component: PortopolioLayout,
    children: [
      { path: '', name: 'Home', component: Home },
      { path: 'about', name: 'About', component: About },
      { path: 'article', name: 'Article', component: Article },
      { path: 'article/:slug', name: 'ArticleDetail', component: ArticleDetail, props: true },
      { path: 'contact', name: 'Contact', component: Contact },
      { path: 'experience', name: 'Experience', component: Experience },
      { path: 'project', name: 'Project', component: Project },
      { path: 'project/:id', name: 'ProjectDetail', component: ProjectDetail, props: true },
      { path: 'skils', name: 'Skils', component: Skils },
    ],
  },
  {
    path: '/admin',
    component: AdminLayout,
    children: [
      { path: '', redirect: '/admin/dashboard' },
      { path: 'login', name: 'AdminLogin', component: AdminLogin },
      { 
        path: 'dashboard', 
        name: 'AdminDashboard', 
        component: AdminDashboard,
        meta: { requiresAuth: true } // Rute ini dilindungi
      },
      {
        path: 'users',
        name: 'AdminUserManagement',
        component: AdminUserManagement,
        meta: { requiresAuth: true } // Rute ini juga dilindungi
      },
      {
        path: 'projects',
        name: 'AdminProjectManagement',
        component: AdminProjectManagement,
        meta: { requiresAuth: true }
      },
      {
        path: 'users/create',
        name: 'AdminAddNewUser',
        component: AdminAddNewUser,
        meta: { requiresAuth: true }
      },
      {
        path: 'users/:id/edit',
        name: 'AdminEditUser',
        component: AdminEditUser,
        props: true,
        meta: { requiresAuth: true }
      },
      {
        path: 'projects/create',
        name: 'AdminAddNewProject',
        component: AdminAddNewProject,
        meta: { requiresAuth: true }
      },
      {
        path: 'projects/:id/edit',
        name: 'AdminEditProject',
        component: AdminEditProject,
        props: true,
        meta: { requiresAuth: true }
      },
      {
        path: 'articles',
        name: 'AdminArticleManagement',
        component: AdminArticleManagement,
        meta: { requiresAuth: true }
      },
      {
        path: 'articles/create',
        name: 'AdminAddNewArticle',
        component: AdminAddNewArticle,
        meta: { requiresAuth: true }
      },
      {
        path: 'articles/:id/edit',
        name: 'AdminEditArticle',
        component: AdminEditArticle,
        props: true,
        meta: { requiresAuth: true }
      },
      {
        path: 'reports',
        name: 'AdminReports',
        component: AdminReports,
        meta: { requiresAuth: true } // Rute ini juga dilindungi
      }
    ]
  },
  // Catch-all 404 route - HARUS PALING AKHIR
  { 
    path: '/:pathMatch(.*)*', 
    name: 'NotFound', 
    component: NotFound 
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Global Navigation Guard
router.beforeEach((to, from, next) => {
  // Ini adalah placeholder untuk sistem otentikasi nyata (misal: memeriksa Vuex store atau cookie)
  const isAuthenticated = localStorage.getItem('authToken');

  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
    // Jika rute butuh login dan pengguna belum login, alihkan ke halaman login.
    next({ name: 'AdminLogin' });
  } else {
    // Jika tidak, lanjutkan.
    next();
  }
});

export default router;