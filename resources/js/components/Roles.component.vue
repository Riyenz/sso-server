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
                <th>Date Created</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="role in roles" :key="role.id">
                <td>{{ role.id }}</td>
                <td>{{ role.name }}</td>
                <td>{{ role.created_at | date }}</td>
                <td>
                  <button class="btn btn-link text-primary" @click="showEditModal(role)">Edit</button>
                </td>
                <td>
                  <button class="btn btn-link text-danger" @click="deleteRole(role.id)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-create-role" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" >
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Role</label>
                <div class="col-md-9">
                  <input
                    id="create-role-name"
                    type="text"
                    class="form-control"
                    placeholder="Role Name"
                    @keyup.enter="submitCreate"
                    v-model="roleName"
                  />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="submitCreate">Create</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-edit-role" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" >
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Role</label>
                <div class="col-md-9">
                  <input
                    id="edit-role-name"
                    type="text"
                    class="form-control"
                    placeholder="Role Name"
                    @keyup.enter="submitEdit"
                    v-model="selectedRole.name"
                  />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="submitEdit">Submit</button>
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
    mounted() {
      this.prepareComponent();
    },
    data() {
      return {
        roleName: '',
        selectedRole: {},
      };
    },
    computed: {
      ...mapGetters([
        'roles',
        'isLoading',
        'isLoaded',
      ])
    },
    methods: {
      ...mapActions([
        'requestRoles',
        'createRole',
        'deleteRole',
        'editRole',
      ]),
      showCreateModal() {
        $("#modal-create-role").modal("show");
      },
      submitCreate() {
        $("#modal-create-role").modal("hide");
        this.createRole(this.roleName);
        this.roleName = '';
      },
      showEditModal(role) {
        this.selectedRole = role;
        $("#modal-edit-role").modal("show");
      },
      submitEdit() {
        $("#modal-edit-role").modal("hide");
        this.editRole(this.selectedRole);
      },
      prepareComponent() {
        this.requestRoles();

        $("#modal-create-role").on("shown.bs.modal", () => {
          $("#create-role-name").focus();
        });
      }
    },
    filters: {
      date(date) {
        return moment(date).format('dddd, MMMM DD, YYYY')
      }
    }
  }
</script>
