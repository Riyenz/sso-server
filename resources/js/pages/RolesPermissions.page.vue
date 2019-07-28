<template>
  <div class="roles-permissions">
    <roles class="mb-3"/>
    <permissions/>
  </div>
</template>

<script>
  import Roles from './../components/roles-permissions/Roles.component';
  import Permissions from './../components/roles-permissions/Permissions.component';
  
  export default {
    components: {
      Roles,
      Permissions,
    }
  }
</script>
