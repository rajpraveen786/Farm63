<template>
    <div id="">
        <div class="container-fluid">
            <div class="row position-relative">
                <div class="col-lg-3 col-sm-12 menu-inlg py-2">
                    <div class="expand-menu">
                        <button class="btn btn-success d-lg-none font-prim font-weight-bold" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-filter mr-2"></i>Filter
                  </button>
                        <div class="collapse menu-collapse" id="navbarTogglerDemo03">
                            <div class="mt-2 p-3 card">
                                <div>
                                    <h6 class="font-prim font-weight-bold mt-3">Categories</h6>
                                    <div v-if="category.length > 0">
                                        <div class="check-custom form-check" v-for="(item, index) in category" :key="'categorylist' + index">
                                            <label class="form-check-label">
                              <input
                                class="form-check-input"
                                :id="'checkcategory' + index"
                                value="1"
                                type="checkbox"
                                v-model="catselect[index]"
                                v-on:click="setcategory(item.id)"
                              />
                              {{ item.name }}
                            </label>
                                            <div class="check-custom form-check" v-for="(itemsub, index2) in item.subcategory" :key="'subcategorylist' + index">
                                                <label class="form-check-label">
                                <input
                                  class="form-check-input"
                                  :id="'checksubcategory' + index"
                                  value="1"
                                  type="checkbox"
                                  v-model="subcatselect[index]"
                                  v-on:click="setsubcategory(itemsub.id)"
                                />
                                {{ itemsub.name }}
                              </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else class="mt-1">Sorry No Categories found</div>
                                </div>
                                <!-- <div v-if="brand.length > 0">
                        <h6 class="font-prim font-weight-bold mt-3">Brand</h6>
                        <div >
                          <div
                            class="check-custom form-check"
                            v-for="(item, index) in brand"
                            :key="'brandlist' + index"
                          >
                            <label class="form-check-label">
                              <input
                                class="form-check-input"
                                :id="'checkbrand' + index"
                                value="1"
                                type="checkbox"
                                v-model="brandselect[index]"
                                v-on:click="setbrand(item.id)"
                              />
                              {{ item.name }}
                            </label>
                            <label for=""></label>
                          </div>
                        </div>
                      </div> -->
                                <div>
                                    <div class="float-right h6">
                                        <button type="button" class="btn text-small text-muted" v-on:click="pricefilter(-1)">
                            Clear
                          </button>
                                    </div>
                                    <h6 class="font-prim font-weight-bold mt-3">Filter by Price</h6>
                                    <div>
                                        <ul class="all-price navbar-nav">
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  v-on:click="pricefilter(1)"
                                  v-model="pricerange"
                                  value="1"
                                />
                                <span class="ml-2"> Below Rs 100</span>
                              </label>
                                            </li>
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  v-on:click="pricefilter(2)"
                                  v-model="pricerange"
                                  value="2"
                                />
                                <span class="ml-2"> Rs 100 - Rs 300</span>
                              </label>
                                            </li>
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  v-on:click="pricefilter(3)"
                                  v-model="pricerange"
                                  value="3"
                                />
                                <span class="ml-2"> Rs 300 - Rs 500</span>
                              </label>
                                            </li>
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  v-on:click="pricefilter(4)"
                                  v-model="pricerange"
                                  value="4"
                                />
                                <span class="ml-2"> Rs 500 - Rs 1000</span>
                              </label>
                                            </li>
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  v-on:click="pricefilter(5)"
                                  v-model="pricerange"
                                  value="5"
                                />
                                <span class="ml-2"> Above Rs 1000</span>
                              </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <div class="float-right h6">
                                        <button type="button" class="btn text-small text-muted" v-on:click="discountfilter(-1)">
                            Clear
                          </button>
                                    </div>
                                    <h6 class="font-prim font-weight-bold mt-3">Filter by Discount</h6>
                                    <div>
                                        <ul class="all-price navbar-nav">
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  v-on:click="discountfilter(1)"
                                  v-model="discountrange"
                                  value="1"
                                />
                                <span class="ml-2"> Upto 5%</span>
                              </label>
                                            </li>
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  v-on:click="discountfilter(2)"
                                  v-model="discountrange"
                                  value="2"
                                />
                                <span class="ml-2"> 5% to 10%</span>
                              </label>
                                            </li>
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  if
                                  v-on:click="discountfilter(3)"
                                  v-model="discountrange"
                                  value="3"
                                />
                                <span class="ml-2"> 10% to 15%</span>
                              </label>
                                            </li>
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  v-on:click="discountfilter(4)"
                                  v-model="discountrange"
                                  value="4"
                                />
                                <span class="ml-2"> 15% to 25%</span>
                              </label>
                                            </li>
                                            <li class="radio-custom f-price">
                                                <label class="m-0">
                                <input
                                  type="radio"
                                  class=""
                                  v-on:click="discountfilter(5)"
                                  v-model="discountrange"
                                  value="5"
                                />
                                <span class="ml-2"> More than 25%</span>
                              </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <h6 class="font-prim font-weight-bold mt-3">New Arrivals</h6>
                                        <div class="radio-custom form-check">
                                            <label class="form-check-label" for="last30days">
                              <input
                                class="form-check-input"
                                id="last30days"
                                value="1"
                                type="radio"
                                name="newarrival"
                                v-on:click="newarrivalfun(1)"
                                v-model="newarrival"
                              />
                              Last 30 days
                            </label>
                                        </div>
                                        <div class="radio-custom form-check">
                                            <label class="form-check-label" for="last60days">
                              <input
                                class="form-check-input"
                                id="last60days"
                                value="2"
                                type="radio"
                                name="newarrival"
                                v-on:click="newarrivalfun(2)"
                                v-model="newarrival"
                              />
                              Last 60 days
                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12 pt-3">
                    <div class="float-md-right">
                        <select v-model="orderbyid" @change="changeordby" class="btn form-select font-weight-bold btn-success my-3 form-select-sm" aria-label=".form-select-sm example">
                    <option value="0" selected>Alphabetically, A-Z</option>
                    <option value="1" selected>Alphabetically, Z-A</option>
                    <option value="2" selected>Price, low to high</option>
                    <option value="3" selected>Price, high to low</option>
                  </select>
                    </div>
                    <ol class="breadcrumb breadcrumb-bar" style="background-color: rgba(255, 255, 255, 0.7)">
                        <li class="breadcrumb-item d-inline"><a class='text-dark' href="/">Home </a></li>
                        <li class="breadcrumb-item d-inline"><a class='text-dark' style="pointer-events: none" href="">Search  </a></li>
                        <li class="breadcrumb-item d-inline active" aria-current="page" style="color: var(--prim); font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                            <h6 class="d-inline font-prim font-weight-bold"> {{searchname}}</h6>
                        </li>
                    </ol>
                    <hr>
                    <div v-if="loading">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-6 col-md-6 mt-2 text-center">
                                <div class="text-center">
                                    <div class="spinner-border" style="width: 6rem; height: 6rem" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="searchlistdata" v-else>
                        <div v-if="datas.length >0" class="row bg-bluee py-2">
                            <div class="col-md-3 px-2 col-12 my-2" v-for="(itemx, index) in datas" :key="index + 'savelaterlist'">
                                <msproductgen :data="itemx" :user="user"></msproductgen>
                            </div>
                        </div>
                        <div v-else class="text-center mt-3 h3">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-6 col-10">
                                    <div class="card mt-3 shadow p-4">
                                        <img loading="lazy" src="/storage/img/sorry.svg" alt="" class="w-nodata w-75 mx-auto" />
                                        <div style="font-size: 0.75em" class="font-prim mt-3 font-weight-bold">
                                            We couldn't find your product, Click <a href="/" class="btn-link">Here</a> to continue shopping from our other products
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div v-if="datas.length >0" class="my-4">
                        <button type="button" v-if="page - 1 > 0" v-on:click="changepage(page - 1)" class="btn col-3 mx-2" >
                            <i class="far mr-3 fa-arrow-alt-circle-left"></i> Previous
                        </button>
                        <button type="button" v-if="page + 1 <= lastpage" v-on:click="changepage(page + 1)" class="btn col-3 mx-2 ml-auto" style="float: right">
                             Next <i class="far ml-3 fa-arrow-alt-circle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        components: {},
        props: ["category", "brand", "searchdata", "user", "searchname"],
        data() {
            return {
                navpages: 1,
                value: [20, 40],
                datas: this.searchdata.data,
                brandselect: [],
                brandselectvalue: [],
                catselect: [],
                subcatselect: [],
                catselectvalue: [],
                subcatselectvalue: [],
                pricerange: -1,
                discountrange: -1,
                todaydeal: 0,
                availabilityous: 0,
                newarrival: -1,
                page: this.searchdata.current_page,
                lastpage: this.searchdata.last_page,
                loading: 0,
                orderbyid: 0,
                orderfil: {
                    id: "name",
                    ordby: "asc",
                    name: "nameasc",
                },
            };
        },
        mounted() {
            console.log(this.searchdata)
            if (window.innerWidth <= 576) {
                this.navpages = 0;
            } else {}
            this.catselect = Array(this.category.length).fill(0);
            // this.changeordby();
        },
        methods: {
            changeordby() {
                var x = {
                    id: "",
                    ordby: "",
                    name: "",
                };
                if (this.orderbyid == 0) {
                    x.id = "name";
                    x.ordby = "asc";
                    x.name = "nameasc";
                } else if (this.orderbyid == 1) {
                    x.id = "name";
                    x.ordby = "desc";
                    x.name = "namedesc";
                } else if (this.orderbyid == 2) {
                    x.id = "fpricewtas";
                    x.ordby = "asc";
                    x.name = "priceasc";
                } else if (this.orderbyid == 3) {
                    x.id = "fpricewtas";
                    x.ordby = "desc";
                    x.name = "priceasc";
                }
                this.orderfil = x;
                this.setinitpage()
                this.searchapi();
            },
            setinitpage() {
                this.page = 1;
                this.loading = 1;
            },
            openFilter(val) {
                this.navpages = !this.navpages;
            },
            setcategory(value) {
                if (!this.catselectvalue.includes(value)) {
                    this.catselectvalue.push(value);
                } else {
                    this.catselectvalue.splice(this.catselectvalue.indexOf(value), 1);
                }
                this.setinitpage()
                this.searchapi();
            },
            setsubcategory(value) {
                if (!this.subcatselectvalue.includes(value)) {
                    this.subcatselectvalue.push(value);
                } else {
                    this.subcatselectvalue.splice(this.subcatselectvalue.indexOf(value), 1);
                }
                this.setinitpage()
                this.searchapi();
            },
            setbrand(value) {
                if (!this.brandselectvalue.includes(value)) {
                    this.brandselectvalue.push(value);
                } else {
                    this.brandselectvalue.splice(this.brandselectvalue.indexOf(value), 1);
                }
                this.setinitpage()
                this.searchapi();
            },
            pricefilter(value) {
                this.pricerange = value;
                this.setinitpage()
                this.searchapi();
            },
            discountfilter(value) {
                this.discountrange = value;
                this.setinitpage()
                this.searchapi();
            },
            newarrivalfun(value) {
                this.newarrival = value;
                this.setinitpage()
                this.searchapi();
            },
            searchapi() {
                var self = this;
          self.loading = 1;
                axios
                    .post("/searchdata?page=" + this.page, {
                        apidata:1,
                        category: this.catselectvalue,
                        subcategory: this.subcatselectvalue,
                        brand: this.brandselectvalue,
                        newarrival: this.newarrival,
                        pricerange: this.pricerange,
                        discountrange: this.discountrange,
                        todaydeal: this.todaydeal,
                        searchname: this.searchname,
                        orderfil: this.orderfil,
                    })
                    .then((res) => {
                        self.lastpage = res.data.last_page;
                        self.page = res.data.current_page;
                        self.datas = res.data.data ?? [];
                        self.loading = 0;
                    })
                    .catch((err) => {
                        console.error(err);
                    });
                    document.getElementById('searchlistdata').scrollIntoView();
            },
            changepage(val) {
                this.page = val;
                this.searchapi();
            },
        },
    };
</script>

<style scoped>
    .output {
        font-family: Courier, Courier New, Lucida Console, Monaco, Consolas;
        background: #000000;
        color: #ffffff;
        padding: 20px;
        margin-bottom: 50px;
        display: inline-block;
        width: 100%;
        box-sizing: border-box;
        font-size: 13px;
    }
</style>
