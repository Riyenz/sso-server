<template>
  <div class="roles">
    <div v-if="roles.length > 0">
      <div class="card card-default">
        <div class="card-header d-flex">
          <h5 class="mb-0 flex-grow-1">Roles</h5>
          <button class="btn btn-link" tabindex="-1" @click="showCreateModal">Create New Role</button>
        </div>

        <div class="card-body">
          <table class="table table-borderless mb-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Guard</th>
                <th>Date Created</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="(role, index) in roles" :key="index">
                <td>{{ role.id }}</td>
                <td>{{ role.name }}</td>
                <td>{{ role.guard_name }}</td>
                <td>{{ role.created_at | date }}</td>
                <td>
                  <button class="btn btn-link text-primary">Edit</button>
                </td>
                <td style="vertical-align: middle;">
                  <button class="btn btn-link text-danger">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-create-role" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Create</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';
  import * as moment from 'moment';

  export default {
    created() {
      this.requestRoles();
    },
    computed: {
      ...mapGetters([
        'roles',
        'isLoading',
        'isLoaded',
      ])
    },
    methods: {
      ...mapActions(['requestRoles']),
      showCreateModal() {
        $("#modal-create-role").modal("show");
      }
    },
    filters: {
      date(date) {
        return moment(date).format('dddd, MMMM DD, YYYY')
      }
    }
  }
</script>
