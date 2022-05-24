<template>
  <div>
    <div class="form-row my-2">
      <div class="form-group mt-2 col-sm-12 col-md-6">
        <input
          type="text"
          step="0.25"
          class="input-hov form-control"
          :class="[errors.sku ? 'is-invalid ' : '']"
          autocomplete="off"
          name="sku"
          id="inputsku4"
          placeholder="Enter SKU"
          v-model.trim="sku"
        />
        <label for="inputsku4">SKU</label>
        <small v-if="errors.sku" class="form-text text-danger">{{
          errors.sku
        }}</small>
      </div>
      <div class="form-group mt-2 col-sm-12 col-md-6">
        <input
          type="text"
          class="input-hov form-control"
          :class="[errors.barcode ? 'is-invalid ' : '']"
          autocomplete="off"
          name="barcode"
          id="inputbarcode4"
          placeholder="Enter Barcode (ISBN, UPC, GTIN, etc.)"
          v-model.trim="barcode"
        />
        <label for="inputbarcode4">Barcode</label>
        <small v-if="errors.barcode" class="form-text text-danger">{{
          errors.barcode
        }}</small>
      </div>

      <div class="form-group mt-2 col-sm-12 col-md-6">
        <input
          type="number"
          step="any"
          class="input-hov form-control"
          :class="[errors.stock ? 'is-invalid ' : '']"
          autocomplete="off"
          name="stock"
          id="inputstock4"
          placeholder="Enter Stock"
          v-model.number="stock"
        />
        <label for="inputstock4">Stock</label>
        <small v-if="errors.stock" class="form-text text-danger">{{
          errors.stock
        }}</small>
      </div>

      <div class="form-group mt-2 col-sm-12 col-md-6">
        <input
          type="number"
          step="any"
          class="input-hov form-control"
          :class="[errors.minstock ? 'is-invalid ' : '']"
          autocomplete="off"
          name="minstock"
          id="inputminstock4"
          placeholder="Enter Minimum Stock"
          v-model.number="minstock"
        />
        <label for="inputstock4">Minimum Stock</label>
        <small v-if="errors.minstock" class="form-text text-danger">{{
          errors.minstock
        }}</small>
      </div>
      <div class="mt-2 col-sm-12 col-md-6">
        <div class="form-group form-check">
          <input
            type="checkbox"
            class="form-check-input"
            name="trackqty"
            value="1"
            v-model="trackqty"
            id="trackqty"
          />
          <label class="form-check-label mx-2" for="trackqty"
            >Track quantity</label
          >
        </div>
        <small v-if="errors.trackqty" class="form-text text-danger">{{
          errors.trackqty
        }}</small>
      </div>
      <div class="mt-2 col-sm-12 col-md-6">
        <div class="form-group form-check">
          <input
            type="checkbox"
            class="form-check-input"
            name="oosc"
            value="1"
            v-model="oosc"
            id="oosc"
          />
          <label class="form-check-label mx-2" for="oosc"
            >Continue selling when out of stock</label
          >
        </div>
        <small v-if="errors.oosc" class="form-text text-danger">{{
          errors.oosc
        }}</small>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "oldsku",
    "errorsku",

    "oldbarcode",
    "errorbarcode",

    "oldtrackqty",
    "errortrackqty",

    "oldoosc",
    "erroroosc",

    "oldstock",
    "errorstock",
    "oldminstock",
    "errorminstock",
  ],
  mounted() {},
  data() {
    return {
      sku: this.oldsku || "",
      barcode: this.oldbarcode || "",
      trackqty: this.oldtrackqty || "",
      oosc: this.oldoosc || "",
      stock: this.oldstock || 0,
      minstock: this.oldminstock || 0,
      errors: {
        sku: this.errorsku,
        barcode: this.errorbarcode,
        stock: this.errorstock,
        trackqty: this.errortrackqty,
        oosc: this.erroroosc,
        minstock: this.errorminstock,
      },

      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },

  methods: {},
};
</script>
