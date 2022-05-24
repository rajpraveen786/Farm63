<template>
  <li class="w-100 searchli">
    <form
      id="searchform"
      action="/search"
      method="get"
      class="form-inline search-in my-2 pr-5 w-100 my-lg-0"
      autocomplete="off"
    >
      <input
        v-on:keyup="quicksearch"
        v-model="search"
        name="searchname"
        value=""
        class="w-100 pl-4 form-control"
        type="search"
        placeholder="Search for products"
        aria-label="Search"
      />
      <button class="btn my-2 my-sm-0" type="fsubmit">
        <i class="fas fa-search"></i>
      </button>
    </form>
    <div class="searchcont card shadow">
        <div v-if="datas.length > 0">
          <div class="searchresults "></div>
           <div class="p-3">
            <a :href="'/products/' + item.urlslug" class="" v-for="(item, index) in datas">
              <div class="row my-1">
                <div class="col-lg-1 col-md-2 col-2 p-0 pl-3">
                    <img
                     loading="lazy"
                    :src="'/' + item.image.loc"
                    :alt="item.name"
                    class="mx-auto"
                    style="width: 90%"
                    />
                </div>
                <div class="col-lg-8 col-md-6 col-6">
                    <!-- <h6 class="small text-muted mb-0 pb-0">Brand</h6> -->
                    <h5 class="font-prim fw-bold pt-0 my-0 ">{{ item.name }}</h5>

                </div>
                <div class="col-lg-3 col-md-4 col-4">
                    <div class="price my-0">
                        <span class="price-old d-inline mr-3" v-if="item.disp">Rs. {{ item.fpricebefdis }}</span>
                        <!-- <div class="badge badge-success" v-if="item.disp">{{ item.disp }} %</div> -->
                        <div class="font-weight-bold">Rs. {{ item.fpricewtas }}</div>
                    </div>
                </div>
              </div>
            </a>
          </div>
          <button
            v-on:click="submit"
            style="background-color: rgba(0, 61, 11, 0.7); color: white"
            class="text-center py-2 p-0 btn btn-block"
          >
            View More
          </button>
        </div>
        <div class="nosearch card shadow">
        <div class="p-3" v-if="datas.length == 0">
            <h6 v-if="datas.length == 0 && searchopt == 0" class="font-prim text-center">
            Please enter text to search
            </h6>
            <h6 v-if="datas.length == 0 && searchopt == 1" class="font-prim text-center">
            We couldn't find what you were looking for
            </h6>
        </div>
        <!-- <div style="background-color: rgba(0, 61, 11, 0.1)" class="p-3">
            <h6 class="font-prim">Explore popular Options</h6>
            <div class="row p-3">
                <div class="col-4">
                <ul class="navbar-nav" style="flex-direction: column">
                    <li class="nav-item">
                    <a class="">Vegetables</a>
                    </li>
                    <li class="nav-item">
                    <a class="">Vegetables</a>
                    </li>
                    <li class="nav-item">
                    <a class="">Vegetables</a>
                    </li>
                </ul>
                </div>
                <div class="col-4">
                <ul class="navbar-nav" style="flex-direction: column">
                    <li class="nav-item">
                    <a class="">Vegetables</a>
                    </li>
                    <li class="nav-item">
                    <a class="">Vegetables</a>
                    </li>
                    <li class="nav-item">
                    <a class="">Vegetables</a>
                    </li>
                </ul>
                </div>

                <div class="col-4">
                <ul class="navbar-nav" style="flex-direction: column">
                    <li class="nav-item">
                    <a class="">Vegetables</a>
                    </li>
                    <li class="nav-item">
                    <a class="">Vegetables</a>
                    </li>
                    <li class="nav-item">
                    <a class="">Vegetables</a>
                    </li>
                </ul>
                </div>
            </div>
            </div> -->
        </div>
    </div>
  </li>
</template>

<script>
export default {
  props: ["value", "user"],
  mounted() {
  },
  data() {
    return {
      search: this.value,
      searchopt: 0,
      datas: [],
    };
  },
  methods: {
    submit() {
      document.getElementById("searchform").submit();
    },
    quicksearch() {
      var self = this;
    //   if (this.search.length > 2) {
        this.searchopt = 1;
        axios
          .post("/quicksearch", {
            name: this.search,
          })
          .then((res) => {
            self.datas = res.data.data;
          })
          .catch((err) => {
            console.error(err);
          });
    //   } else {
    //   }
    },

    addtocart(pid) {
    //   if (this.user) {
        var self = this;
        axios
          .post("/cart/new", {
            // uid: this.user.id,
            pid: pid,
            qty: 1,
          })
          .then((res) => {
            Vue.swal({
              title: res.data.title,
              text: res.data.message,
              icon: res.data.success ? "success" : "error",
            });
            self.qty = 1;
          })
          .catch((err) => {
            console.error(err);
          });
    //   } else {
    //     Vue.swal.fire({
    //       icon: "error",
    //       title: "Login...",
    //       text: "Please Login to Proceed",
    //       footer: '<a href="/login" style="color:blue">Please click to Login?</a>',
    //     });
    //   }
    },
  },
};
</script>
