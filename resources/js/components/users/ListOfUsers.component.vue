<template>
  <div class="users">
    <div v-if="users.length > 0">
      <div class="card card-default">
        <div class="card-header d-flex">
          <h5 class="mb-0 flex-grow-1">Users</h5>
          <button class="btn btn-link" tabindex="-1" @click="showCreateModal">Create New User</button>
        </div>

        <div class="card-body">
          <table class="table table-borderless mb-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Created</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.created_at | date }}</td>
                <td>
                  <button class="btn btn-link text-primary" @click="showEditModal(user)">Edit</button>
                </td>
                <td>
                  <button class="btn btn-link text-danger" @click="deleteUser(user.id)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-create-user" tabindex="-1" user="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form user="form" >
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Username</label>
                <div class="col-md-9">
                  <input
                    id="create-user-name"
                    type="text"
                    class="form-control"
                    placeholder="User Name"
                    @keyup.enter="submitCreate"
                    v-model="user.name"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Email</label>
                <div class="col-md-9">
                  <input
                    type="email"
                    class="form-control"
                    placeholder="Email"
                    @keyup.enter="submitCreate"
                    v-model="user.email"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Password</label>
                <div class="col-md-9">
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    @keyup.enter="submitCreate"
                    v-model="user.password"
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

    <div class="modal fade" id="modal-edit-user" tabindex="-1" user="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form user="form">
              <div class="form-group row">
                <label class="col-md-3 col-form-label">User</label>
                <div class="col-md-9">
                  <input
                    id="edit-user-name"
                    type="text"
                    class="form-control"
                    placeholder="User Name"
                    @keyup.enter="submitEdit"
                    v-model="selectedUser.name"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Email</label>
                <div class="col-md-9">
                  <input
                    type="email"
                    class="form-control"
                    placeholder="Email"
                    @keyup.enter="submitEdit"
                    v-model="selectedUser.email"
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
        user: {
          name: '',
          email: '',          
          password: '',
        },
        selectedUser: {},
      };
    },
    computed: {
      ...mapGetters([
        'users',
        'isLoading',
        'isLoaded',
      ])
    },
    methods: {
      ...mapActions([
        'requestUsers',
        'createUser',
        'deleteUser',
        'editUser',
      ]),
      showCreateModal() {
        $("#modal-create-user").modal("show");
      },
      submitCreate() {
        $("#modal-create-user").modal("hide");
        this.createUser(this.user);
        this.user = {
          name: '',
          email: '',          
          password: '',
        };
      },
      showEditModal(user) {
        this.selectedUser = user;
        $("#modal-edit-user").modal("show");
      },
      submitEdit() {
        $("#modal-edit-user").modal("hide");
        this.editUser(this.selectedUser);
      },
      prepareComponent() {
        if (this.users.length < 1) {
          this.requestUsers();
        }
 
        $("#modal-create-user").on("shown.bs.modal", () => {
          $("#create-user-name").focus();
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
