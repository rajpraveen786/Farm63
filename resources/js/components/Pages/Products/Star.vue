<template>
  <star-rating
    class=""
    v-bind:increment="0.5"
    active-color="#60B302"
    :rounded-corners="true"
    :show-rating="false"
    :read-only="true"
    v-bind:star-size="12"
    v-model.number="datas"
  ></star-rating>
</template>

<script>
import StarRating from "vue-star-rating";
export default {
  components: {
    StarRating,
  },
  props: ["data"],
  data() {
    return {
        datas:parseInt(this.data)
    };
  },
  mounted() {},
  methods: {},
};
</script>
