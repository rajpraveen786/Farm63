<template>
  <div>
    <h4 class="color-prim">Additional Information</h4>
    <div class="mt-2">
      <table class="table table-responsive-sm table-bordered">
        <tbody>
          <tr class="align-middle" v-for="(item, index) in JSON.parse(data)" style="height:max-content">
            <td  class="align-middle">
              {{ item.key }}
            </td>
            <td  class="align-middle">
              <descview  class="align-middle" :content="item.value"></descview>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: ["data", "oldattribute"],
  mounted() {
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },

  methods: {},
};
</script>
