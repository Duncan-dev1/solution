 <template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isAdmin()">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Users Table</h3>

            <div class="card-tools">
              <button class="btn btn-success" @click="newModal">
                Add new
                <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Registration date</th>
                <th>Modify</th>
              </tr>

              <tr v-for="user in users.data" :key="user.id">
                <td>{{user.id}}</td>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>{{user.type|upText }}</td>
                <td>{{user.created_at|myDate}}</td>

                <td>
                  <a href="#" @click="editModal(user)">
                    <i class="fa fa-edit mr-2 blue"></i>
                  </a>
                  <a href="#" @click="deleteUser(user.id)">
                    <i class="fa fa-trash red"></i>
                  </a>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  <div v-if="!$gate.isAdmin()">
    <not-found></not-found>
  </div>
    <!--MODAL-->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Add New</h5>
            <h5 class="modal-title" v-show="editMode" id="addNewLabel">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode? updateUser() :createUser()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  placeholder="Name" 
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.email"
                  type="email"
                  name="email"
                  placeholder="Email"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <has-error :form="form" field="email"></has-error>
              </div>
              <!-- <div class="form-group">
        <input v-model="form.bio" type="text" name="bio" id="bio"
        placeholder="A little user bio"
           class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
           <has-error :form="bio" field="bio"></has-error>
              </div>-->

              <div class="form-group">
                <textarea
                  v-model="form.bio"
                  name="bio"
                  id="bio"
                  placeholder="Short bio for user (Optional)"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('bio') }"
                ></textarea>
                <has-error :form="form" field="bio"></has-error>
              </div>

              <div class="form-group">
                <select
                  name="type"
                  v-model="form.type"
                  id="type"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('type') }"
                >
                  <option value>Select User Role</option>
                  <option value="admin">Admin</option>
                  <option value="user">Standard User</option>
                  <option value="author">Author</option>
                  <option value="giraffe">Giraffe</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.password"
                  type="password"
                  name="password"
                  placeholder="Password"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                />
                <has-error :form="form" field="password"></has-error>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
              <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editMode:false,
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: ""
      })
    };
  },
  methods: {
     createUser(){
                this.$Progress.start();
                this.form.post('api/user')
               
                .then(()=>{
                    Fire.$emit('afterCreate');
                    $('#addNew').modal('hide')
                    Toast.fire({
                        type: 'success',
                        title: 'User added successfully'
                        })
                    this.$Progress.finish();
                })
                .catch(()=>{
                  
                })              
            },  
        
      loadUsers(){
            if(this.$gate.isAdminOrAuthor()){
               axios.get("api/user").then(({ data }) => (this.users = data));
            } 
      } , 
      newModal(){
        this.editMode=false;
          this.form.reset();
          $('#addNew').modal('show')
      },

        editModal(user){
          this.editMode=true
          this.form.reset();
          $('#addNew').modal('show');
          this.form.fill(user);
      },
     updateUser(){
       
           Swal.fire({
                   title: 'Are you sure you want to update?',
                   
                   
                   showCancelButton: true,
                   confirmButtonColor: 'green',
                   cancelButtonColor: 'gray',
                   confirmButtonText: 'Yes, update it!'
        })
          .then((result) => {
                        // Send request to the server
                         if (result.value) {
                                 this.$Progress.start();
                    this.form.put('api/user/'+this.form.id).then(()=>{
                         $('#addNew').modal('hide');
                                        Swal.fire(
                                        'Updated!',
                                        'User info has been Updated.',
                                        'success'
                                        )
                                     
                                    Fire.$emit('afterCreate');
                                }).catch(()=> {
                                    Swal.fire("Failed!", "There was something wrong.", "warning");
                                });
                         }
                    })
     
      },
     deleteUser(id){
                Swal.fire({
                   title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/user/'+id).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        )
                                    Fire.$emit('afterCreate');
                                }).catch(()=> {
                                    Swal.fire("Failed!", "There was something wronge.", "warning");
                                });
                         }
                    })
     }
  }, 
  created() {
    this.loadUsers();
    //setInterval(()=>this.loadUsers(),6000);
    Fire.$on("afterCreate", () => {
      this.loadUsers();
   });
  },

  }


</script>
