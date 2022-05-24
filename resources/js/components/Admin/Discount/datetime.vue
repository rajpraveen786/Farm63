<template>
  <div>
    <h5 class="mb-2 color-prim">Start Date</h5>
    <VueCtkDateTimePicker
      label="Select Start Date"
      format="DD/MM/YY hh:mm a"
      :formatted="'DD/MM/YY hh:mm a'"
      minute-interval="15"
      v-model="startdate"
    />
    <span v-if="errors.startdate" class="text-danger">
        {{ errors.startdate }}
    </span>
      <h5 class="mb-2 mt-3 color-prim">End Date</h5>
      <VueCtkDateTimePicker
      label="Select End Date"
      format="DD/MM/YY hh:mm a"
      :formatted="'DD/MM/YY hh:mm a'"
      minute-interval="15"
      v-model="enddate"
    />
    <span v-if="errors.enddate" class="text-danger">
        {{ errors.enddate }}
    </span>

      <input type="hidden" name="startdate" v-model="startdate">
      <input type="hidden" name="enddate" v-model="enddate">
     </div>
</template>

<script>
export default {
  props: [
        "oldstarttime",
        "oldstartdate",
        "oldenddate",
        "oldendtime",
        "errorstartdate",
        "errorstarttime",
        "errorenddate",
        "errorendtime",
    ],
  mounted() {},
  data() {
    return {
      startdate: this.oldstartdate,
      starttime: this.oldstarttime,
      enddate: this.oldenddate,
      truex:true,
      endtime: this.oldendtime,
      errors:{
          startdate:this.errorstartdate,
          starttime:this.errorstarttime,
          enddate:this.errorenddate,
          endtime:this.errorendtime,
      },
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },

  methods: {
  },
};
</script>
