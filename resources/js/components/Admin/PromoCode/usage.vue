<template>
  <div>
    <div class="card shadow-custom mt-2 p-2 mb-3" style="border-radius: 8px">
      <div class="card-body">
        <div class="mt-2">
          <h5 class="mb-3 color-prim">Usage limits</h5>
          <div class="form-group mt-4">
            <h6>Limit number of times this discount can be used in total</h6>
            <input
              type="text"
              class="input-hov form-control"
              autocomplete="off"
              id="inputCode4"
              name="noofuse"
              placeholder="Enter Number of usage"
              v-model="noofuse"
            />
            <small v-if="errors.noofuse" class="form-text text-danger">
              {{ errors.noofuse }}</small
            >
            <small>Leave it to zero for unlimited usage</small>
          </div>
          <div class="form-group form-check">
            <input
              type="checkbox"
              class="form-check-input"
              name="oneuse"
              value="1"
              v-model="oneuse"
              id="oneuse"
            />
            <label class="form-check-label mx-2" for="oneuse"
              >Limit to one use per customer</label
            >
          </div>
          <small v-if="errors.oneuse" class="form-text text-danger">{{
            errors.oneuse
          }}</small>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["oldnoofuse", "oldoneuser", "erroroneuser", "errornoofuse"],
  data() {
    return {
      check: 0,
      noofuse: this.oldnoofuse || 0,
      oneuse: this.oldoneuse || 0,
      errors: {
        noofuse: this.errornoofuse,
        oneuse: this.erroroneuse,
      },

      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  mounted() {},

  methods: {},
};
</script>
