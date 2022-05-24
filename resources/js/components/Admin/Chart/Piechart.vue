<template>
  <div class="card mt-2">
    <div class="card-body">
      <div class="row mt-2">
        <div class="col-md-6 mt-2 col-sm-12">
          <h5>Status</h5>
          <GChart
            type="ColumnChart"
            :data="chartData"
            :options="chartOptions"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { GChart } from "vue-google-charts";
export default {
  components: {
    GChart,
  },
  props: ["products", "orders"],
  data() {
    return {
      prodstatus: ["Drafted", "Active"],
      prodstatusval: [
        {
          values: ["", ""],
        },
      ],
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
          subtitle: "Sales, Expenses, and Profit: 2014-2017",
        },
      },
    };
  },
  mounted() {
    for (var i = 0; i < this.products.length; i++) {
      var temp = this.products[i];
      if (temp.status == 0) {
        this.prodstatusval[0].values[0] = temp.count;
      } else {
        this.prodstatusval[0].values[1] = temp.count;
      }
    }
  },
};
</script>
