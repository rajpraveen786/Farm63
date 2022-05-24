<template>
  <div class="position-relative">
    <v-select
      class="bg-white"
      :label="label"
      :options="data"
      v-model="datasel"
      @input="(code) => setcat(code)"
    >
          <!-- :required="!dataid" -->
      <template #search="{ attributes, events }">
        <input
          class="vs__search"
          v-bind="attributes"
          v-on="events"
        />
      </template>
    </v-select>
    <input type="text" hidden :name="formname" v-model="dataid" />
    <label class="">{{ title }}</label>
  </div>
</template>

<script>
export default {
  props: ["data", "olddataid", "title", "label", "formname"],
  data() {
    return {
      dataid: this.olddataid,
      datasel: "",
    };
  },
  mounted() {
    for (var i = 0; i < this.data.length; i++) {
      if (this.dataid == this.data[i].id) {
        this.setcat(this.data[i]);
      }
    }
  },
  methods: {
    setcat(code) {
      if (code) {
        this.dataid = code.id;
        this.datasel = code.name;
      } else {
        this.dataid = null;
        this.datasel = null;
      }
    },
  },
};
</script>
