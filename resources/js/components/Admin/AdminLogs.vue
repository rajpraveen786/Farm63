<template>
  <div class="row">
    <div v-if="olddata" class="col-md-6 col-sm-12 mt-2">
      <h5>Old Data</h5>
      <table class="table">
        <thead>
          <tr>
            <th>Field</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(key, value) in olddata">
            <th>{{ value }}</th>
            <th>{{ key }}</th>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-if="newdata" class="col-md-6 col-sm-12 mt-2">
      <h5>New Data</h5>
      <table class="table">
        <thead>
          <tr>
            <th>Field</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(key, value) in newdata">
            <th>{{ value }}</th>
            <th>{{ key }}</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: ["olddata", "newdata"],
  data() {
    return {};
  },
  mounted() {},
};
</script>
