<template>
  <div>
    <nav aria-label="breadcrumb">
      <div class="float-right">
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
        <li class="breadcrumb-item"><a href="/admin/master">Master</a></li>
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
          Packing
        </li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-12">
        <div class="card shadow-custom px-3" style="border-radius: 8px">
          <h4 class="color-prim font-weight-bold pb-2 pt-3">Quick Filters</h4>
          <form action="" class="forms-">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input
                  type="text"
                  class="input-hov pl-5 form-control"
                  id="filname"
                  name="name"
                  v-model.trim="oldsear"
                  placeholder="Search By Name"
                  autocomplete="off"
                />
                <label for="filname">What are you looking for?</label>
                <button
                  type="submit"
                  class="btn position-absolute color-prim"
                  style="top: 0; left: 2%"
                >
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
            <div class="d-flex mb-2 justify-content-end">
              <a
                href="/admin/master/packing"
                class="btn btn-outline-dark mx-1"
              >
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
                  <th scope="col font-weight-bold" style="width:10%">#</th>
                  <th>Name</th>
                  <th style="width: 10%" class="text-center">Action</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(item, index) in datas" :key="index">
                  <th scope="row">{{ item.id }}</th>
                  <td>{{ item.name }}</td>
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
              <img loading="lazy" src="/storage/sorry.svg" alt="Sorry" class="w-25" />
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
              <span v-if="type == 0">New Packing</span>
              <span v-else-if="type == 1">Edit Packing</span>
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
                <label for="inputPacking4">Packing</label>
                <input
                  type="text"
                  class="input-hov form-control"
                  autocomplete="off"
                  name="name"
                  id="inputPacking4"
                  placeholder="Enter Packing"
                  v-model.trim="seldata"
                />
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
                New Packing
              </button></span
            >
            <span v-else-if="type == 1"
              ><button
                type="button"
                v-on:click="editdata"
                class="btn btn-primary"
              >
                Edit Packing
              </button></span
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["data", "oldsearch"],
  data() {
    return {
      datas: this.data.data,
      oldsear: this.oldsearch,
      type: 0,
      seldata: "",
      selid: "",
      selind: "",
    };
  },
  mounted() {
  },
  methods: {
    cleardata() {
      $("#exampleModalLong").modal("hide");
      this.seldata = "";
      this.selid = "";
      this.selind = "";
      this.type = 0;
    },
    newdata() {
      var self = this;
      if (this.seldata != "" && this.seldata.length > 0) {
        axios
          .post("/admin/master/packing/add", {
            name: this.seldata,
          })
          .then((res) => {
            self.datas.push(res.data.data);
            self.cleardata();
            Vue.swal({
              title: "Sucess.",
              text: "Packing added successfull.",
              icon: "success",
            });
          })
          .catch((err) => {
            console.error(err);
          });
      } else {
        alert("Please enter new Packing");
      }
    },
    editmodal(index) {
      this.type = 1;
      this.selind = index;
      this.seldata = this.datas[index].name;
      this.selid = this.datas[index].id;
      $("#exampleModalLong").modal({
        backdrop: "static",
        keyboard: false,
        show: true,
      });
    },
    editdata() {
      var self = this;
      if (this.seldata != "" && this.seldata.length > 0) {
        axios
          .post("/admin/master/packing/edit", {
            name: this.seldata,
            id: this.selid,
          })
          .then((res) => {
            self.datas[self.selind] = res.data.data;
            self.cleardata();
            Vue.swal({
              title: "Sucess.",
              text: "Packing edited successfull.",
              icon: "success",
            });
          })
          .catch((err) => {
            console.error(err);
          });
      } else {
        alert("Please enter Packing");
      }
    },
    deletedata(item, index) {
      var self = this;
      if (confirm("Are you sure do you want to delete?")) {
        axios
          .post("/admin/master/packing/delete", {
            id: item.id,
          })
          .then((res) => {
            self.datas.splice(index, 1);
            self.cleardata();
            Vue.swal({
              title: "Sucess.",
              text: "Packing deleted successfull.",
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
