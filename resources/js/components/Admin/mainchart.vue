<template>
  <div class="card mt-2">
    <div class="card-body">
      <div class="row mt-2">
        <div class="col-md-6 mt-2 col-sm-12">
          <h5 class="font-prim font-weight-bold color-prim">Status</h5>
          <v-frappe-chart
            type="donut"
            :labels="['Draft', 'Active']"
            :data="[{ values: products }]"
          />
        </div>
        <div class="col-md-6 mt-2 col-sm-12">
          <h5>Orders</h5>
          <div v-if="ordersx.length > 0">
            <v-frappe-chart
              type="line"
              :labels="ordersx"
              :lineOptions="{ regionFill: 1 }"
              :data="ordersxval"
              :colors="['blue']"
            />
          </div>
          <div v-else class="alert alert-danger">Sorry No Data Found</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VFrappeChart } from "vue-frappe-chart";
import { GChart } from "vue-google-charts";
export default {
  components: {
    VFrappeChart,
    GChart,
  },
  props: ["products", "orders"],
  data() {
    return {
      prodstatusval: [0, 0],
      key: "",
      ordersx: [],
      ordersxval: [
        {
          values: [],
        },
      ],
      datasel: "",
      chartData: [
        ["Status", "Count"],
        ["Drafted", 1000],
        ["Active", 1170],
      ],
      chartOptions: {
        chart: {
          title: "Status",
        },
        height: "300",
        colors: ["#1b9e77", "#d95f02", "#7570b3"],
      },
      salechartData: [
        ["Status", "Count"],
        ["Drafted", 1000],
        ["Active", 1170],
      ],
      salechartOptions: {
        chart: {
          title: "Status",
        },
        height: "300",
        colors: ["#1b9e77", "#d95f02", "#7570b3"],
      },
    };
  },
  mounted() {
    var draft = 0;
    var active = 0;
    for (var obj in this.orders) {
      var x = 0;
      for (var i = 0; i < this.orders[obj].length; i++) {
        x = Math.round((x + this.orders[obj][i].total) * 100) / 100;
      }
      this.ordersx.push(obj);
      this.ordersxval[0].values.push(x);
    }
  },
};
</script>
