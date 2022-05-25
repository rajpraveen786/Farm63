<template>
    <div class="p-3" id="xyza">
        <form action="/profile/cart/checkout" method="POST" class="forms-" id="cartsave" name="cartsave" enctype="multipart/form-data">
            <input type="hidden" name="_token" v-model="csrf" />
            <input type="hidden" name="qty" v-model="prod.qty" />
            <input type="hidden" name="id" v-model="prod.id" />
            <input type="hidden" name="name" v-model="prod.name" />
            <input type="hidden" name="disid" v-model="prod.disid" />
            <input type="hidden" name="disp" v-model="prod.disp" />
            <input type="hidden" name="disa" v-model="prod.disa" />
            <input type="hidden" name="fpricewtas" v-model="prod.fpricewtas" />
            <input type="hidden" name="fpricebefdis" v-model="prod.fpricebefdis" />
            <input type="hidden" name="taxp" v-model="prod.taxp" />
            <input type="hidden" name="weighttotal" v-model="prod.weighttotal" />
            <input type="hidden" name="weight" v-model="prod.weight" />
            <input type="hidden" name="length" v-model="prod.length" />
            <input type="hidden" name="breadth" v-model="prod.breadth" />
            <input type="hidden" name="width" v-model="prod.width" />
            <input type="hidden" name="qtotal" v-model="prod.qtotal" />
            <input type="hidden" name="mrptotal" v-model="prod.mrptotal" />
            <input type="hidden" name="discounttotal" v-model="prod.discounttotal" />
            <input type="hidden" name="nettotal" v-model="prod.nettotal" />
        </form>
        <div v-if="loading">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-12 col-md-6 mt-2 text-center">
                    <div class="text-center">
                        <div class="spinner-border" style="width: 6rem; height: 6rem" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="bg-bluee p-3">
                <div class="check-box mt-2 float-md-right">
                    <div class="status-check">
                        <div class="active">Cart</div>
                        <div>Delivery</div>
                        <div>Payment</div>
                    </div>
                </div>
                <h6 class="font-prim mt-2 font-weight-bold">
                    My Cart: <span class="small">Items ({{ this.prod.id.length }})</span>
                </h6>
            </div>
            <div class="container">
                <div class="row justify-content-center pt-3">
                    <div class="col-lg-3 col-md-10 order-lg-2">
                        <div class="card card-body">
                            <h6 class="font-prim font-weight-bold mb-2">Payment Details</h6>
                            <div style="font-size: 0.9em">
                                <p class="p-1 m-0">
                                    MRP Total:
                                    <span class="float-right font-weight-bold font-prim">Rs {{ prod.mrptotal + prod.discounttotal }}</span
                                  >
                                </p>
                              </div>
                              <hr v-if="prod.discounttotal!=0" class="m-0" />
                              <div v-if="prod.discounttotal!=0" style="font-size: 0.9em">
                                <p class="p-1 m-0">
                                  Product Discount:
                                  <span class="float-right font-weight-bold font-prim text-success"
                                    >- Rs {{ prod.discounttotal }}</span
                                  >
                                </p>
                              </div>
                              <hr class="m-0" />
                              <div style="font-size: 0.9em">
                                <p class="p-1 m-0 font-weight-bold font-prim">
                                  Total Amount :
                                  <span class="float-right font-weight-bold font-prim"
                                    >Rs {{ prod.nettotal }}</span
                                  >
                                </p>
                              </div>
                            </div>
                            <div class="card mt-1 card-body">
                              <a href="/" class="btn btn-resp mt-2 btn-outline-success"
                                >Continue Shopping</a
                              >
                              <button v-on:click="cartsave" class="btn btn-resp mt-2 btn-success">
                                Checkout
                              </button>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-10 order-lg-1" v-if="prod.id.length > 0">
                            <div
                              v-for="(item, index) in prod.id"
                              :key="'cartitem' + index"
                              class="card my-1 border-success card-body"
                            >
                              <div class="row justify-content-center">
                                <div class="col-lg-2 col-md-3 col-8">
                                  <img
                                    loading="lazy"
                                    v-if="prod.datas[index].image"
                                    :src="'/' + prod.datas[index].image.loc"
                                    class="w-100"
                                  />
                                </div>
                                <div class="col-lg-6 col-md-5 col-12">
                                  <a :href="'/products/'+prod.datas[index].urlslug" class="mb-0 cart-name font-weight-bold">
                                    {{ prod.datas[index].name }}
                                  </a>
                                  <div class="mt-0 price">
                                    <span v-if="prod.datas[index].disp" class="price-old"
                                      >Rs. {{ prod.datas[index].fpricebefdis }}</span
                                    >
                                    <span class="price-new font-prim"
                                      >Rs. {{ prod.datas[index].fpricewtas }}</span
                                    >
                                  </div>
                                  <p class="text-success small" v-if="prod.datas[index].disp">
                                    You save Rs.
                                    {{
                                      Math.round(
                                        (prod.datas[index].fpricebefdis - prod.datas[index].fpricewtas) *
                                          100
                                      ) / 100
                                    }}
                                  </p>
                                  <a
                                    class="btn text-success mt-1 w-sm-100 btn-light"
                                    v-on:click="removefromcart(index)"
                                    ><i class="fas fa-trash mr-1"></i>
                                    <span class="small-md"> Remove </span>
                                    </a>
                                    <a class="btn text-success mt-1 w-sm-100 btn-light" v-on:click="savelaterfun(index)"><i class="fas fa-clock mr-1"></i>
                                    <span class="small-md"> Save Later </span></a
                                  >
                                </div>
                                <div class="col-lg-4 col-md-4 col-8">
                                  <div class="quantity-cart mt-2">
                                    <button
                                      v-on:click="changeqty(index, -1)"
                                      id="cart-decrement"
                                      class="decrement"
                                    >
                                      -
                                    </button>
                                    <input
                                      min="1"
                                      placeholder="1"
                                      v-on:change="changeqty(index,0)"
                                      v-model="prod.qty[index]"
                                      id="cart-value"
                                      class="value"
                                      type="number"
                                      value="1"
                                    />
                                    <button
                                      v-on:click="changeqty(index, 1)"
                                      id="cart-increment"
                                      class="increment"
                                    >
                                      +
                                    </button>
                                  </div>
                                  <h6 class="font-prim ml-5 text-md-right mr-md-5 mt-2 font-weight-bold">
                                    Rs. {{ prod.qtotal[index] }}
                                  </h6>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div v-else class="col-lg-7 col-md-10 col-12">
                            <div class="card shadow card-body text-center">
                              <img
                                loading="lazy"
                                src="/storage/img/sorry.svg"
                                alt=""
                                class="w-md-50 w-100 mx-auto"
                              />
                              <h4 class="font-prim font-weight-bold">
                                You cart is <span class="color-prim2">Empty</span>
                              </h4>
                              <h5 class="">
                                Click <a href="/" style="color: blue"> here </a>to continue shopping
                                    </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="savelater.length > 0" class="container mt-5 p-2">
                    <h4 class="font-weight-bold font-prim text-uppercase">Save Later</h4>
                    <swiper ref="mySwipersavelater" style="overflow: hidden" :options="swiperOptions">
                        <swiper-slide class="" v-for="(itemx, index) in savelater" :key="index + key + 'savelater'">
                            <div class="card mx-1 border-0 shadow text-center card-body card-prod-ms">
                                <a :href="'/products/' + itemx.urlslug">
                                    <img :src="'/' + itemx.image.loc" :alt="itemx.name" class="card-img-top img-prod-ms" />
                                    <span class="discount pos" v-if="itemx.disp > 0"><div id="cut-diamond">{{ itemx.disp }} <span> % OFF</span></div>
                            </span>
                            <h6 class="font-prim  color-prim mt-4 mb-0 font-weight-bold">
                                {{ itemx.name }}
                            </h6>
                            </a>
                            <!-- <div><i class="fas text-success fa-check-circle" style="transform: scale(0.8);"></i> In Stock <span class="text-muted"> - 1kg</span></div> -->
                            <div class="price">
                                <span class="price-old" v-if="itemx.disp > 0">Rs. {{ itemx.fpricebefdis }}</span
                                >
                                <span class="price-new font-prim">Rs. {{ itemx.fpricewtas }}</span>
                            </div>
                            <div class="btn btn-custom-gradient" v-on:click="addtocart(0, index)">
                                Add to Cart
                            </div>
                </div>
                </swiper-slide>
                </swiper>
            </div>
            <div v-if="buyagain.length > 0" class="container mt-5 p-2">
                <h4 class="font-weight-bold font-prim text-uppercase">Buy Again</h4>
                <swiper ref="mySwiperbuyagain" style="overflow: hidden" :options="swiperOptions">
                    <swiper-slide class="" v-for="(itemx, index) in buyagain" :key="index + key + 'buyagain'">
                        <div class="card mx-1 border-0 shadow text-center card-body card-prod-ms">
                            <a :href="'/products/' + itemx.urlslug">
                                <img :src="'/' + itemx.image.loc" :alt="itemx.name" class="card-img-top img-prod-ms" />
                                <span class="discount pos" v-if="itemx.disp > 0"><div id="cut-diamond">{{ itemx.disp }} <span> % OFF</span></div>
                        </span>
                        <h6 class="font-prim  color-prim mt-4 mb-0 font-weight-bold">
                            {{ itemx.name }}
                        </h6>
                        </a>
                        <!-- <div><i class="fas text-success fa-check-circle" style="transform: scale(0.8);"></i> In Stock <span class="text-muted"> - 1kg</span></div> -->
                        <div class="price">
                            <span class="price-old" v-if="itemx.disp > 0">Rs. {{ itemx.fpricebefdis||'' }}</span
                                >
                                <span class="price-new font-prim">Rs. {{ itemx.fpricewtas }}</span>
                        </div>
                        <div class="btn btn-custom-gradient" v-on:click="addtocart(1, index)">
                            Add to Cart
                        </div>
            </div>
            </swiper-slide>
            </swiper>
        </div>
        </swiper>
    </div>
    </div>
    </div>
</template>

<script>
    import {
        Swiper,
        SwiperSlide,
        directive
    } from "vue-awesome-swiper";
    import "swiper/swiper-bundle.css";
    export default {
        components: {
            Swiper,
            SwiperSlide,
        },
        props: ["products", "buyagain", "user"],
        mounted() {
            for (var i = 0; i < this.datas.length; i++) {
                if (this.datas[i].stock > 0 || this.datas[i].oosc) {
                    this.datas[i].available = 1;
                    this.addtocart(2, i);
                } else {
                    this.datas[i].available = 0;
                    this.savelater.push(this.datas[i]);
                }
            }
            this.calctotal();
            this.loading = 0;
        },
        data() {
            return {
                sldx: null,
                swiperOptions: {
                    breakpoints: {
                        1324: {
                            slidesPerView: 6,
                        },
                        1024: {
                            slidesPerView: 5,
                        },
                        768: {
                            slidesPerView: 4,
                        },
                        400: {
                            slidesPerView: 4,
                        },
                        0: {
                            slidesPerView: 4,
                        },
                    },
                },
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                loading: 1,
                datas: this.products,
                prod: {
                    datas: [],
                    id: [],
                    disid: [],
                    disp: [],
                    disa: [],
                    name: [],
                    weight: [],
                    qty: [],
                    wgunit: [],
                    length: [],
                    width: [],
                    breadth: [],
                    lunit: [],
                    fpricewtas: [],
                    fpricebefdis: [],
                    taxa: [],
                    taxp: [],
                    qtotal: [],
                    subtotal: 0,
                    discounttotal: 0,
                    nettotal: 0,
                    weighttotal: 0,
                },
                key: "",
                savelater: [],
            };
        },
        methods: {
            changeqty(index, val) {
                if (parseInt(this.prod.qty[index]) + val > 0) {
                    this.$set(this.prod.qty, index, parseInt(this.prod.qty[index]) + val);
                    this.calctotal();
                }
            },
            removefromcart(index) {
                Vue.swal({
                    title: "Are you sure?",
                    text: "Product will be removed from cart!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-outline-danger ml-1",
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.value) {
                        axios
                            .post("/cart/delete", {
                                // uid: this.user.id,
                                pid: this.prod.id[index],
                            })
                            .then((res) => {
                                Vue.swal({
                                    icon: "success",
                                    title: "Deleted!",
                                    text: "Product has been removed.",
                                    customClass: {
                                        confirmButton: "btn btn-success",
                                    },
                                });
                                document.getElementById('cartcount').innerHTML = res.data || 0;
                                this.removeprod(0, index);
                                this.key = Math.random();
                            })
                            .catch((err) => {
                                console.error(err);
                            });
                    }
                });
                this.calctotal();
            },
            savelaterfun(index) {
                Vue.swal({
                    title: "Are you sure?",
                    text: "Product will be added to save later cart!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Add to Save later!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-outline-danger ml-1",
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.value) {
                        this.removeprod(1, index);
                        this.key = Math.random();
                        this.key = Math.random();
                    }
                });
                this.calctotal();
            },
            calctotal() {
                var mrptotal = 0;
                var discounttotal = 0;
                var nettotal = 0;
                var weight = 0;
                for (var i = 0; i < this.prod.id.length > 0; i++) {
                    var qty = this.prod.qty[i];
                    var temp = this.prod.fpricewtas[i];
                    var discount = 0;
                    if (this.prod.disp[i] != 0) {
                        discount =
                            Math.round(
                                (this.prod.fpricebefdis[i] - this.prod.fpricewtas[i]) * qty * 100
                            ) / 100;
                    }
                    weight += Math.round(this.prod.weight[i] * qty * 100) / 100;
                    var mrp = Math.round(temp * qty);
                    this.prod.qtotal[i] = mrp;
                    mrptotal += Math.round(mrp * 100) / 100;
                    discounttotal += Math.round(discount * 100) / 100;
                    nettotal += Math.round(mrp * 100) / 100;
                }
                this.prod.weighttotal = weight;
                this.prod.mrptotal = mrptotal;
                this.prod.discounttotal = discounttotal;
                this.prod.nettotal = nettotal;
            },
            removeprod(type, index) {
                var x = [];
                x = this.prod.datas[index];
                if (type) {
                    this.savelater.push(x);
                    var j = this.savelater;
                    this.savelater = j;
                }
                this.prod.datas.splice(index, 1);
                this.prod.id.splice(index, 1);
                this.prod.disp.splice(index, 1);
                this.prod.disid.splice(index, 1);
                this.prod.disa.splice(index, 1);
                this.prod.name.splice(index, 1);
                this.prod.qty.splice(index, 1);
                this.prod.weight.splice(index, 1);
                this.prod.wgunit.splice(index, 1);
                this.prod.length.splice(index, 1);
                this.prod.width.splice(index, 1);
                this.prod.breadth.splice(index, 1);
                this.prod.lunit.splice(index, 1);
                this.prod.fpricewtas.splice(index, 1);
                this.prod.fpricebefdis.splice(index, 1);
                this.prod.taxp.splice(index, 1);
                this.prod.taxa.splice(index, 1);
                this.prod.qtotal.splice(index, 1);
                this.calctotal();
            },
            addtocart(type, index = null) {
                var tempitem = [];
                if (type == 0) {
                    tempitem = this.savelater[index];
                    this.savelater.splice(index, 1);
                } else if (type == 1) {
                    //buyagain
                    tempitem = this.buyagain[index];
                } else {
                    tempitem = this.datas[index];
                }
                if (!this.prod.id.includes(tempitem.id) && (tempitem.stock > 0 || tempitem.oosc)) {
                    this.prod.datas.push(tempitem);
                    this.prod.id.push(tempitem.id);
                    this.prod.disid.push(tempitem.disid);
                    this.prod.disp.push(tempitem.disp);
                    this.prod.disa.push(tempitem.disa);
                    this.prod.name.push(tempitem.name);
                    this.prod.qty.push(tempitem.cart ? tempitem.cart.qty : 1);
                    this.prod.weight.push(tempitem.weight);
                    this.prod.wgunit.push(tempitem.wgunit);
                    this.prod.length.push(tempitem.length);
                    this.prod.width.push(tempitem.width);
                    this.prod.breadth.push(tempitem.breadth);
                    this.prod.lunit.push(tempitem.lunit);
                    this.prod.fpricewtas.push(tempitem.fpricewtas);
                    this.prod.fpricebefdis.push(tempitem.fpricebefdis);
                    this.prod.taxp.push(tempitem.taxp);
                    this.prod.taxa.push(tempitem.taxa);
                    this.prod.qtotal.push(tempitem.fpricewtas);
                } else {
                    Vue.swal({
                        title: "Oops.",
                        text: "Sorry Product is already in cart.",
                        icon: "error",
                    });
                }
                this.calctotal();
            },
            cartsave() {
                if (this.prod.id.length > 0) {
                    this.calctotal();
                    document.getElementById("cartsave").submit();
                } else {
                    Vue.swal({
                        title: "Oops.",
                        text: "Sorry you have an empty cart.",
                        icon: "error",
                    });
                }
            },
            applypromocode() {
                this.clears();
                var self = this;
                if (this.promocodemodel.length > 0) {
                    axios
                        .post("/getpromocode", {
                            name: this.promocodemodel,
                        })
                        .then((res) => {
                            if (res.data.error) {
                                self.promoerror = res.data.errordata;
                            } else {
                                var temp = res.data.data;
                                if (
                                    temp.minreq > 0 &&
                                    ((temp.minreq == 1 && temp.minreqdata > this.total.cost) ||
                                        (temp.minreq == 2 && temp.minreqdata > this.total.items))
                                ) {
                                    if (temp.minreq == 1 && temp.minreqdata > this.total.cost) {
                                        Vue.swal({
                                            title: "Oops",
                                            text: "Sorry Promo Code cannot be applied as the minimum amount is rs " +
                                                temp.minreqdata,
                                            icon: "error",
                                        });
                                    }
                                    if (temp.minreq == 2 && temp.minreqdata > this.total.items) {
                                        Vue.swal({
                                            title: "Oops",
                                            text: "Sorry Promo Code cannot be applied as the minimum number of item is " +
                                                temp.minreqdata,
                                            icon: "error",
                                        });
                                    }
                                    return "1";
                                } else {
                                    self.promocode = res.data.data;
                                    self.calctotal();
                                }
                            }
                        })
                        .catch((err) => {
                            console.error(err);
                        })
                        .then((res) => {});
                } else {
                    Vue.swal({
                        title: "Oops",
                        text: "Enter a valid Promo Code.",
                        icon: "error",
                    });
                }
            },
        },
    };
</script>
