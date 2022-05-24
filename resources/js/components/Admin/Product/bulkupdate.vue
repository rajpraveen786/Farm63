<template>
  <div>
    <table class="table position-relative">
      <thead class="sticky-top" style="top: 8vh; background: #F8FAFC;">
        <tr>
          <th style="width: 45%">Name</th>
          <th style="width: 6%">Stock</th>
          <th style="width: 8%">Price</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in datas" :key="'items' + index">
          <th>{{ item.name }}</th>
          <th>
            <div class="p-0 form-group mt-2 col-md-12">
              <input
                type="text"
                class="input-hov form-control"
                autocomplete="off"
                name="namestock"
                id="inputName4"
                placeholder="Enter Name"
                v-model="stock[index]"
              />
            </div>
          </th>
          <th>
            <div class="p-0 form-group mt-2 col-md-12">
              <input
                type="text"
                class="input-hov form-control"
                autocomplete="off"
                name="nameprice"
                id="inputName4"
                placeholder="Enter Name"
                v-model="price[index]"
              />
            </div>
          </th>
        </tr>
      </tbody>
    </table>
    <input type="text" name="prodid" :value='prid' id="">
    <input type="text" name="stock" :value='stock' id="">
    <input type="text" name="price" :value='price' id="">
  </div>
</template>

<script>
export default {
  props: ["data"],
  mounted() {
    for (var i = 0; i < this.data.length; i++) {
      this.prid.push(this.data[i].id);
      this.stock.push(this.data[i].stock);
      this.price.push(this.data[i].fpricewtas);
    }
  },
  data() {
    return {
      datas: this.data,
      prid: [], //product id
      stock: [],
      price: [],
      errors: {
        cpi: this.errorcpi,
      },

      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    };
  },

  methods: {},
};
</script>
