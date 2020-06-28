function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },
  { path: '/home', name: 'home', component: page('home.vue') },

  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:username', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  {
    path: '/profile/:username',
    component: page('profile/index.vue'),
    children: [
      { path: '', redirect: { name: 'profile.information' } },
      {
        path: 'information',
        name: 'profile.information',
        component: page('profile/info.vue')
      },
      {
        path: 'articles',
        name: 'profile.articles',
        component: page('profile/articles.vue')
      },
      {
        path: 'followers',
        name: 'profile.followers',
        component: page('profile/followers.vue')
      },
      {
        path: 'following',
        name: 'profile.following',
        component: page('profile/following.vue')
      },
      {
        path: 'settings',
        name: 'profile.settings',
        component: page('profile/settings.vue')
      },
    ]
  },

  {
    path: '/users',
    name: 'users',
    component: page('users/index.vue')
  },
  {
    path: '/subscriptions',
    name: 'subscriptions',
    component: page('users/subscriptions.vue')
  },

  {
    path: '/articles/bookmarked',
    name: 'articles.bookmarked',
    component: page('articles/bookmarked.vue')
  },
  {
    path: '/articles/history',
    name: 'articles.history',
    component: page('articles/history.vue')
  },
  { 
    path: '/articles/create',
    name: 'articles.create.index',
    component: page('articles/create/index.vue'),
  },
  {
    path: '/articles/create/content/:articleId',
    name: 'articles.create.content',
    component: page('articles/create/content.vue')
  },
  {
    path: '/articles/view/:articleId',
    name: 'articles.view',
    component: page('articles/view.vue')
  },

  
  { path: '*', component: page('errors/404.vue') }
]
