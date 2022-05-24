<template>
  <div class="card-body">
    <h4 class="color-prim font-weight-bold pb-2">Quick Order</h4>
    <div class="float-right">
      <button v-if="buttontype == 0" v-on:click="approve" class="btn mx-1 btn-primary">
        Approve
      </button>
      <button v-if="buttontype == 1" v-on:click="outfordel" class="btn mx-1 btn-primary">
        Out for Delivery
      </button>
      <button v-if="buttontype == 2" v-on:click="delivered" class="btn mx-1 btn-primary">
        Completed
      </button>
    </div>
    <div class="row p-2">
      <button
        class="btn mx-1 col-2"
        type="button"
        v-on:click="changebutton(0)"
        :class="[buttontype == 0 ? 'btn-outline-dark' : 'btn-dark']"
      >
        Pending
      </button>
      <button
        class="btn mx-1 col-2"
        type="button"
        v-on:click="changebutton(1)"
        :class="[buttontype == 1 ? 'btn-outline-dark' : 'btn-dark']"
      >
        Approved
      </button>
      <button
        class="btn mx-1 col-2"
        type="button"
        v-on:click="changebutton(2)"
        :class="[buttontype == 2 ? 'btn-outline-dark' : 'btn-dark']"
      >
        Shipped
      </button>
    </div>
    <table v-if="datax.length > 0" class="table table-list table-responsive">
      <thead>
        <tr
          style="
            text-transform: uppercase;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
          "
        >
          <th scope="">
            <input v-model="choice" v-on:click="setall" type="checkbox" value="1" />
          </th>
          <th scope="col font-weight-bold">#</th>
          <th style="width: 20%">Customer</th>
          <th>Status</th>
          <th>Pay Type</th>
          <th>Pay Status</th>
          <th>Total</th>
          <th style="width: 10%" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in datax" :key="'orderlist' + index">
          <th>
            <div class="form-check">
              <input
                class="form-check-input"
                v-on:click="setoff"
                v-model="choicedata[index]"
                type="checkbox"
                value="1"
              />
            </div>
          </th>
          <th scope="row">
            <a class="color-prim" :href="'/admin/orders/view/' + item.id">
              {{ item.invno }} <br />
            </a>
          </th>
          <td>
            <a
              class="color-prim"
              :href="'/admin/customer/view/' + (item.customer ? item.customer.id : '')"
            >
              {{ item.customer ? item.customer.name : "" }} <br />
            </a>
            <span style="display: none">
              {{ (x = JSON.parse(item.address)) }}
            </span>
            {{ x.name }} <br />
            {{ x.phno }} <br />
            {{ x.houseno }}, {{ x.area }} <br />
            {{ x.city }}, {{ x.state }} <br />
            {{ x.pincode }} <br />
          </td>
          <td>
            Created At {{ item.created_at | moment("dddd, MMMM Do YYYY") }} <br />
            {{ createCountDown("changetime" + index, item.created_at) }}
            <span class="h3 text-danger" :id="'changetime' + index"></span>
          </td>
          <td>
            <span v-if="item.status == 0">Pending</span>
            <span v-else-if="item.status == 1">Approved</span>
            <span v-else-if="item.status == 2">Out for Delivery</span>
            <span v-else-if="item.status == 3">Delivered</span>
            <span v-else-if="item.status == 4">Returned</span>
            <span v-else-if="item.status == 5">Not Attended</span>
            <span v-else-if="item.status == 6">Cancelled</span>
          </td>
          <td>
            <span v-if="item.paytype == 0">Online</span>
            <span v-else-if="item.paytype == 1">COD</span>
          </td>
          <td>
            <span v-if="item.paystatus == 0">Pending</span>
            <span v-else-if="item.paystatus == 1">Paid</span>
            <span v-else-if="item.paystatus == 2">Error</span>
            <span v-else-if="item.paystatus == 3">Returned</span>
          </td>
          <td>
            {{ item.total }}
          </td>
          <td class="text-center d-flex flex-row justify-content-around">
            <a :href="'/admin/orders/view/' + item.id" class="btn">
              <i
                class="fa fa-eye"
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

    <!-- <print :settings="settings" :data="xdata" backlink="/"></print> -->
    <div style="display: none">
      <div v-if="resdata" id="resdata">
        <div v-for="(totalitem, totalindex) in resdata" id="tableprint">
          <html>
            <div class="header row">
              <div class="col-4">
                <img loading="lazy" src="/storage/logo.png" style="width: 4rem" alt="" />
              </div>
              <div class="col-8 text-right">
                <h4 class="font-weight-bold mt-4">
                  Tax Invoice/Bill of Supply/Cash Memo
                </h4>
                (Original for Recipient)
              </div>
            </div>
            <div class="invoice mt-5">
              <div class="row">
                <div class="col-6">
                  <h5 class="font-weight-bold">Sold By :</h5>
                  <span class="font-weight-bold">{{ settings[0].value }}</span>
                  <p>
                    {{ settings[1].value }}, <br />
                    {{ settings[2].value }}, <br />
                    {{ settings[3].value }}, <br />
                    {{ settings[4].value }}, {{ settings[5].value }}<br />
                  </p>
                  <div v-if="settings[8].value">
                    <span class="font-weight-bold">PAN No.</span> {{ settings[8].value }}
                    <br />
                  </div>
                  <div v-if="settings[9].value">
                    <span class="font-weight-bold">GST Registration No.</span>
                    {{ settings[9].value }} <br />
                  </div>
                </div>
                <div class="col-6 text-right">
                  <h5 class="font-weight-bold">Shipping Address :</h5>
                  <span style="display: none">
                    {{ (x = JSON.parse(totalitem.address)) }}
                  </span>
                  <span class="font-weight-bold">{{ x.name || "" }}</span>
                  <p>
                    {{ x.houseno || "" }}, {{ x.area || "" }}, <br />
                    {{ x.city || "" }} {{ x.state || "" }}, <br />
                    {{ x.country || "" }} - {{ x.pincode || "" }} <br />
                  </p>
                  <p class="mb-0 pb-0">
                    <span class="font-weight-bold">Invoice Details : </span>
                    {{ totalitem.invno || "" }}
                  </p>
                  <p class="mb-0 pb-0">
                    <span class="font-weight-bold">Invoice Date : </span
                    >{{
                      totalitem.created_at || new Date() | moment("dddd, MMMM Do YYYY")
                    }}
                  </p>
                </div>
              </div>
              <table class="table mt-4 table-bordered">
                <thead>
                  <tr class="font-weight-bold" style="background-color: #e1dfdf">
                    <td style="width: 5%">Sl No.</td>
                    <td style="width: 45%">Description</td>
                    <td style="width: 10%">Unit Price</td>
                    <td style="width: 5%">Qty</td>
                    <td style="width: 10%">Net Amount</td>
                  </tr>
                </thead>
                <tbody>
                  <tr class="breakrow" v-for="(item, index) in totalitem.ordersub">
                    <td>{{ index + 1 }}</td>
                    <td style="vertical-align: middle">
                      {{ item.name }}
                    </td>
                    <td style="vertical-align: middle">Rs. {{ item.singlecost }}</td>
                    <td style="vertical-align: middle">{{ item.qty }}</td>
                    <td style="vertical-align: middle">Rs. {{ item.final }}</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="vertical-align: middle">Shipping</td>
                    <td style="vertical-align: middle">Rs. {{ totalitem.shipping }}</td>
                    <td style="vertical-align: middle">1</td>
                    <td style="vertical-align: middle">Rs. {{ totalitem.shipping }}</td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                    <td style="vertical-align: middle">Total</td>
                    <td style="vertical-align: middle">Rs. {{ totalitem.total }}</td>
                  </tr>
                </tbody>
              </table>

              <table
                class="mt-4 table-borderless table-responsive-sm table"
                style="border: 1px solid rgba(0, 0, 0, 0.5)"
              >
                <thead>
                  <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.5)">
                    <th>
                      Amount in Words : <br />
                      Rupees {{ conv.toWords(totalitem.total || 0) }}
                    </th>
                  </tr>
                  <tr>
                    <th class="text-right">
                      <p style="margin-bottom: 5rem">For Farm63 :</p>
                      <p>Authorized Signatory</p>
                    </th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="footer">
              <table class="mt-4 table">
                <tr>
                  <th>Payment Transaction ID:</th>
                  <th>Date and Time:</th>
                  <th>Invoice Value:</th>
                  <th>Mode of Payment:</th>
                </tr>
                <tr>
                  <td>{{ totalitem.payment ? totalitem.payment.orderid : "" }}</td>
                  <td>
                    {{
                      totalitem.payment
                        ? totalitem.payment.created_at
                        : new Date() | moment("dddd, MMMM Do YYYY, h:mm:ss a")
                    }}
                  </td>
                  <td>{{ totalitem.total || 0 }}</td>
                  <td>
                    <span v-if="totalitem.paytype && totalitem.paytype == 0">
                      <span v-if="totalitem.payment.paytype == 0">Card</span>
                      <span v-else-if="totalitem.payment.paytype == 1">Net Banking</span>
                      <span v-else-if="totalitem.payment.paytype == 2">Wallet</span>
                      <span v-else-if="totalitem.payment.paytype == 3">EMI</span>
                      <span v-else-if="totalitem.payment.paytype == 4">UPI</span>
                    </span>
                    <span v-else> Cash on Delivery </span>
                  </td>
                </tr>
              </table>
            </div>
          </html>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Printd } from "printd";
export default {
  props: ["data", "settings"],
  mounted() {
    this.newarray();
  },
  data() {
    return {
      buttontype: 0,
      datax: this.data,
      choice: 0,
      choicedata: [],
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      finaldata: [],
      resdata: [],
      xdata: [],
      conv: require("number-to-words"),
    };
  },
  methods: {
    newarray() {
      this.choicedata = Array.apply(0, Array(this.datax.length));
    },
    setall() {
      var opt = this.choice == 0 ? true : false;
      for (var i = 0; i < this.choicedata.length; i++) {
        this.choicedata[i] = opt;
      }
    },
    setoff() {
      this.choice = 0;
    },
    approve() {
      if (this.choicedata.length <= 0) {
        Vue.swal({
          title: "Oopss!!",
          text: "Please select atleast one order.",
          icon: "warning",
        });
        return;
      }
      this.finaldata = [];
      for (var i = 0; i < this.choicedata.length; i++) {
        if (this.choicedata[i]) {
          this.finaldata.push(this.datax[i].id);
        }
      }
      axios
        .post("/admin/orders/approve", {
          id: this.finaldata,
        })
        .then((res) => {
          this.resdata = res.data;
        })
        .then((res) => {
          this.printinvoice();
        })
        .then((res) => {
          this.fetchdata();
        })
        .catch((err) => {
          console.error(err);
        });
    },

    delivered() {
      if (this.choicedata.length <= 0) {
        Vue.swal({
          title: "Oopss!!",
          text: "Please select atleast one order.",
          icon: "warning",
        });
        return;
      }
      this.finaldata = [];
      for (var i = 0; i < this.choicedata.length; i++) {
        if (this.choicedata[i]) {
          this.finaldata.push(this.datax[i].id);
        }
      }
      axios
        .post("/admin/orders/delivered", {
          id: this.finaldata,
        })
        .then((res) => {
          if (res.data) {
            Vue.swal({
              title: "Success!!",
              text: "Orders were Completed",
              icon: "success",
            });
          } else {
            Vue.swal({
              title: "Oopss!!",
              text: "Please refresh the page.",
              icon: "warning",
            });
          }
        })
        .then((res) => {
          this.fetchdata();
        })
        .catch((err) => {
          console.error(err);
        });
    },
    outfordel() {
      if (this.choicedata.length <= 0) {
        Vue.swal({
          title: "Oopss!!",
          text: "Please select atleast one order.",
          icon: "warning",
        });
        return;
      }
      this.finaldata = [];
      for (var i = 0; i < this.choicedata.length; i++) {
        if (this.choicedata[i]) {
          this.finaldata.push(this.datax[i].id);
        }
      }
      axios
        .post("/admin/orders/outfordel", {
          id: this.finaldata,
        })
        .then((res) => {
          if (res.data) {
            Vue.swal({
              title: "Success!!",
              text: "Orders were Moved to Out for delivery",
              icon: "success",
            });
          } else {
            Vue.swal({
              title: "Oopss!!",
              text: "Please refresh the page.",
              icon: "warning",
            });
          }
        })
        .then((res) => {
          this.fetchdata();
        })
        .catch((err) => {
          console.error(err);
        });
    },
    printinvoice() {
      const d = new Printd();
      const styles = ["/css/app.css", "/css/print.css"];
      const el = document.getElementById("resdata");
      const printCallback = ({ launchPrint }) => launchPrint();
      d.print(el, styles, printCallback);
    },
    fetchdata() {
      this.setoff(0);
      axios
        .post("/admin/orders/quick", {
          status: this.buttontype,
        })
        .then((res) => {
          this.datax = res.data;
          this.newarray();
        })
        .catch((err) => {
          console.error(err);
        });
    },
    changebutton(val) {
      this.buttontype = val;
      this.fetchdata();
    },
    createCountDown(elementId, date) {
      var countDownDate = new Date(date).getTime() + 15 * 60000;
      var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        var x = document.getElementById(elementId);
        if (x) {
          x.innerHTML = minutes + "m " + seconds + "s ";
        }
        if (distance < 0) {
          clearInterval(x);
          if (x) {
            x.innerHTML = "ORDER EXPIRED";
          }
        }
      }, 1000);
    },
  },
};
</script>
