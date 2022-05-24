<template>
  <div>
    <div v-if="loading">
      <div class="row justify-content-center align-items-center">
        <div class="col-sm-12 col-md-6 mt-2 text-center">
          <div class="text-center">
            <div
              class="spinner-border"
              style="width: 6rem; height: 6rem"
              role="status"
            >
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="!loading" class="container">
      <div class="form-group">
        <label class="mb-0" for="inputdata">Name</label>
        <input
          type="text"
          name="name"
          class="form-control"
          v-model.trim="datas.name"
          id="inputdata"
          :class="[error.name ? 'is-invalid' : '']"
          aria-describedby="nameHelp"
        />
        <small id="nameHelp" v-if="error.name" class="form-text text-danger">{{
          error.name
        }}</small>
      </div>
      <div class="form-group">
        <label class="mb-0" for="inputdata">Phone Number</label>
        <input
          type="text"
          name="phno"
          class="form-control"
          v-model.trim="datas.phno"
          id="inputdata"
          :class="[error.phno ? 'is-invalid' : '']"
          aria-describedby="phnoHelp"
        />
        <small id="phnoHelp" v-if="error.phno" class="form-text text-danger">{{
          error.phno
        }}</small>
      </div>
      <div class="form-group">
        <label class="mb-0" for="inputdata">Pin Code</label>
        <div class="row">
          <div class="col-lg-10 col-9">
            <input
              type="text"
              name="pincode"
              class="form-control"
              v-model.trim="datas.pincode"
              id="inputdata"
              :class="[error.pincode ? 'is-invalid' : '']"
              aria-describedby="pincodeHelp"
            />
            <small>Please click the search button to autofill City, State and Country</small>
            <small
              id="pincodeHelp"
              v-if="error.pincode"
              class="form-text text-success"
              >{{ error.pincode }}</small
            >
          </div>
          <div class="col-lg-2 col-3">
            <button
              v-on:click="searchpincode"
              type="button"
              class="btn btn-block btn-outline-success"
            >
              <i class="fas fa-search" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
            <label class="mb-0" for="inputdata">Country</label>
            <input
            type="text"
            disabled
            class="form-control"
            v-model.trim="datas.country"
            id="inputdata"
            :class="[error.country ? 'is-invalid' : '']"
            aria-describedby="countryHelp"
            />
            <small
            id="countryHelp"
            v-if="error.country"
            class="form-text text-danger"
            >{{ error.country }}</small
            >
        </div>

        <div class="form-group col-md-5">
            <label class="mb-0" for="inputdata">State</label>
            <input
            type="text"
            disabled
            class="form-control"
            v-model.trim="datas.state"
            id="inputdata"
            :class="[error.state ? 'is-invalid' : '']"
            aria-describedby="stateHelp"
            />
            <small
            id="stateHelp"
            v-if="error.state"
            class="form-text text-danger"
            >{{ error.state }}</small
            >
        </div>

        <div class="form-group col-md-3">
            <label class="mb-0" for="inputdata">City</label>
            <input
            type="text"
            class="form-control"
            v-model.trim="datas.city"
            disabled
            id="inputdata"
            :class="[error.city ? 'is-invalid' : '']"
            aria-describedby="cityHelp"
            />
            <small id="cityHelp" v-if="error.city" class="form-text text-danger">{{
            error.city
            }}</small>
        </div>
      </div>


      <div class="form-group">
        <label class="mb-0" for="inputdata"
          >Flat, House no., Building, Company, Apartment</label
        >
        <input
          type="text"
          name="houseno"
          class="form-control"
          v-model.trim="datas.houseno"
          id="inputdata"
          :class="[error.houseno ? 'is-invalid' : '']"
          aria-describedby="housenoHelp"
        />
        <small
          id="housenoHelp"
          v-if="error.houseno"
          class="form-text text-danger"
          >{{ error.houseno }}</small
        >
      </div>
      <div class="form-group">
        <label class="mb-0" for="inputdata">Area, Street, Sector, Village</label>
        <input
          type="text"
          name="area"
          class="form-control"
          v-model.trim="datas.area"
          id="inputdata"
          :class="[error.area ? 'is-invalid' : '']"
          aria-describedby="areaHelp"
        />
        <small id="areaHelp" v-if="error.area" class="form-text text-danger">{{
          error.area
        }}</small>
      </div>
      <div class="form-group">
        <label class="mb-0" for="inputdata">Landmark</label>
        <input
          type="text"
          name="landmark"
          class="form-control"
          v-model.trim="datas.landmark"
          id="inputdata"
          :class="[error.landmark ? 'is-invalid' : '']"
          aria-describedby="landmarkHelp"
        />
        <small
          id="landmarkHelp"
          v-if="error.landmark"
          class="form-text text-danger"
          >{{ error.landmark }}</small
        >
      </div>
      <div class="form-group form-check">
        <input v-model="datas.default" type="checkbox" class="form-check-input" name="default" id="exampleCheck1" />
        <label class="form-check-label" for="exampleCheck1">Make Address Default</label>
      </div>
      <div class="form-group row mb-0">
        <div class="col-md-12">
          <button type="button" class="btn btn-block btn-login-custom" v-on:click="addnew">
            {{ submit }}
          </button>
        </div>
      </div>
      <input type="hidden" name="country" v-model="datas.country" />
      <input type="hidden" name="state" v-model="datas.state" />
      <input type="hidden" name="city" v-model="datas.city" />
      <input type="hidden" name="pid" v-model="datas.pid" />
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "oldpid",
    "oldname",
    "oldphno",
    "oldpincode",
    "oldcountry",
    "oldstate",
    "oldcity",
    "oldhouseno",
    "oldarea",
    "oldlandmark",
    "olddefault",
    "submit",
    "errorname",
    "errorphno",
    "errorpincode",
    "errorcountry",
    "errorstate",
    "errorcity",
    "errorhouseno",
    "errorarea",
    "errorlandmark",
  ],
  data() {
    return {
      error: {
        name: this.errorname || "",
        phno: this.errorphno || "",
        pincode: this.errorpincode || "",
        country: this.errorcountry || "",
        state: this.errorstate || "",
        city: this.errorcity || "",
        houseno: this.errorhouseno || "",
        area: this.errorarea || "",
        landmark: this.errorlandmark || "",
        default: this.errordefault || "",
      },
      datas: {
        pid: this.oldpid || "",
        name: this.oldname || "",
        phno: this.oldphno || "",
        pincode: this.oldpincode || "",
        country: this.oldcountry || "",
        state: this.oldstate || "",
        city: this.oldcity || "",
        houseno: this.oldhouseno || "",
        area: this.oldarea || "",
        landmark: this.oldlandmark || "",
        default: this.olddefault || "",
      },
      loading: 1,
      otp: "",
      countDown: 10,
    };
  },
  mounted() {
    this.loading = 0;
  },
  methods: {
    searchpincode() {
        this.datas.country=''
        this.datas.state=''
        this.datas.city=''
        this.datas.pid=''
      var self = this;
      if (this.datas.pincode.length > 0) {
        axios
          .post("/getarea", {
            pincode: this.datas.pincode,
          })
          .then((res) => {
            if (res.data.success) {
              self.datas.country = res.data.data.country;
              self.datas.state = res.data.data.state;
              self.datas.city = res.data.data.city;
              self.datas.pid = res.data.data.id;
            } else {
              Vue.swal({
                title: res.data.title,
                text: res.data.message,
                icon: "error",
              });
            }
          })
          .catch((err) => {
            console.error(err);
          });
      } else {
        Vue.swal({
          title: "Pincode Missing",
          text: "Please enter a valid pincode.",
          icon: "error",
        });
      }
    },
    addnew() {
      if (
        this.datas.name.length > 0 &&
        this.datas.phno.length > 0 &&
        this.datas.pincode.length > 0 &&
        this.datas.country.length > 0 &&
        this.datas.state.length > 0 &&
        this.datas.city.length > 0 &&
        this.datas.houseno.length > 0
      ) {
        document.getElementById("postdata").submit();
      } else {
        if (
          this.datas.country.length == 0 ||
          this.datas.area.length == 0 ||
          this.datas.state.length == 0 ||
          this.datas.city.length == 0
        ) {
          Vue.swal({
            title: "Fields",
            text: "Some Datas are missing.",
            icon: "error",
          });
        }
      }
    },
  },
};
</script>
