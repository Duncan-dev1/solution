 <template>
  <div class="container">
    <div class="row mt-5" >
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Orders</h3>

            <div class="card-tools">
              <button class="btn btn-success" @click="newModal">
                Create Order
                <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
              <tr>
                <th>ID </th>
                <th>Order Number</th>
               
                <th>Registration date</th> 
                <th>Actions</th>
               
                
              </tr>

              <tr v-for="order in orders.data" :key="order.id">
                <td>{{order.id}}</td>
                <td>{{order.order_number}}</td>
                
                <td>{{order.created_at|myDate}}</td>
                
               

                <td>
                  <a href="#" @click="editModal(order)">
                    <i class="fa fa-edit mr-2 blue"></i>
                  </a>
                  <a href="#" @click="deleteOrder(order.id)">
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
 <!-- <div v-if="!$gate.isAdmin()">
    <not-found></not-found>
  </div>
    MODAL-->
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
            <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Create Order</h5>
            <h5 class="modal-title" v-show="editMode" id="addNewLabel">Update Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode? updateOrder() :createOrder()">
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
      orders: {},
      form: new Form({
        id: "",
        order_number: "",
       
      })
    };
  },
  methods: {
     createOrder(){
                this.$Progress.start();
                this.form.post('api/orders')
               
                .then(()=>{
                    Fire.$emit('afterCreate');
                    $('#addNew').modal('hide')
                    Toast.fire({
                        type: 'success',
                        title: 'Order created successfully'
                        })
                    this.$Progress.finish();
                })
                .catch(()=>{
                  
                })              
            },  
        
      loadOrders(){
           // if(this.$gate.isAdminOrAuthor()){
               axios.get("api/orders").then(({ data }) => (this.orders = data));
            
      } , 
      newModal(){
        this.editMode=false;
          this.form.reset();
          $('#addNew').modal('show')
      },

        editModal(order){
          this.editMode=true
          this.form.reset();
          $('#addNew').modal('show');
          this.form.fill(order);
      },
     updateOrder(){
       
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
                    this.form.put('api/order/'+this.form.id).then(()=>{
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
       deleteOrder(id){
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
                                this.form.delete('api/order/'+id).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        )
                                    Fire.$emit('afterCreate');
                                }).catch(()=> {
                                    Swal.fire("Failed!", "There was something wrong.", "warning");
                                });
                         }
                    })
     }
  }, 
  created() {
    this.loadOrders();
    //setInterval(()=>this.loadUsers(),6000);
    Fire.$on("afterCreate", () => {
      this.loadOrders();
   });
  },

  }


</script>
