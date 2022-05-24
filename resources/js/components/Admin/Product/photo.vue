<template>
  <div class="border border-dark p-3" style="border-radius: 20px">
    <h5 class="color-prim">Medias</h5>
    <vue-dropzone
      ref="myVueDropzone"
      id="dropzone"
      :options="dropzoneOptions"
    ></vue-dropzone>
    <div class="row">
      <div class="col-sm-12 col-md-3 mt-2" v-for="(item, index) in datas">
        <img loading="lazy" :src="'/' + item.loc" class="w-100" />
        <div class="text-center mt-2 p-1">
          <button type="button" class="btn btn-outline-danger" v-on:click="delphoto(index)">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";

import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  components: {
    vueDropzone: vue2Dropzone,
  },
  props: ["link", "data"],
  mounted() {},
  data() {
    return {
        datas:this.data,
      dropzoneOptions: {
        url: this.link,
        acceptedFiles: ".jpg,.jpeg,image/webp,.png,.gif",
        maxFiles: 6,
        addRemoveLinks: false,
        maxFilesize: 100,
        headers: {
          "X-CSRF-TOKEN":
            document.head.querySelector("[name=csrf-token]").content,
        },
      },
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },

  methods: {
    delphoto(index) {
        var self=this
      if (confirm("do you want ot delete?")) {
          axios.post('/admin/products/deletephoto',{
              id:this.data[index].id
          })
          .then(res => {
              self.datas.splice(index,1);

            Vue.swal({
              title: "Sucess.",
              text: "Media deletion successfull.",
              icon: "success",
            });
          })
          .catch(err => {
              console.error(err);
          })
      }
    },
  },
};
</script>
