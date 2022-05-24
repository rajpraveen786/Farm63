<template>
    <div class="container-fluid">
        <span v-if="loading == 1">
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
    </span>
    <div v-else>
        <div class="card shadow px-3 mt-2" v-if="datas.length > 0">
            <div class="row card-header font-prim" style="background-color: #f7f5f5;">
                <span class="text-muted font-weight-bold">My wishlist : </span> <br>
                <span class="font-weight-bold ml-2"> {{ datas.length }} item </span> <br>
            </div>
            <div class="card-body">
                <div class="" v-for="(item, index) in datas">
                    <div class="row mt-3">
                        <div class="col-lg-1 col-md-2 col-2 p-0">
                            <a target="blank" :href="'/products/' + item.urlslug">
                                    <img loading="lazy" :src="'/' + item.image.loc" alt="" class="w-100" />
                                </a>
                        </div>
                        <div class="col-lg-5 col-md-4 col-10">
                            <h6 class="mb-2 font-weight-bold">
                                <a target="blank" :href="'/products/' + item.urlslug">{{
                                        item.name
                                        }}</a>
                            </h6>
                            <h6 class="mb-0">
                                Added On : <br> {{ item.wishlist.created_at | moment("Do, MMMM - YYYY") }}
                            </h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12 offset-2 offset-md-0">
                            <h6 class="mt-2 mb-0" v-if="item.brand">
                                <a target="blank" :href="'/brand/' + item.brand.name"><span class="size">Brand :</span>
                                        {{ item.brand.name }}</a
                                        ></h6
                                    >
                                    <h6 class="my-0">
                                        <a
                                        target="blank"
                                        :href="'/category/' + item.category.name"
                                        ><span class="size">Category :</span>
                                        {{ item.category.name }}</a
                                        ></h6
                                    >
                                    <h6 class="font-prim">
                                    <span :class="[item.disp?'text-success':'']" class="font-weight-bold">Rs. {{ item.fpricewtas }}</span>
                                    <span
                                    class=""
                                        v-if="item.disp"
                                        style="text-decoration: line-through"
                                        >&lpar; Rs. {{ item.fpricebefdis }} &rpar;</span
                                    >
                                    </h6>
                              </div>
                              <div class="col-lg-3 col-md-2 col-12">
                                  <div class="row">
                                      <div class="col-12 col-md-12">
                                        <button
                                        class="btn w-100 mt-2 btn-login-custom"
                                        type="button"
                                        v-on:click="addtocart(item)"
                                        >
                                        <i class="fas fa-shopping-basket"></i>
                                        <span class="small d-inline d-md-none d-lg-inline"> Add to Cart </span>
                                        </button>
                                      </div>
                                      <div class="col-12 col-md-12">
                                        <button
                                        class="btn w-100 mt-2 btn-login-custom"
                                        type="button"
                                        v-on:click="deletewishlist(index)"
                                        >
                                        <i class="fas fa-trash-alt"></i>
                                        <span class="small d-inline d-md-none d-lg-inline"> Remove </span>
                                        </button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <hr>
                          </div>
                        </div>
                      </div>
                      <div v-else class="text-center card p-3 shadow mt-5 h3">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-5">
                                <img loading="lazy" src="/storage/img/nodata.jpg" alt="" class="w-100 w-nodata mx-auto">
                            </div>
                            <div class="col-md-5">
                                <div style="font-size: 0.8em" class="font-prim ">
                                    <h5 class="text-center font-weight-bold">! Data Unavailable !</h5>
                                    We didnt find any products, Click <a href="/" class="btn-link">Here</a> to continune shopping
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2 justify-content-center">
            <button type="button" v-if="cp - 1 > 0 && cp - 1 <= lp" v-on:click="submitform(cp - 1)" class="btn col-3 mx-2 btn-outline-dark">
                        Previous
                      </button>
            <button type="button" v-if="cp + 1 <= lp" v-on:click="submitform(cp + 1)" class="btn col-3 mx-2 btn-outline-dark">
                        Next
                      </button>
        </div>
    </div>
</template>

<script>
import VueMoment from "vue-moment";
export default {
    props: ["data", "user", "data", "oldfilter", "oldsort"],
    components: {
        VueMoment,
    },
    created() {
        this.submitform();
    },
    data() {
        return {
            filter: "Unpurchased",
            sort: "Price (high to low)",
            datas: [],
            loading: 1,
            cp: 1,
            lp: 1,
        };
    },
    methods: {
        deletewishlist(index) {
            if (confirm("do you want to delete?")) {
                axios
                    .post("/profile/wishlist/delete", {
                        pid: this.datas[index].wishlist.id,
                    })
                    .then((res) => {
                        location.reload();
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            }
        },
        setfilter(code) {
            this.filter = code;
            this.submitform();
        },
        setsort(code) {
            this.sort = code;
            this.submitform();
        },
        submitform(val) {
            this.cp = val;
            var self = this;
            self.loading = 1;
            axios
                .post("/profile/wishlist/filter?page=" + this.cp, {
                    sort: this.sort,
                    filter: this.filter,
                })
                .then((res) => {
                    self.cp = res.data.current_page;
                    self.lp = res.data.last_page;
                    self.datas = res.data.data;
                })
                .then((res) => {
                    self.loading = 0;
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        addtocart(item) {
            //   if (this.user) {
            var self = this;
            axios
                .post("/cart/new", {
                    // // uid: this.user.id,
                    pid: item.id,
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
            //       footer:
            //         '<a href="/login" style="color:blue">Please click to Login?</a>',
            //     });
            //   }
            document.getElementById('cartcount').innerHTML = res.data.count ?? 0;
        },
    },
};
</script>
