<template>
  <div>
    <div class="card shadow-custom mt-2" style="border-radius: 8px">
      <div class="card-body">
        <div>
          <h5 class="mb-3 color-prim">Minimum Requirements</h5>
          <button
            type="button"
            class="btn mx-2"
            v-on:click="changeminreq(0)"
            :class="[minreq == 0 ? 'btn-outline-primary' : 'btn-primary']"
          >
            None
          </button>
          <button
            type="button"
            class="btn mx-2"
            v-on:click="changeminreq(1)"
            :class="[minreq == 1 ? 'btn-outline-primary' : 'btn-primary']"
          >
            Minimum Purchase Amount
          </button>
          <button
            type="button"
            class="btn mx-2"
            v-on:click="changeminreq(2)"
            :class="[minreq == 2 ? 'btn-outline-primary' : 'btn-primary']"
          >
            Minimum Quantity of items
          </button>
        </div>
        <div class="form-row my-2" v-if="minreq > 0">
          <div class="form-group mt-2 col-md-12">
            <h6>
              <span v-if="minreq == 1">Enter the Money</span>
              <span v-else-if="minreq == 2">Enter the Product count</span>
            </h6>
            <input
              minreq="text"
              class="input-hov form-control"
              autocomplete="off"
              id="inputName4"
              placeholder="Enter Value"
              v-model.number="minreqdata"
            />

            <small v-if="errors.value" class="form-text text-danger">
              {{ errors.value }}</small
            >
            <div class="mt-2">Applies to all products.</div>
          </div>
          <br />
        </div>
      </div>
    </div>
    <input type="hidden" name="minreq" v-model="minreq" />
    <input type="hidden" name="minreqdata" v-model="minreqdata" />
  </div>
</template>

<script>
export default {
  props: ["data", "oldminreq", "errorminreq", "oldminreqdata", "errorminreqdata"],
  data() {
    return {
      minreq: this.oldminreq || 0,
      minreqdata: this.oldminreqdata || 0,
      errors: {
        minreq: this.errorminreq,
        minreqdata: this.errorminreqdata,
      },

      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  mounted() {
  },

  methods: {
    changeminreq(val) {
      this.minreq = val;
      this.minreqdata=0
    },
  },
};
</script>
