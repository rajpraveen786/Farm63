<template>
  <div>
    <h3>Redirects</h3>
    <h5>Link : {{ link }}</h5>
    <div class="row">
      <div class="col-sm-12 mt-2 col-md-6">
        <div class="form-group">
          <label for="linkt">Link</label>
          <select v-model="linkt" class="form-control" v-on:change="sellink" id="linkt">
            <option value="0">None</option>
            <option value="1">Hot Deals</option>
            <!-- <option value="2">New Products</option> -->
            <option value="3">Top Selling</option>
            <option value="4">Category</option>
            <option value="5">Brand</option>
            <option value="6">Product</option>
          </select>
        </div>
      </div>
      <div class="col-md-6 mt-2 col-sm-12" v-if="opts != null && opts.length > 0">
        <label for="">Sub Links</label>
        <v-select
          class="bg-white"
          label="name"
          v-model="optsels"
          :options="opts"
          @input="(code) => setsubvalue(code)"
        >
          <template #search="{ attributes, events }">
            <input class="vs__search" v-bind="attributes" v-on="events" />
          </template>
        </v-select>
      </div>

      <input type="hidden" v-model="linkt" name="linkt" />
      <input type="hidden" v-model="optsel" name="optsel" />
      <input type="hidden" v-model="link" name="link" />
    </div>
  </div>
</template>

<script>
export default {
  props: ["oldoptsel", "oldlinkt", "category", "brand", "products"],
  mounted() {
    this.sellinkvalue();
    for (var i = 0; i < this.opts.length; i++) {
      if (this.opts[i].id == this.oldoptsel) {
        this.optsel = this.opts[i].id;
        this.optsels = this.opts[i].name;
        this.link += "/" + this.opts[i].name;
      }
    }
  },
  data() {
    return {
      link: null,
      selopt: null,
      linkt: this.oldlinkt,
      opts: null,
      optsels: [],
      optsel: this.oldoptsel,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      capacity: [""],
    };
  },

  methods: {
    setsubvalue(code) {
      this.sellinkvalue();
      if (code) {
        this.optsel = code.id;
        this.optsels = code.urlslug;
        if (code.id) {
          this.link += "/" + code.urlslug;
        }
      } else {
        this.optsel = null;
        this.optsels = null;
      }
    },
    sellink(event) {
      var temp = [];
      this.linkt = event.target.value;
      this.sellinkvalue();
    },
    sellinkvalue() {
      var temp = null;
      this.opts = [];
      this.optsel = 0;
      this.optsels = "None";
      if (this.linkt.value == 0) {
        this.link = null;
      } else if (this.linkt == 1) {
        this.link = "/hotdeals";
      } else if (this.linkt == 2) {
        this.link = "/newproducts";
      } else if (this.linkt == 3) {
        this.link = "/featured";
      } else if (this.linkt == 4) {
        temp = this.category;
        temp.unshift({ id: 0, name: "None" });
        this.link = "/category";
        this.opts = temp;
      } else if (this.linkt == 5) {
        temp = this.brand;
        temp.unshift({ id: 0, name: "None" });
        this.opts = temp;
        this.link = "/brand";
      } else if (this.linkt == 6) {
        temp = this.products;
        temp.unshift({ id: 0, name: "None" });
        this.opts = temp;
        this.link = "/products";
      }
    },
  },
};
</script>
