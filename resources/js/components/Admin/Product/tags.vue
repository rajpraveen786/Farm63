<template>
  <div>
    <h6>{{ title }}</h6>
    <multiselect
      v-model="value"
      tag-placeholder="Add this as new tag"
      placeholder="Search or add a tag"
      :options="options"
      :multiple="true"
      :taggable="true"
      @tag="addTag"
    ></multiselect>
    <!-- <pre class="language-json"><code>{{ value  }}</code></pre> -->
    <input type="hidden" :value="JSON.stringify(value)" :name="formname" />
  </div>
</template>

<script>
export default {
  props: ["data", "olddataid", "title", "label", "formname"],
  data() {
    return {
      options: this.data??[],
      value: [],
      tags: "",
    };
  },
  mounted() {
      var xata=this.olddataid
      if(typeof(xata)!='object'){
          this.value =JSON.parse(xata)
      }
      else{
          this.value=xata
      }
  },
  methods: {
    addTag(newTag) {
      this.options.push(newTag);
      this.value.push(newTag);
      this.tags = JSON.stringify(this.value);
    },
  },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
