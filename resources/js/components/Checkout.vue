<template>
  <div id="">
    <div class="m-lg-5 card card-body check-box">
      <div class="row">
        <div class="col-lg-8 col-sm-12 form-checkk">
          <h5 class="font-weight-bold mt-3 py-3">Select a delivery address</h5>
          <p>
            Click on deliver to choose delivery address or add new shipping address from
            below if required. Pincode autofill by using
            <span class="text-success"> <i class="ml-1 fas fa-search"></i></span>
          </p>
          <div class="saved">
            <div class="py-3">
              <div class="row">
                <div
                  class="col-md-4"
                  v-for="(item, index) in address"
                  :key="'address' + index"
                >
                  <div class="card card-body">
                    <h6 class="font-prim color-prim font-weight-bold">{{ item.name }}</h6>
                    <span class="float-right">{{ item.phno }}</span>
                    <p>
                      <span v-if="item.houseno">{{ item.houseno }},</span>
                      <span v-if="item.area">{{ item.area }},</span><br />
                      <span v-if="item.city">{{ item.city }},</span>
                      <span v-if="item.state">{{ item.state }},</span><br />
                      <span v-if="item.country">{{ item.country }},</span>
                      <span v-if="item.pincode">{{ item.pincode }},</span><br />
                      <span v-if="item.landmark">Landmark - {{ item.landmark }},</span>
                    </p>
                    <button
                      v-on:click="selectaddress(index)"
                      class="btn btn-outline-success float-right"
                    >
                      Select Address
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <h5 class="font-weight-bold mt-3 p-3">Add New Shipping Address</h5>
          <div class="p-2 mt-2">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input
                  v-model="newaddress.name"
                  type="text"
                  :disabled="setup.disabled == 1"
                  class="form-control"
                  id="inputEmail4"
                  placeholder="Name"
                />
              </div>
              <div class="form-group col-md-6">
                <input
                  v-model="newaddress.phno"
                  type="text"
                  :disabled="setup.disabled == 1"
                  class="form-control"
                  id="inputPassword4"
                  placeholder="Phone No."
                />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-10">
                <input
                  v-model="newaddress.pincode"
                  type="text"
                  :disabled="setup.disabled == 1"
                  class="form-control"
                  id="inputAddress"
                  placeholder="Pincode"
                />
                <small
                  >Please click the search button to autofill City, State and
                  Country</small
                >
              </div>
              <div class="col-2">
                <button v-on:click="getarea" class="btn-block btn btn-outline-success">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-group">
                  <input
                    v-model="newaddress.country"
                    type="text"
                    :disabled="setup.disabled == 1"
                    class="form-control"
                    id="inputAddress2"
                    disabled
                    placeholder="Country"
                  />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input
                    v-model="newaddress.state"
                    type="text"
                    :disabled="setup.disabled == 1"
                    class="form-control"
                    id="inputAddress2"
                    disabled
                    placeholder="State"
                  />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input
                    v-model="newaddress.city"
                    type="text"
                    :disabled="setup.disabled == 1"
                    class="form-control"
                    id="inputAddress2"
                    disabled
                    placeholder="City"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <input
                v-model="newaddress.houseno"
                type="text"
                :disabled="setup.disabled == 1"
                class="form-control"
                id="inputEmail4"
                placeholder="Flat, House no., Building, Company, Apartment"
              />
            </div>
            <div class="form-group">
              <input
                v-model="newaddress.area"
                type="text"
                :disabled="setup.disabled == 1"
                class="form-control"
                id="inputEmail4"
                placeholder="Area, Street, Sector, Village"
              />
            </div>
            <div class="form-group">
              <input
                v-model="newaddress.landmark"
                type="text"
                :disabled="setup.disabled == 1"
                class="form-control"
                id="inputEmail4"
                placeholder="Landmark"
              />
            </div>
            <button
              type="button"
              v-on:click="addressdata(newaddress, 1)"
              class="btn btn-success px-4"
            >
              <span v-if="setup.disabled == 0"> Save address and Deliver Here </span>
              <span v-else> Address Selected </span>
            </button>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 mt-2 p-lg-5">
          <div v-if="setup.loading">
            <div class="d-flex justify-content-center">
              <div class="spinner-border" role="status" style="width: 5rem; height: 5rem">
                <span class="sr-only">Loading...</span>
              </div>
            </div>
          </div>
          <div v-else>
            <div class="status-check">
              <div>Cart</div>
              <div class="active">Delivery</div>
              <div>Payment</div>
            </div>
            <hr />
            <div class="order-summ">
              <div class="form-row">
                <div class="form-group col-10">
                  <input
                    v-model="promocodemodel"
                    type="text"
                    class="form-control"
                    placeholder="Enter Promo Code"
                  />
                  <small v-if="promoerror" class="text-danger text-left">{{
                    promoerror
                  }}</small>
                </div>
                <div class="col-2">
                  <button
                    v-on:click="applypromocode"
                    class="btn-block btn btn-outline-success"
                  >
                    <i class="fas fa-wallet"></i>
                  </button>
                </div>
              </div>
            </div>
            <hr />
            <div class="order-summ">
              <h6 class="font-weight-bold mt-4">Order Summary</h6>
              <p class="m-0">
                Order Total : <span class="float-right">Rs {{ subcost }}</span>
              </p>
              <p v-if="shipping > 0" class="m-0">
                Shipping Charges : <span class="float-right">Rs {{ shipping }}</span>
              </p>
              <p v-if="promocodeval > 0" class="m-0 text-success">
                Promocode : <span class="float-right">- Rs {{ promocodeval }}</span>
              </p>
              <hr />
              <h6 class="font-weight-bold mt-4">
                Total Payable : <span class="float-right">Rs. {{ total }}</span>
              </h6>
            </div>
            <hr />
            <div class="order-summ">
              <button
                v-on:click="changepaytype(0)"
                :class="[paytype == 0 ? 'btn-outline-dark' : '']"
                class="btn px-4"
              >
                Pay Online
              </button>
              <button
                v-on:click="changepaytype(1)"
                :class="[paytype == 1 ? 'btn-outline-dark' : '']"
                class="btn px-4"
              >
                COD
              </button>
            </div>
            <div class="pay my-3">
              <button
                v-if="seladdress.pincode"
                v-on:click="finishpurchase"
                class="btn btn-block btn-success"
              >
                Place Order
              </button>
              <p v-else class="btn btn-outline-danger btn-block">
                Please select address to proceed
              </p>
            </div>
            <h6 class="font-weight-bold font-prim mt-5">
              In Cart ({{ cart.qty.length }})
            </h6>
            <hr />
            <div class="items smal mt-2l" v-for="(item, index) in cart.name">
              <h6 class="font-prim font-weight-bold">{{ item }}</h6>
              <span class="float-right font-weight-bold"
                >Rs. {{ cart.fpricewtas[index] * cart.qty[index] }}</span
              >
              <p class="my-0 py-0">
                Rs. {{ cart.fpricewtas[index] }} x ( {{ cart.qty[index] }} )
              </p>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
    <form action="/profile/cart/save" method="post" id="xyz">
      <input type="hidden" name="_token" v-model="csrf" />
      <input type="hidden" name="seladdress" :value="JSON.stringify(seladdress)" />
      <input type="hidden" name="cart" :value="JSON.stringify(cart)" />
      <input type="hidden" name="promocode" :value="JSON.stringify(promocode)" />
      <input type="hidden" name="promocode" :value="JSON.stringify(promocode)" />
      <input type="hidden" name="paytype" v-model="paytype" />
      <input type="hidden" name="subcost" v-model="subcost" />
      <input type="hidden" name="promocodeval" v-model="promocodeval" />
      <input type="hidden" name="shipping" v-model="shipping" />
      <input type="hidden" name="total" v-model="total" />
    </form>
  </div>
</template>

<script>
export default {
  components: {},
  props: ["user", "address", "cart"],
  data() {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      subcost: this.cart.nettotal,
      setup: {
        loading: 0,
        disabled: 0,
      },
      seladdress: {
        id: "",
        name: "",
        phno: "",
        pincode: "",
        houseno: "",
        area: "",
        city: "",
        state: "",
        country: "",
        landmark: "",
        custom: 0, //0 old data //1 new data
        promocodedisp: 0,
        promocodedisa: 0,
      },
      newaddress: {
        name: "",
        phno: "",
        pincode: "",
        houseno: "",
        area: "",
        city: "",
        state: "",
        country: "",
        landmark: "",
      },
      paytype: 0,
      promocodemodel: "",
      promoerror: "",
      promocodeval: 0,
      promocode: null,
      promocodeid: "",
      shipping: 0,
      total: this.cart.nettotal || 0,
    };
  },
  mounted() {
    this.calctotal();
  },
  methods: {
    selectaddress(index) {
      this.setup.disabled = 1;
      this.addressdata(this.address[index], 0);
      this.setup.loading = 0;
    },
    getpincodecost() {
      var self = this;
      axios
        .post("/getcost", {
          pincode: this.seladdress.pincode,
        })
        .then((res) => {
          this.shipping = res.data.data;
          this.calctotal();
        })
        .catch((err) => {
          console.error(err);
        });
    },
    getarea() {
      var self = this;
      this.newaddress.city=''
      this.newaddress.state=''
      this.newaddress.country=''
      if (this.newaddress.pincode.length > 0) {
        axios
          .post("/getarea", {
            pincode: this.newaddress.pincode,
          })
          .then((res) => {
            if (res.data.success) {
              self.newaddress.country = res.data.data.country;
              self.newaddress.state = res.data.data.state;
              self.newaddress.city = res.data.data.city;
              self.newaddress.pid = res.data.data.id;
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
    calctotal() {
      var temp = parseFloat(this.subcost);
      var promocodeval = 0;
      if (this.promocode) {
        if (this.promocode.type == 0) {
          promocodeval = Math.round(temp * parseFloat(this.promocode.value)) / 100;
        } else if (this.promocode.type == 1) {
          promocodeval = this.promocode.value;
        }
      }
      this.promocodeval = promocodeval;
      this.total = temp + this.shipping - this.promocodeval;
    },
    checknewaddres() {
      var temp = this.newaddress;
      if (
        temp.name.length>0 &&
        temp.phno.length>0 &&
        temp.pincode.length>0 &&
        temp.houseno.length>0 &&
        temp.area.length>0 &&
        temp.city.length>0 &&
        temp.state.length>0 &&
        temp.country.length>0
      ) {
        this.addressdata(temp, 1);
      } else {
        Vue.swal({
          title: "Fields Missing",
          text: "Please enter the values.",
          icon: "error",
        });
      }
    },
    addressdata(data, custom) {
    //   if (
    //     [
    //       data.name.length > 0,
    //       data.phone.length > 0,
    //       data.pincode.length > 0,
    //       data.houseno.length > 0,
    //       data.area.length > 0,
    //       data.city.length > 0,
    //       data.state.length > 0,
    //       data.country.length > 0,
    //     ].includes(1)
    //   ) {
    //     Vue.swal({
    //       title: "Fields Missing",
    //       text: "Please enter the values.",
    //       icon: "error",
    //     });
    //     return;
    //   }

      this.setup.loading = 1;
      this.seladdress.id = data.id || "";
      this.seladdress.name = data.name;
      this.seladdress.phno = data.phno;
      this.seladdress.pincode = data.pincode;
      this.seladdress.houseno = data.houseno;
      this.seladdress.area = data.area;
      this.seladdress.city = data.city;
      this.seladdress.state = data.state;
      this.seladdress.country = data.country;
      this.seladdress.landmark = data.landmark;
      this.seladdress.custom = custom;
      if (custom) {
        this.setup.disabled = 1;
      }
      this.getpincodecost();
      this.calctotal();
      this.setup.loading = 0;
    },
    applypromocode() {
      this.promoerror = "";
      this.promocodeval = 0;
      this.promocodeid = null;
      this.promocode = null;
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
                    text:
                      "Sorry Promo Code cannot be applied as the minimum amount is rs " +
                      temp.minreqdata,
                    icon: "error",
                  });
                }
                if (temp.minreq == 2 && temp.minreqdata > this.total.items) {
                  Vue.swal({
                    title: "Oops",
                    text:
                      "Sorry Promo Code cannot be applied as the minimum number of item is " +
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
    finishpurchase() {
      document.getElementById("xyz").submit();
    },
    changepaytype(val) {
      this.paytype = val;
    },
  },
};
</script>
