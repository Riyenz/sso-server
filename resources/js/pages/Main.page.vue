<template>
  <div class="oauth">
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item" v-for="(route, index) in routes" :key="index">
        <router-link
          :to="route.path"
          class="nav-link"
          active-class="active"
          exact
          >
          {{ route.displayName }}
        </router-link>
      </li>
    </ul>
    <router-view/>
  </div>
</template>

<script>
  import Routes from './../routes';
  export default {
    data() {
      return {
        routes: Routes
      };
    },
  }
</script>
