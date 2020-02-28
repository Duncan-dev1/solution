 <template>
  <div class="container">
    <div class="row mt-5" >
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Products</h3>

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
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
               
                <th>Addition date</th> 
                <th>Actions</th>
               
                
              </tr>

              <tr v-for="product in products.data" :key="product.id">
                <td>{{product.id}}</td>
                <td>{{product.name}}</td>
                <td>{{product.description}}</td>
                <td>{{product.quantity}}</td>
                
                <td>{{product.created_at|myDate}}</td>
                
               

                <td>
                  <a href="#" @click="editModal(product)">
                    <i class="fa fa-edit mr-2 blue"></i>
                  </a>
                  <a href="#" @click="deleteOrder(product.id)">
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
            <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Add Product</h5>
            <h5 class="modal-title" v-show="editMode" id="addNewLabel">Update Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode? updateProduct() :createProduct()">
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
                <textarea
                  v-model="form.description"
                  name="description"
                  id="description"
                  placeholder="Short Product description  (Optional)"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('description') }"
                ></textarea>
                <has-error :form="form" field="description"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.quantity"
                  type="text"
                  name="quantity"
                  placeholder="Quantity"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('quantity') }"
                />
                <has-error :form="form" field="quantity"></has-error>
              </div>
              <!-- <div class="form-group">
        <input v-model="form.bio" type="text" name="bio" id="bio"
        placeholder="A little user bio"
           class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
           <has-error :form="bio" field="bio"></has-error>
              </div>-->

            


             
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
      products: {},
      form: new Form({
        id: "",
        name:"",
        quantity: "",
        description:""
      })
    };
  },
  methods: {
     createProduct(){
                this.$Progress.start();
                this.form.post('api/products')
               
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
        
      loadProducts(){
           // if(this.$gate.isAdminOrAuthor()){
               axios.get("api/products").then(({ data }) => (this.products = data));
            
      } , 
      newModal(){
        this.editMode=false;
          this.form.reset();
          $('#addNew').modal('show')
      },

        editModal(product){
          this.editMode=true
          this.form.reset();
          $('#addNew').modal('show');
          this.form.fill(product);
      },
     updateProduct(){
       
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
                    this.form.put('api/product/'+this.form.id).then(()=>{
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
     deleteProduct(id){
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
                                this.form.delete('api/product/'+id).then(()=>{
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
    this.loadProducts();
    //setInterval(()=>this.loadUsers(),6000);
    Fire.$on("afterCreate", () => {
      this.loadProducts();
   });
  },

  }


</script>
