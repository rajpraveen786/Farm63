<template>
  <div class="">
    <input
      type="file"
      :name="name"
      @change="changeinput"
      class="real-file custom-text-1"
      hidden="hidden"
      :id="id"
    />
    <button type="button" @click="clickinput" id="custom-button">CHOOSE A PHOTO</button>
    <span :id="id + 'label'">No file chosen, yet.</span>
    <small class="form-text text-muted">Image must be of size {{size}}</small>
    <small class="form-text text-danger" v-if="error">{{ error }}</small>

  </div>
</template>

<script>
export default {
  components: {},
  props: ["id","name", "error","size"],
  data() {
    return {};
  },
  mounted() {},
  methods: {
    clickinput(e) {
      document.getElementById(this.id).click();
    },
    changeinput(e) {
        const customTxt = document.getElementById(this.id+'label');
      if (e.target.value) {
        customTxt.innerHTML = e.target.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
      } else {
        customTxt.innerHTML = "No file chosen, yet.";
      }
    },
  },
};
</script>
