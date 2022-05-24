<template>
  <div>
    <nav aria-label="breadcrumb">
      <div class="float-right">
        <a
          type="button"
          data-toggle="modal"
          data-backdrop="static"
          data-keyboard="false"
          data-target="#pincodeimport"
          class="btn btn-outline-custom mx-1"
        >
          <i class="fas fa-file-import fa-fw"></i>Import</a
        >
        <a
          type="button"
          data-toggle="modal"
          data-backdrop="static"
          data-keyboard="false"
          data-target="#exampleModalLong"
          class="btn btn-outline-custom"
        >
          <i class="fa fa-plus" aria-hidden="true"></i> Add</a
        >
      </div>
      <ol class="breadcrumb" style="background-color: transparent">
        <li class="breadcrumb-item">
          <a href="/admin"><i class="fa-lg fas fa-home"></i> </a>
        </li>
        <li
          class="breadcrumb-item active"
          aria-current="page"
          style="
            color: #2e5090;
            font-weight: bold;
            text-transform: uppercase;
            font-family: Arial, Helvetica, sans-serif;
          "
        >
          Pincode
        </li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-12">
        <div class="card shadow-custom px-3" style="border-radius: 8px">
          <h4 class="color-prim font-weight-bold pb-2 pt-3">Quick Filters</h4>
          <form action="" class="forms-">
            <div class="form-row">
              <div class="form-group col-md-4 col-sm-12 mt-2">
                <input
                  type="text"
                  class="input-hov form-control"
                  id="filcountry"
                  name="country"
                  v-model.trim="country"
                  placeholder="Search By Country"
                  autocomplete="off"
                />
                <label for="filcountry">Search by Country</label>
              </div>
              <div class="form-group col-md-4 col-sm-12 mt-2">
                <input
                  type="text"
                  class="input-hov form-control"
                  id="filstate"
                  name="state"
                  v-model.trim="state"
                  placeholder="Search By State"
                  autocomplete="off"
                />
                <label for="filState">Search by State</label>
              </div>
              <div class="form-group col-md-4 col-sm-12 mt-2">
                <input
                  type="text"
                  class="input-hov form-control"
                  id="filcity"
                  name="city"
                  v-model.trim="city"
                  placeholder="Search By City"
                  autocomplete="off"
                />
                <label for="filcity">Search by City</label>
              </div>
              <div class="form-group col-md-4 col-sm-12 mt-2">
                <input
                  type="text"
                  class="input-hov form-control"
                  id="filpincode"
                  name="pincode"
                  v-model.trim="pincode"
                  placeholder="Search By Pincode"
                  autocomplete="off"
                />
                <label for="filpincode">Search by Pincode</label>
              </div>

              <div class="form-group mt-2 col-md-4">
                <div class="form-group">
                  <label for="linkt">Store</label>
                  <select
                    v-model="storereq"
                    name="store"
                    class="form-control"
                    id="linkt"
                  >
                    <option value="0">Select Store</option>
                    <option v-for="item,index in store" :value="item.id">{{ item.name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group mt-2 col-md-4">
                <div class="form-group">
                  <label for="linkt">Status</label>
                  <select
                    v-model="status"
                    name="status"
                    class="form-control"
                    id="linkt"
                  >
                    <option value="-1">Select Status</option>
                    <option value="0">Draft</option>
                    <option value="1">Active</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="d-flex mb-2 justify-content-end">
              <a href="/admin/pincode" class="btn btn-outline-dark mx-1">
                <i class="fa fa-search-minus" aria-hidden="true"></i> Clear</a
              >
              <button type="submit" class="btn btn-outline-custom">
                <i class="fa fa-filter" aria-hidden="true"></i>
                Filter
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-12 mt-3">
        <div class="card shadow-custom pt-3" style="border-radius: 8px">
          <div class="card-body">
            <h4 class="color-prim font-weight-bold pb-2">List View</h4>
            <table
              v-if="datas.length > 0"
              class="table table-list table-responsive-sm"
            >
              <thead>
                <tr
                  style="
                    text-transform: uppercase;
                    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold',
                      sans-serif;
                  "
                >
                  <th scope="col font-weight-bold" style="width: 5%">#</th>
                  <th class="text-right">Store</th>
                  <th class="text-right">Country</th>
                  <th class="text-right">State</th>
                  <th class="text-right">City</th>
                  <th class="text-right">Pincode</th>
                  <th class="text-right">Delivery Cost</th>
                  <th class="text-right">Delivery Days</th>
                  <th class="text-right">Status</th>
                  <th style="width: 10%" class="text-center">Action</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(item, index) in datas" :key="index">
                  <th scope="row">{{ item.id }}</th>
                  <td class="text-right">{{ item.storedata?item.storedata.name:'' }}</td>
                  <td class="text-right">{{ item.country }}</td>
                  <td class="text-right">{{ item.state }}</td>
                  <td class="text-right">{{ item.city }}</td>
                  <td class="text-right">{{ item.pincode }}</td>
                  <td class="text-right">
                    <i class="fas fa-rupee-sign"></i> {{ item.cost }}
                  </td>
                  <td class="text-right">{{ item.deldays }}</td>
                  <td class="text-right">
                    <span v-if="item.status"> Active </span>
                    <span v-else-if="!item.status"> Draft </span>
                  </td>
                  <td
                    class="text-center d-flex flex-row justify-content-around"
                  >
                    <a v-on:click="editmodal(index)" class="btn">
                      <i
                        class="fa fa-edit"
                        style="color: rgba(0, 0, 0, 0.6)"
                        aria-hidden="true"
                      ></i>
                    </a>
                    <a v-on:click="deletedata(item, index)" class="btn">
                      <i
                        class="fa fa-trash"
                        style="color: rgba(0, 0, 0, 0.6)"
                        aria-hidden="true"
                      ></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
            <div v-else class="container text-center">
              <img loading="lazy" src="/storage/sorry.svg" alt="" class="w-25" />
              <h5>Sorry No data Found</h5>
            </div>
          </div>
          <hr />
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="exampleModalLong"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLongTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              <span v-if="type == 0">New Pincode</span>
              <span v-else-if="type == 1">Edit Pincode</span>
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              v-on:click="cleardata"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-row my-2">
              <div class="form-group mt-2 col-md-6">
                <label for="inputCountry4">Country</label>
                <input
                  type="text"
                  class="input-hov form-control"
                  autocomplete="off"
                  name="country"
                  id="inputcountry4"
                  placeholder="Enter Country"
                  v-model.trim="datax.country"
                />
                <span v-if="errors.country" class="text-danger">
                  {{ errors.country[0] }}
                </span>
              </div>
              <div class="form-group mt-2 col-md-6">
                <label for="inputstate4">State</label>
                <input
                  type="text"
                  class="input-hov form-control"
                  autocomplete="off"
                  name="state"
                  id="inputstate4"
                  placeholder="Enter state"
                  v-model.trim="datax.state"
                />
                <span v-if="errors.state" class="text-danger">
                  {{ errors.state[0] }}
                </span>
              </div>
              <div class="form-group mt-2 col-md-6">
                <label for="inputcity4">City</label>
                <input
                  type="text"
                  class="input-hov form-control"
                  autocomplete="off"
                  name="city"
                  id="inputcity4"
                  placeholder="Enter City"
                  v-model.trim="datax.city"
                />
                <span v-if="errors.city" class="text-danger">
                  {{ errors.city[0] }}
                </span>
              </div>
              <div class="form-group mt-2 col-md-6">
                <label for="inputpincode4">Pincode</label>
                <input
                  type="text"
                  class="input-hov form-control"
                  autocomplete="off"
                  name="pincode"
                  id="inputpincode4"
                  placeholder="Enter Pincode"
                  v-model.trim="datax.pincode"
                />
                <span v-if="errors.pincode" class="text-danger">
                  {{ errors.pincode[0] }}
                </span>
              </div>
              <div class="form-group mt-2 col-md-6">
                <label for="inputcost4">Delivery Cost (Rs)</label>
                <input
                  type="text"
                  class="input-hov form-control"
                  autocomplete="off"
                  name="cost"
                  id="inputcost4"
                  placeholder="Enter Cost"
                  v-model.trim="datax.cost"
                />
                <span v-if="errors.cost" class="text-danger">
                  {{ errors.cost[0] }}
                </span>
              </div>
              <div class="form-group mt-2 col-md-6">
                <label for="inputdeldays4">Delivery Days</label>
                <input
                  type="text"
                  class="input-hov form-control"
                  autocomplete="off"
                  name="deldays"
                  id="inputdeldays4"
                  placeholder="Enter Delivery Days"
                  v-model.trim="datax.deldays"
                />
                <span v-if="errors.deldays" class="text-danger">
                  {{ errors.deldays[0] }}
                </span>
              </div>
              <div class="form-group mt-2 col-md-6">
                <div class="form-group">
                  <label for="linkt">Store</label>
                  <select
                    v-model="datax.store"
                    class="form-control"
                    id="linkt"
                  >
                    <option value="0">None</option>
                    <option v-for="item,index in store" :value="item.id">{{ item.name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group mt-2 col-md-6">
                <div class="form-group">
                  <label for="linkt">Status</label>
                  <select
                    v-model="datax.status"
                    class="form-control"
                    id="linkt"
                  >
                    <option value="0">Draft</option>
                    <option value="1">Active</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              v-on:click="cleardata"
            >
              Close
            </button>
            <span v-if="type == 0"
              ><button
                type="button"
                v-on:click="newdata"
                class="btn btn-primary"
              >
                New Pincode
              </button></span
            >
            <span v-else-if="type == 1"
              ><button
                type="button"
                v-on:click="editdata"
                class="btn btn-primary"
              >
                Edit Pincode
              </button></span
            >
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="pincodeimport"
      tabindex="-1"
      role="dialog"
      aria-labelledby="pincodeimport"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Pincode</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <a
              href="/storage/Templates/Pincode.xlsx"
              download
              class="btn btn-outline-dark float-right"
            >
              <i class="fa fa-download" aria-hidden="true"></i
            ></a>
            <form
              action="/admin/pincode/import"
              method="post"
              enctype="multipart/form-data"
            >

        <input type="hidden" name="_token" v-bind:value="csrf">
              <div class="row justify-content-center">
                <div class="col-8">
                  <div class="form-group">
                    <label for="">File</label>
                    <input
                      type="file"
                      class="form-control-file"
                      name="file"
                      id=""
                      placeholder=""
                      aria-describedby="fileHelpId"
                    />
                    <small id="fileHelpId" class="form-text text-muted"
                      >Please Import the Exported file CSV file</small
                    >
                  </div>
                </div>
              </div>
              <input
                type="submit"
                class="btn btn-outline-primary float-right"
                value="Import"
              />

              <table class="table mt-2">
                  <thead>
                      <tr>
                          <th>Title</th>
                          <th>Description</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <th>Country</th>
                          <td>Please enter the Country and it should be uniform</td>
                      </tr>
                      <tr>
                          <th>State</th>
                          <td>Please enter the State and it should be uniform</td>
                      </tr>
                      <tr>
                          <th>City</th>
                          <td>Please enter the City and it should be uniform</td>
                      </tr>
                      <tr>
                          <th>Pincode</th>
                          <td>Please enter the Pincode and it must be unique, else Error might appear</td>
                      </tr>
                      <tr>
                          <th>Status</th>
                          <td>Status must be either Active or Draft</td>
                      </tr>
                      <tr>
                          <th>Cost</th>
                          <td>Cost for the delivery Service</td>
                      </tr>
                      <tr>
                          <th>Days</th>
                          <td>No of days to deliver the delivery</td>
                      </tr>
                  </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "data",
    "oldcity",
    "oldpincode",
    "oldstate",
    "oldcountry",
    "oldstore",
    "oldstatus",
    "store",
  ],
  data() {
    return {csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      datas: this.data.data,
      city: this.oldcity,
      pincode: this.oldpincode,
      state: this.oldstate,
      country: this.oldcountry,
      storereq: this.oldstore??0,
      status: this.oldstatus ? this.oldstatus : -1,
      datax: {
        city: "",
        state: "",
        pincode: "",
        country: "",
        cost: "",
        store: 0    ,
        deldays: "",
        status: 1,
      },
      errors: {},
      errorstemp: {
        city: "",
        state: "",
        pincode: "",
        country: "",
        cost: "",
        deldays: "",
        status: 1,
      },
      type: 0,
      seldata: "",
      selid: "",
      selind: "",
    };
  },
  mounted() {
    (this.errors = this), this.errorstemp;
  },
  methods: {
    cleardata() {
      $("#exampleModalLong").modal("hide");
      this.datax.country = "";
      this.datax.state = "";
      this.datax.city = "";
      this.datax.pincode = "";
      this.datax.status = 0;
      this.datax.cost = "";
      this.datax.deldays = 0;
      this.datax.store = 0;
      this.selid = "";
      this.selind = "";
      this.type = 0;
      this.errors = this.errorstemp;
    },
    newdata() {
      var self = this;
      this.errors = this.errorstemp;
      axios
        .post("/admin/pincode/add", {
          city: this.datax.city,
          state: this.datax.state,
          pincode: this.datax.pincode,
          status: this.datax.status,
          country: this.datax.country,
          store: this.datax.store,
          cost: this.datax.cost,
          deldays: this.datax.deldays,
        })
        .then((res) => {
          if (res.data.errorstat) {
            this.errors = res.data.errors;
          } else {
            self.datas.push(res.data.data);
            self.cleardata();
            Vue.swal({
              title: "Sucess.",
              text: "Pin Code added successfull.",
              icon: "success",
            });
          }
        })
        .catch((err) => {
          console.error(err);
        });
    },
    editmodal(index) {
      this.errors = this.errorstemp;
      this.type = 1;
      this.selind = index;
      this.datax.country = this.datas[index].country;
      this.datax.state = this.datas[index].state;
      this.datax.city = this.datas[index].city;
      this.datax.pincode = this.datas[index].pincode;
      this.datax.status = this.datas[index].status;
      this.datax.cost = this.datas[index].cost;
      this.datax.deldays = this.datas[index].deldays;
      this.datax.store = this.datas[index].store;

      this.selid = this.datas[index].id;
      $("#exampleModalLong").modal({
        backdrop: "static",
        keyboard: false,
        show: true,
      });
    },
    editdata() {
      var self = this;
      axios
        .post("/admin/pincode/edit", {
          city: this.datax.city,
          state: this.datax.state,
          pincode: this.datax.pincode,
          status: this.datax.status,
          country: this.datax.country,
          cost: this.datax.cost,
          deldays: this.datax.deldays,
          store: this.datax.store,
          id: this.selid,
        })
        .then((res) => {
          if (res.data.errorstat) {
            this.errors = res.data.errors;
          } else {
            self.datas[self.selind] = res.data.data;
            self.cleardata();
            Vue.swal({
              title: "Sucess.",
              text: "Pin Code edited successfull.",
              icon: "success",
            });
          }
        })
        .catch((err) => {
          console.error(err);
        });
    },
    deletedata(item, index) {
      var self = this;
      if (confirm("Are you sure do you want to delete?")) {
        axios
          .post("/admin/pincode/delete", {
            id: item.id,
          })
          .then((res) => {
            self.datas.splice(index, 1);
            self.cleardata();
            Vue.swal({
              title: "Sucess.",
              text: "UOM deleted successfull.",
              icon: "success",
            });
          })
          .catch((err) => {
            console.error(err);
          });
      }
    },
  },
};
</script>
