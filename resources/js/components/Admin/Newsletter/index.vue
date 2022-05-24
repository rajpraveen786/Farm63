<template>
  <div>
    <h5 class="mb-3 color-prim">Mail</h5>
    <div class="form-row my-2">
      <div class="form-group mt-2 col-md-6">
        <input
          type="text"
          class="input-hov form-control"
          autocomplete="off"
          name="subject"
          v-model="subject"
          id="inputSubject4"
          placeholder="Enter Subject"
        />
        <label for="inputSubject4">Subject</label>
        <small v-if="errors.subject" class="form-text text-danger">{{
          errors.subject
        }}</small>
      </div>
      <div class="col-sm-12 col-md-6 mt-2">
          
        <VueCtkDateTimePicker
          label="Select Send Date and Time"
          format="DD/MM/YY hh:mm a"
          :formatted="'DD/MM/YY hh:mm a'"
          minute-interval="15"
          v-model="datetime"
        />
        <span v-if="errors.datetime" class="text-danger">
          {{ errors.datetime }}
        </span>
      </div>
      <!-- <div class="col-12 my-3">
        <h5 class="text-center mb-4 font-prim">Choose template</h5>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="form-check w-100">
              <label class="w-100 position-relative form-check-label" style="top: 0">
                <input v-model="template" value="1" class="form-check-input" type="radio" name="flexRadioDefault" />
                <img loading="lazy" src="/storage/img/news1.jpg" alt="" class="w-100" />
              </label>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="form-check w-100">
              <label class="w-100 position-relative form-check-label" style="top: 0">
                <input v-model="template" value="2" class="form-check-input" type="radio" name="flexRadioDefault" />
                <img loading="lazy" src="/storage/img/news2.jpg" alt="" class="w-100" />
              </label>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="form-check w-100">
              <label class="w-100 position-relative form-check-label" style="top: 0">
                <input
                 v-model="template"
                  class="form-check-input"
                  type="radio"
                  name="flexRadioDefault"
                  value="3"
                  checked
                />
                <img loading="lazy" src="/storage/img/news3.jpg" alt="" class="w-100" />
              </label>
            </div>
          </div>
        </div>
      </div> -->
      <div v-show="template!=3" class="form-group mt-2 col-12">
        <label for="">Photo</label>
        <fileinput
          size="460px X 460px"
          id="loc"
          :error="errors.loc"
          name="loc"
        ></fileinput>
      </div>
      <div class="col-12" style="">
        <descinput name="content" title="" :content="content"></descinput>
        <input type="hidden" name="datetime" v-model="datetime" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "oldsubject",
    "oldcontent",
    "olddatetime",
    "oldtemplate",
    "oldloc",
    "errorsubject",
    "errordatetime",
    "errortemplate",
    "errorcontent ",
    "errorloc ",
  ],
  mounted() {},
  data() {
    return {
      subject: this.oldsubject,
      content: this.oldcontent,
      template:this.oldtemplate||1,
      datetime: this.olddatetime,
      errors: {
        subject: this.errorsubject,
        datetime: this.errordatetime,
        content: this.errorcontent,
        template: this.errortemplate,
        loc: this.errorloc,
      },
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    };
  },
  methods: {
    calamt() {
      this.fprice = Math.round(((this.fpricewtas * 100) / (100 + this.taxp)) * 100) / 100;
      this.taxa = 0;
      this.profit = this.fprice - this.cpi;
      this.margin = Math.round((this.profit / this.fprice) * 1000) / 10;
      if (this.taxp) {
        this.taxa = Math.round(this.fprice * this.taxp) / 100;
      }
    },
  },
};
</script>
