<template>
  <div class="">
    <h6>Category</h6>
    <v-select
      class="bg-white"
      label="name"
      :options="datas"
      v-model="datasel"
      @input="(code) => setcat(code)"
    >
      <template #search="{ attributes, events }">
        <input
          class="vs__search"
          v-bind="attributes"
          v-on="events"
        />
      </template>
    </v-select>
    <div v-if="datasub.length > 0">
      <h6 class="mt-2">Sub Category</h6>
      <v-select
        class="bg-white"
        label="name"
        :options="datasub"
        v-model="dataselsub"
        @input="(code) => setsubcat(code)"
      >
        <template #search="{ attributes, events }">
          <input
            class="vs__search"
            v-bind="attributes"
            v-on="events"
          />
        </template>
      </v-select>
    </div>
    <input type="text" hidden name="cid" v-model="dataid" />
    <input type="text" hidden name="scid" v-model="datasubid" />

  </div>
</template>

<script>
export default {
  props: ["data", "olddataid", "oldsubdataid"],
  data() {
    return {
      dataid: this.olddataid,
      datasubid: this.oldsubdataid,
      datasel: "",
      dataselsub: "",
      datas: this.data,
      datasub: [],
    };
  },
  mounted() {
    for (var i = 0; i < this.data.length; i++) {
      if (this.dataid == this.data[i].id) {
        this.setcat(this.data[i]);
      }
    }
    if (this.datasubid) {
      for (var i = 0; i < this.datasub.length; i++) {
        if (this.datasubid == this.datasub[i].id) {
          this.setsubcat(this.datasub[i]);
        }
      }
    }
  },
  methods: {
    setcat(code) {
      if (code) {
        this.dataid = code.id;
        this.datasel = code.name;
        this.datasub = code.subcategory;
      } else {
        this.dataid = null;
        this.datasel = null;
        this.datasub = null;
      }
    },
    setsubcat(code) {
      if (code) {
        this.datasubid = code.id;
        this.dataselsub = code.name;
      } else {
        this.datasubid = null;
        this.dataselsub = null;
      }
    },
  },
};
</script>
