<template>
  <div class="contact-details">
      <form onsubmit="return toSubmit();">
        <div class="form-group">
            <label class="w-100 py-0 my-0">
                Name
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    v-model="name"
                >
            </label>
        </div>
        <div class="form-group">
            <label class="w-100 py-0 my-0">
                Email
                <input
                    type="email"
                    name="email"
                    v-model="email"
                    class="form-control"
                >
            </label>
        </div>
        <div class="form-group">
            <label class="w-100 py-0 my-0">
                Phone No.
                <input
                    type="text"
                    name="phno"
                    v-model="phno"
                    class="form-control"
                >
            </label>
        </div>
        <div class="form-group">
            <label class="w-100 py-0 my-0">
                Talk to Us...
                <textarea v-model="msg" class="form-control" rows="3"></textarea>
            </label=>
        </div>
        <button
            v-on:click="save"
            type="button"
            class="btn btn-login-custom mt-3">
            Submit
        </button>
      </form>
  </div>
</template>



<script>
export default {
  mounted() {},
  data() {
    return {
      name: "",
      email: "",
      phno: "",
      msg: "",
    };
  },
  methods: {
    toSubmit() {
      alert("I will not submit");
      return false;
    },
    save() {
      var self = this;
      if (
        this.name.length > 0 &&
        this.email.length > 0 &&
        this.phno.length > 0 &&
        this.msg.length > 0
      ) {
        axios
          .post("/contactus", {
            name: this.name,
            email: this.email,
            phno: this.phno,
            msg: this.msg,
          })
          .then((res) => {
            if (res.data.success) {
              Vue.swal({
                title: res.data.title,
                text: res.data.message,
                icon: "success",
              });
              self.name = null;
              self.email = null;
              self.phno = null;
              self.msg = null;
            } else {
              Vue.swal.fire({
                icon: "error",
                title: res.data.title,
                text: res.data.message,
              });
            }
          })
          .catch((err) => {
            console.error(err);
          });
      } else {
        Vue.swal({
          title: "Data Missing.",
          text: "Please enter all the details.",
          icon: "error",
        });
      }
    },
  },
};
</script>
