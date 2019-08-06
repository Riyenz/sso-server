export default [
  {
    name: 'oauth',
    displayName: 'Oauth',
    path: '/',
    component: require('./pages/Oauth.page.vue').default,
  },
  {
    name: 'users',
    displayName: 'Users',
    path: '/user',
    component: require('./pages/Users.page.vue').default,
  },
  {
    name: 'roles-permissions',
    displayName: 'Roles & Permissions',
    path: '/roles-permissions',
    component: require('./pages/RolesPermissions.page.vue').default,
  }
]
