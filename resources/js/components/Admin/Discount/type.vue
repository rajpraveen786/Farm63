<template>
  <div>
    <div class="card shadow-custom mt-2" style="border-radius: 8px">
      <div class="card-body">
        <h5 class="mb-3 color-prim">Types</h5>

        <button
          type="button"
          class="btn mx-2"
          v-on:click="changediscounttype(0)"
          :class="[discounttype == 0 ? 'btn-outline-primary' : 'btn-primary']"
        >
          Percentage
        </button>
        <button
          type="button"
          class="btn mx-2"
          v-on:click="changediscounttype(1)"
          :class="[discounttype == 1 ? 'btn-outline-primary' : 'btn-primary']"
        >
          Fixed Amount
        </button>
        <div class="form-row my-2">
          <div class="form-group mt-2 col-md-12">
            <h6>
              Discount Value -
              <span v-if="discounttype == 0">%</span>
              <span v-else-if="discounttype == 1"><i class="fas fa-rupee-sign"></i></span>
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

        </div>
      </div>
    </div>
    <div class="card shadow-custom mt-2" style="border-radius: 8px">
      <div class="card-body">
          <h5 class="mb-3 color-prim">Applies To</h5>
          <div class="container-fluid">
            <button
              type="button"
              class="btn mx-2 mt-2"
              v-on:click="changeappliesfor(0)"
              :class="[appliesfor == 0 ? 'btn-outline-primary' : 'btn-primary']"
            >
              All products
            </button>
            <button
              type="button"
              class="btn mx-2 mt-2"
              v-on:click="changeappliesfor(1)"
              :class="[appliesfor == 1 ? 'btn-outline-primary' : 'btn-primary']"
            >
              Specific Category
            </button>
            <button
              type="button"
              class="btn mx-2 mt-2"
              v-on:click="changeappliesfor(2)"
              :class="[appliesfor == 2 ? 'btn-outline-primary' : 'btn-primary']"
            >
              Specific Products
            </button>
            <div v-if="errors.appliesfor" class="mt-3 text-danger">
              {{ errors.appliesfor }}
            </div>
          </div>

        <hr />
        <h5 class="mb-3 color-prim">
          <span v-if="appliesfor == 1">Category</span>
          <span v-else-if="appliesfor == 2">Products</span>
          <span v-else></span>
        </h5>

        <multiselect
          v-if="appliesfor != 0"
          v-model="appliesfordata"
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
        ></multiselect>
      </div>
    </div>
    <input type="hidden" name="discounttype" v-model="discounttype" />
    <input type="hidden" name="appliesfor" v-model="appliesfor" />
    <input type="hidden" name="value" v-model="value" />
    <input type="hidden" name="optid" v-model="optid" />
    <input type="hidden" :value="JSON.stringify(appliesfordata)" name="appliesfordata" />
  </div>
</template>

<script>
export default {
  props: [
    "data",
    "olddiscounttype",
    "oldvalue",
    "oldappliesfor",
    "oldappliesfordata",
    "oldoptid",
    "category",
    "products",

    "errorvalue",
    "errordiscounttype",
    "errorappliesfordata",
    "errorappliesfor",
  ],
  data() {
    return {
      discounttype: this.olddiscounttype || 0,
      appliesfor: this.oldappliesfor || 0,
      value: this.oldvalue || 0,
      appliesfordata: [],
      oolsappliesfordata: [],
      options: [],
      optid: [],
      errors: {
        value: this.errorvalue,
        discounttype: this.errordiscounttype,
        appliesfor: this.errorappliesfor,
        appliesfordata: this.errorappliesfordata,
      },

      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    };
  },
  mounted() {
    if (this.oldappliesfordata) {
      this.appliesfordata = JSON.parse(this.oldappliesfordata);
      this.oolsappliesfordata = JSON.parse(this.oldappliesfordata);
    }
    this.changediscounttype(this.olddiscounttype);
    this.changeappliesfor(this.oldappliesfor);

    for (var i = 0; i < this.oolsappliesfordata.length; i++) {
      for (var j = 0; j < this.options.length; j++) {
        if (this.oolsappliesfordata[i].id == this.options[j].id) {
          this.addTagdata(this.options[j]);
        }
      }
    }
    this.appliesfordata = this.oolsappliesfordata;
  },

  methods: {
    changediscounttype(val) {
      this.discounttype = val;
      this.value = 0;
    },
    changeappliesfor(val) {
      this.appliesfor = val;
      this.appliesfordata = null;
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
      this.appliesfordata.push(tag);
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
      //   this.appliesfordata.push(tag);
      //   this.tags = JSON.stringify(this.value);
      this.optid.splice(this.optid.indexOf(removeTags.id), 1);
    },
  },
};
</script>
