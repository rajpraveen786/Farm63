<template>
  <div>
    <h5 class="mb-2 color-prim">Start Date</h5>
    <VueCtkDateTimePicker
      label="Select Start Date"
      format="DD/MM/YY"
      :formatted="'DD/MM/YY'"
      :only-date="truex"
      minute-interval="15"
      v-model="startdate"
    />
    <span v-if="errors.startdate" class="text-danger">
        {{ errors.startdate }}
    </span>
    <h5 class="mt-2 color-prim">Start Time</h5>
    <VueCtkDateTimePicker
        class="mt-2"
        format="hh:mm a"
        :formatted="'hh:mm a'"
        label="Select End Time"
        :only-time="truex"
        minute-interval="15"
      v-model="starttime"
    />
    <span v-if="errors.starttime" class="text-danger">
        {{ errors.starttime }}
    </span>
      <h5 class="mb-2 mt-3 color-prim">End Date</h5>
      <VueCtkDateTimePicker
        label="Select End Date"
        format="DD/MM/YY"
        :formatted="'DD/MM/YY'"
      :only-date="truex"
        minute-interval="15"
        v-model="enddate"
      />
    <span v-if="errors.enddate" class="text-danger">
        {{ errors.enddate }}
    </span>
      <h5 class="mt-2 color-prim">End Time</h5>
      <VueCtkDateTimePicker
        class="mt-2"
        format="hh:mm a"
        :formatted="'hh:mm a'"
        label="Select End Time"
        :only-time="truex"
        minute-interval="15"
        v-model="endtime"
      />
    <span v-if="errors.endtime" class="text-danger">
        {{ errors.endtime }}
    </span>
      <input type="hidden" name="startdate" v-model="startdate">
      <input type="hidden" name="starttime" v-model="starttime">
      <input type="hidden" name="enddate" v-model="enddate">
      <input type="hidden" name="endtime" v-model="endtime">
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
