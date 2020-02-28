 <template>
  <div class="container">
    <div class="row mt-5" >
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Suppliers</h3>

            <div class="card-tools">
              <button class="btn btn-success" @click="newModal">
                Add Supplier
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
                <th>Name </th>
                <th>Registration date</th>
                <th>Actions</th>
               
                
               
               
                
              </tr>

              <tr v-for="supplier in suppliers.data" :key="supplier.id">
                <td>{{supplier.id}}</td>
                <td>{{supplier.name}}</td>
                
                <td>{{supplier.created_at|myDate}}</td>
                
               

                <td>
                  <a href="#" @click="editModal(supplier)">
                    <i class="fa fa-edit mr-2 blue"></i>
                  </a>
                  <a href="#" @click="deleteSupplier(supplier.id)">
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
            <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Add Supplier</h5>
            <h5 class="modal-title" v-show="editMode" id="addNewLabel">Update Supplier</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode? updateSupplier() :createSupplier()">
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
      suppliers: {},
      form: new Form({
        id: "",
        name: "",
       
      })
    };
  },
  methods: {
     createSupplier(){
                this.$Progress.start();
                this.form.post('api/suppliers')
               
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
        
      loadSuppliers(){
           // if(this.$gate.isAdminOrAuthor()){
               axios.get("api/suppliers").then(({ data }) => (this.suppliers = data));
            
      } , 
      newModal(){
        this.editMode=false;
          this.form.reset();
          $('#addNew').modal('show')
      },

        editModal(supplier){
          this.editMode=true
          this.form.reset();
          $('#addNew').modal('show');
          this.form.fill(supplier);
      },
     updateSupplier(){
       
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
                    this.form.put('api/supplier/'+this.form.id).then(()=>{
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
     deleteSupplier(id){
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
                                this.form.delete('api/supplier/'+id).then(()=>{
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
    this.loadSuppliers();
    //setInterval(()=>this.loadUsers(),6000);
    Fire.$on("afterCreate", () => {
      this.loadSuppliers();
   });
  },

  }


</script>
