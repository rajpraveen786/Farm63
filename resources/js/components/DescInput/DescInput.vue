<template>
  <div class="">
      <h6>{{title}}</h6>
    <vue-editor v-model="datas"></vue-editor>
    <input type="hidden" :name="names" v-model="datas" />
  </div>
</template>

<script>
export default {
  props: ["content", "name",'title'],

  mounted() {},
  data() {
    return {
      datas: this.content,
      names:this.name,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
};
</script>
