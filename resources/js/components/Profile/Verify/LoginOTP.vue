<template>
  <div>
    <div v-if="loading">
      <div class="row justify-content-center align-items-center">
        <div class="col-sm-12 col-md-6 mt-2 text-center">
          <div class="text-center">
            <div
              class="spinner-border"
              style="width: 6rem; height: 6rem"
              role="status"
            >
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="!loading" class="">
      <div class="container my-5">
        <div class="row">
          <div class="col-md-4 col-sm-12 mb-5">
            <h6 class="small font-prim font-weight-bold color-prim">Registered Name</h6>
            <h5 class="text-muted">{{ user.name }}</h5>
            <h6 class="small font-prim font-weight-bold color-prim mt-4">Registered Email</h6>
            <h5 class="text-muted">{{ user.email }}</h5>
            <h6 class="small font-prim font-weight-bold color-prim mt-4">Registered Phone No.</h6>
            <h5 class="text-muted">{{ user.phno }}</h5>
          </div>
          <div class="col-md-8 col-sm-12">
            <h4 class="py-2 font-prim">OTP Verification</h4>
            <div class="form-group row mt-4">
              <div class="col-md-12">
                <!-- <input
                  id="name"
                  type="text"
                  maxlength="6"
                  v-model="otp"
                  class="form-control name-in no-foc"
                  name="name"
                  :class="[error ? 'is-invalid' : '']"
                  required
                  autofocus
                /> -->

                <input
                  id="name"
                  type="text"
                  v-model="otp"
                  class="form-control"
                  name="name"
                  :class="[error ? 'is-invalid' : '']"
                  required
                  placeholder="Enter OTP"
                  autofocus
                />
                <!-- <input
                  id="name"
                  type="text"
                  v-model="otp"
                  class="form-control"
                  name="name"
                  :class="[error ? 'is-invalid' : '']"
                  required
                  autofocus
                /> -->
                <span v-if="error" class="invalid-feedback" role="alert">
                  <strong>{{ error }}</strong>
                </span>
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col">
                <button
                  type="button"
                  class="btn btn-login-custom mt-1"
                  v-on:click="verifyotp"
                >
                  Verify
                </button>
                <button
                  type="button"
                  :disabled="!(countDown == 0)"
                  class="btn btn-outline-success mt-1 mx-1"
                  v-on:click="resendotp"
                >
                  Resend OTP <span v-if="countDown > 0">( {{ countDown }} )</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      error: "",
      loading: 1,
      otp: "",
      countDown: 10,
    };
  },
  mounted() {
    this.countDownTimer();
    this.loading=0
  },
  methods: {
    verifyotp() {
      var self = this;
      if (this.otp) {
        this.loading = 1;
        axios
          .post("/otpverify", {
            otp: this.otp,
            uid: this.user.id,
          })
          .then((res) => {
            if (res.data.error) {
              self.error = res.data.errordata;
            } else {
              window.location.href = "/profile";
            }
          })
          .catch((err) => {
            console.error(err);
          });
        this.loading = 0;
      } else {
        Vue.swal({
          title: "Oops.",
          text: "Please Enter an OTP.",
          icon: "error",
        });
      }
    },
    resendotp() {
      this.loading = 1;
      var self=this
      axios
        .post("/otpresend", {
          uid: this.user.id,
        })
        .then((res) => {
          Vue.swal({
            text: "Please check your email. OTP is sent.",
            icon: "sucess",
          });
        })
        .catch((err) => {
          console.error(err);
        }).then((res) => {

        self.loading = 0;
        })
        .catch((err) => {
          console.error(err);
        })

        ;
      this.loading = 0;
      this.countDown = 25;
      this.countDownTimer();
    },

    countDownTimer() {
      if (this.countDown > 0) {
        setTimeout(() => {
          this.countDown -= 1;
          this.countDownTimer();
        }, 1000);
      }
    },
  },
};
</script>
