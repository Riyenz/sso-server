<template>
  <div class="permissions">
    <div v-if="permissions.length > 0">
      <div class="card card-default">
        <div class="card-header d-flex">
          <h5 class="mb-0 flex-grow-1">Permissions</h5>
          <button class="btn btn-link" tabindex="-1" @click="showCreateModal">Create New Permission</button>
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
              <tr v-for="permission in permissions" :key="permission.id">
                <td>{{ permission.id }}</td>
                <td>{{ permission.name }}</td>
                <td>{{ permission.created_at | date }}</td>
                <td>
                  <button class="btn btn-link text-primary" @click="showEditModal(permission)">Edit</button>
                </td>
                <td>
                  <button class="btn btn-link text-danger" @click="deletePermission(permission.id)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-create-permission" tabindex="-1" permission="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Permission</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form permission="form" >
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Permission</label>
                <div class="col-md-9">
                  <input
                    id="create-permission-name"
                    type="text"
                    class="form-control"
                    placeholder="Permission Name"
                    @keyup.enter="submitCreate"
                    v-model="permissionName"
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

    <div class="modal fade" id="modal-edit-permission" tabindex="-1" permission="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Permission</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form permission="form" >
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Permission</label>
                <div class="col-md-9">
                  <input
                    id="edit-permission-name"
                    type="text"
                    class="form-control"
                    placeholder="Permission Name"
                    @keyup.enter="submitEdit"
                    v-model="selectedPermission.name"
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
        permissionName: '',
        selectedPermission: {},
      };
    },
    computed: {
      ...mapGetters([
        'permissions',
        'isLoading',
        'isLoaded',
      ])
    },
    methods: {
      ...mapActions([
        'requestPermissions',
        'createPermission',
        'deletePermission',
        'editPermission',
      ]),
      showCreateModal() {
        $("#modal-create-permission").modal("show");
      },
      submitCreate() {
        $("#modal-create-permission").modal("hide");
        this.createPermission(this.permissionName);
        this.permissionName = '';
      },
      showEditModal(permission) {
        this.selectedPermission = permission;
        $("#modal-edit-permission").modal("show");
      },
      submitEdit() {
        $("#modal-edit-permission").modal("hide");
        this.editPermission(this.selectedPermission);
      },
      prepareComponent() {
        if(this.permissions.length < 1) {
          this.requestPermissions();
        }

        $("#modal-create-permission").on("shown.bs.modal", () => {
          $("#create-permission-name").focus();
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
