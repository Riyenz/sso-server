<template>
  <div class="roles-permissions">
    <roles class="mb-3"/>
    <permissions/>
  </div>
</template>

<script>
  import Roles from './../components/Roles.component';
  import Permissions from './../components/Permissions.component';
  
  export default {
    components: {
      Roles,
      Permissions,
    }
  }
</script>
