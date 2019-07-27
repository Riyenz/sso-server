<template>
  <div class="oauth">
    <clients class="mb-3"></clients>
    <authorized-clients class="mb-3"></authorized-clients>
    <personal-access-tokens></personal-access-tokens>
  </div>
</template>

<script>
  import Clients from './../components/passport/Clients.vue';
  import AuthorizedClients from './../components/passport/AuthorizedClients.vue';
  import PersonalAccessTokens from './../components/passport/PersonalAccessTokens.vue';

  export default {
    components: {
      Clients,
      AuthorizedClients,
      PersonalAccessTokens,
    }
  }
</script>
