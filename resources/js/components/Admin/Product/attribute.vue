<template>
  <div>
    <button
      class="btn btn-outline-primary float-right"
      type="button"
      v-on:click="additem"
    >
      <i class="fa fa-plus" aria-hidden="true"></i>
    </button>
    <h5 class="color-prim">Additional Information</h5>
    <div class="mt-2">
      <div
        class="mt-3 mb-2 border-dark"
        v-for="(item, index) in forms"
        :key="index+'123'"
      >
        <div class="row justify-content-center align-items-center">
          <div class="mt-2 p-2 col-11">
            <div class="form-group">
              <label :for="'attriselect' + index">Title</label>
              <select
                class="form-control"
                :id="'attriselect' + index"
                v-model="item.key"
              >
                <option v-for="(item1, index1) in data" :value="item1.name">
                  {{ item1.name }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <vue-editor class="mt-2" v-model="item.value"></vue-editor>
            </div>
          </div>
          <div class="col-1">
            <button
              type="button"
              class="btn btn-outline-danger"
              v-on:click="delrow(index)"
            >
              <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" :value="JSON.stringify(forms)" name="attribute" />

  </div>
</template>

<script>
export default {
  props: ["data",'oldattribute'],
  mounted() {},
  data() {
    return {
      forms: JSON.parse(this.oldattribute)??[],
      errors: {
        cpi: this.errorcpi,
      },

      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },

  methods: {
    additem() {
      var temp = {
        key: "",
        value: "",
      };
      this.forms.push(temp);
    },
    delrow(index) {
      if (confirm("do you want to delete?")) this.forms.splice(index, 1);
    },
  },
};
</script>
