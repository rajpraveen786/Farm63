<template>
  <div>
    <div class="card shadow-custom mt-2" style="border-radius: 8px">
      <div class="card-body"><button
          class="float-right btn btn-outline-primary"
          type="button"
          v-on:click="gencode"
        >
          Generate Code
        </button>
        <h5 class="mb-3 color-prim">Code</h5>
        <div class="form-group mt-4 col-md-12">
          <input
            type="text"
            class="input-hov form-control"
            autocomplete="off"
            id="inputCode4"
            name="code"
            placeholder="Enter Code"
            v-model="code"
          />
          <small v-if="errors.code" class="form-text text-danger">
            {{ errors.code }}</small
          >
        </div>
        <hr>
        <h5 class="mb-3 color-prim">Types</h5>

        <button
          v-if="type == 0"
          type="button"
          class="btn mx-2"
          v-on:click="changetype(0)"
          :class="[type == 0 ? 'btn-outline-primary' : 'btn-primary']"
        >
          Percentage
        </button>
        <button
          v-else-if="type == 1"
          type="button"
          class="btn mx-2"
          v-on:click="changetype(1)"
          :class="[type == 1 ? 'btn-outline-primary' : 'btn-primary']"
        >
          Fixed Amount
        </button>
      </div>
    </div>
    <div class="card shadow-custom mt-2" style="border-radius: 8px">
      <div class="card-body">
        <h5 class="mb-3 color-prim">Value</h5>

        <div class="form-row my-2">
          <div class="form-group mt-2 col-md-12">
            <h6>
              Discount Value -
              <span v-if="type == 0">%</span>
              <span v-else-if="type == 1"
                ><i class="fas fa-rupee-sign"></i
              ></span>
            </h6>
            <input
              type="text"
              class="input-hov form-control"
              autocomplete="off"
              id="inputName4"
              placeholder="Enter Value"
              v-model="value"
            />

            <small v-if="errors.value" class="form-text text-danger">
              {{ errors.value }}</small
            >
          </div>
          <br />
          <hr />
          <h5 class="mb-3 color-prim">Applies To</h5>
          <br />
          <!-- <div class="container-fluid">
            <button
              v-if="subtype == 0"
              type="button"
              class="btn mx-2 mt-2"
              v-on:click="changesubtype(0)"
              :class="[subtype == 0 ? 'btn-outline-primary' : 'btn-primary']"
            >
              All products
            </button>
            <button
              v-else-if="subtype == 1"
              type="button"
              class="btn mx-2 mt-2"
              v-on:click="changesubtype(1)"
              :class="[subtype == 1 ? 'btn-outline-primary' : 'btn-primary']"
            >
              Specific Category
            </button>
            <button
              v-else-if="subtype == 2"
              type="button"
              class="btn mx-2 mt-2"
              v-on:click="changesubtype(2)"
              :class="[subtype == 2 ? 'btn-outline-primary' : 'btn-primary']"
            >
              Specific Products
            </button>
            <div v-if="errors.subtype" class="mt-3 text-danger">
              {{ errors.subtype }}
            </div>
          </div> -->
        </div>
        <hr />
        <!-- <h5 class="mb-3 color-prim">
          <span v-if="subtype == 1">Category</span>
          <span v-else-if="subtype == 2">Products</span>
          <span v-else></span>
        </h5> -->

        <!-- <multiselect
          v-if="subtype != 0"
          v-model="subdata"
          tag-placeholder="Add this as new tag"
          placeholder="Search or add a tag"
          label="name"
          track-by="id"
          :options="options"
          openDirection="top"
          :multiple="true"
          @tag="addTag"
          @select="addTagdata"
          @remove="removeTag"
        ></multiselect> -->

      </div>
    </div>
    <input type="hidden" name="type" v-model="type" />
    <input type="hidden" name="subtype" v-model="subtype" />
    <input type="hidden" name="value" v-model="value" />
    <input type="hidden" name="optid" v-model="optid" />
    <input type="hidden" :value="JSON.stringify(subdata)" name="subdata" />
  </div>
</template>

<script>
export default {
  props: [
    "data",
    "oldtype",
    "oldvalue",
    "oldsubtype",
    "oldcode",
    "oldsubdata",
    "oldoptid",
    "category",
    "products",

    "errorvalue",
    "errorcode",
    "errortype",
    "errorsubdata",
    "errorsubtype",
  ],
  data() {
    return {
      type: this.oldtype || 0,
      subtype: this.oldsubtype || 0,
      value: this.oldvalue || 0,
      subdata: [],
      oolssubdata: [],
      code: this.oldcode || "",
      options: [],
      optid: [],
      errors: {
        value: this.errorvalue,
        type: this.errortype,
        code: this.errorcode,
        subtype: this.errorsubtype,
        subdata: this.errorsubdata,
      },
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  mounted() {
    if (this.oldsubdata) {
      this.subdata = JSON.parse(this.oldsubdata);
      this.oolssubdata = JSON.parse(this.oldsubdata);
    }
    this.changetype(this.oldtype);
    this.changesubtype(this.oldsubtype);

    for (var i = 0; i < this.oolssubdata.length; i++) {
      for (var j = 0; j < this.options.length; j++) {
        if (this.oolssubdata[i].id == this.options[j].id) {
          this.addTagdata(this.options[j]);
        }
      }
    }
    this.value = this.oldvalue;
    this.subdata = this.oolssubdata;
  },

  methods: {
    changetype(val) {
      this.type = val;
      this.value = 0;
    },
    changesubtype(val) {
      this.subtype = val;
      this.subdata = null;
      this.options = [];
      this.optid = [];
      if (val == 1) {
        this.options = this.category;
      } else if (val == 2) {
        this.options = this.products;
      }
    },
    addTag(newTag) {
      const tag = {
        name: newTag,
        id: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      };
      this.options.push(tag);
      this.subdata.push(tag);
      this.tags = JSON.stringify(this.value);
    },
    addTagdata(newTag) {
      if (!this.optid.includes(newTag.id)) {
        this.optid.push(newTag.id);
      }
    },
    removeTag(removeTags) {
      //   const tag = {
      //     name: newTag,
      //     id: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      //   };
      //   this.options.push(tag);
      //   this.subdata.push(tag);
      //   this.tags = JSON.stringify(this.value);
      this.optid.splice(this.optid.indexOf(removeTags.id), 1);
    },
    gencode(length) {
      let r = (Math.random() + 1).toString(36).substring(2).toUpperCase();
      this.code = r;
    },
  },
};
</script>
