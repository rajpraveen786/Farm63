<style scoped>
@media print {
  #tableprint {
    padding: 2rem;
  }
}
</style>
<template>
  <div class="">
    <div class="container mt-3">
        <div class="float-right mr-3 mt-3">
            <button v-on:click="print" class="btn btn-success">
                Print Invoice
            </button>
            <a :href="backlink" class="btn btn-outline-success">Back</a>
        </div>
      <div id="tableprint" class="bg-white" style="padding: 3rem">
        <div class="row">
          <div class="col-4">
            <img loading="lazy" src="/storage/logo.png" class="w-100" style="width: 4rem" alt="" />
          </div>
          <div class="col-8 text-right">
            <h4 class="font-weight-bold mt-4">Tax Invoice/Bill of Supply/Cash Memo</h4>
            (Original for Recipient)
          </div>
        </div>
        <div class="row" style="margin-top: 4rem">
          <div class="col-6">
            <h5 class="font-weight-bold">Sold By :</h5>
            <span class="font-weight-bold">{{ settings[0].value }}</span>
            <p>
                {{ settings[1].value }}, <br>
                {{ settings[2].value }}, <br>
                {{ settings[3].value }}, <br>
                {{ settings[4].value }}, {{ settings[5].value }}<br>
            </p>
            <div v-if="settings[8].value">
                <span class="font-weight-bold">PAN No.</span> {{ settings[8].value }} <br />
            </div>
            <div v-if="settings[9].value">
                <span class="font-weight-bold">GST Registration No.</span> {{ settings[9].value }} <br />
            </div>
          </div>
          <div class="col-6 text-right">
            <h5 class="font-weight-bold">Shipping Address :</h5>
            <span class="font-weight-bold">{{address.name||''}}</span>
            <p>
              {{ address.houseno||'' }}, {{ address.area||'' }}, <br />
              {{ address.city||'' }} {{ address.state||'' }}, <br />
              {{ address.country||'' }} - {{ address.pincode||'' }} <br />
            </p>
            <p class="mb-0 pb-0">
              <span class="font-weight-bold">Invoice Details : </span> {{ data.invno||'' }}
            </p>
            <p class="mb-0 pb-0">
              <span class="font-weight-bold">Invoice Date : </span
              >{{ data.created_at||new Date() | moment("dddd, MMMM Do YYYY") }}
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
            <tr v-for="(item, index) in data.ordersub">
              <td>{{ index+1 }}</td>
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
              <td style="vertical-align: middle">Rs. {{ data.shipping }}</td>
              <td style="vertical-align: middle">1</td>
              <td style="vertical-align: middle">Rs. {{ data.shipping }}</td>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td style="vertical-align: middle">Total</td>
              <td style="vertical-align: middle">Rs. {{ data.total }}</td>
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
                Rupees {{ conv.toWords(data.total||0) }}
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
        <table class="mt-4 table">
          <tr>
            <th>Payment Transaction ID:</th>
            <th>Date and Time:</th>
            <th>Invoice Value:</th>
            <th>Mode of Payment:</th>
          </tr>
          <tr>
            <td>{{ data.payment?data.payment.orderid:'' }}</td>
            <td>{{ data.payment?data.payment.created_at:new Date() | moment("dddd, MMMM Do YYYY, h:mm:ss a") }}</td>
            <td>{{ data.total || 0 }}</td>
            <td>
              <span v-if="data.paytype==0">
                <span v-if="data.payment.paytype == 0">Card</span>
                <span v-else-if="data.payment.paytype == 1">Net Banking</span>
                <span v-else-if="data.payment.paytype == 2">Wallet</span>
                <span v-else-if="data.payment.paytype == 3">EMI</span>
                <span v-else-if="data.payment.paytype == 4">UPI</span>
              </span>
              <span v-else>
                  Cash on Delivery
              </span>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import { Printd } from "printd";

var converter = require("number-to-words");
export default {
  props: ["data",'backlink','settings'],
  data() {
    return {
      address: JSON.parse(this.data.address||'[]'),
      ordersub: this.data.ordersub,
      conv: require("number-to-words"),
    };
  },
  mounted() {},
  methods: {
    print() {
      const d = new Printd();
      const styles = [
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",
      ];
      const el = document.getElementById("tableprint");
      const printCallback = ({ launchPrint }) => launchPrint();
      d.print(el, styles, printCallback);
    },
  },
};
</script>
