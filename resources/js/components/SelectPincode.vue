<template>
  <div>
    <div class="dropdown dropcustom" style="z-index: 2000">
      <a
        class="btn"
        id="locmenu"
        data-toggle="collapse"
        aria-expanded="false"
        href="#loccard"
        role="button"
      >
        <img
          loading="lazy"
          src="/storage/tryimg/vakilimg/icons/map-pinblack.svg"
          style="transform: scale(0.9)"
        />
        <span class="d-none d-md-inline"> Pincode</span>
      </a>
      <div class="collapse" aria-labelledby="locmenu" id="loccard">
        <div class="text-center card card-body">
          <img
            loading="lazy"
            src="/storage/tryimg/vakilimg/loccard2.webp"
            alt="/"
            class="w-100"
          />
          <h5 class="font-prim mt-3 font-weight-bold">Check Your Serviceability</h5>
          <p class="text-muted">
            Enter a Pincode To check whether we deliver to your area
          </p>
          <div class="input-group mb-3">
            <input
              v-model="checkpincode"
              type="text"
              class="form-control"
              placeholder="Enter Pincode"
              aria-label="Enter Pincode"
              aria-describedby="basic-addon2"
            />
            <button
              class="px-4 btn-success bg-success text-white btn input-group-text"
              id="basic-addon2"
              v-on:click="checkservicability"
            >
              Check
            </button>
          </div>
          <!-- <div class="btn btn-block w-100 mt-0 btn-custom-gradient">
            <i class="fas fa-shopping-cart mr-3"></i>Shop Now
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["address", "sid"],
  data() {
    return {
      pinid: this.sid,
      pincode: null,
      checkpincode: "",
    };
  },
  mounted() {
    this.setval(this.sid);
  },
  methods: {
    setval(id) {},
    changeaddress(e) {
      this.setval(e.target.value);
      $("#selectloc").modal("hide");
      axios
        .post("/changepincode", {
          aid: e.target.value,
        })
        .then((res) => {})
        .catch((err) => {
          console.error(err);
        });
    },
    checkservicability() {
      if (this.checkpincode != "") {
        axios
          .post("/checkpincode", {
            pincode: this.checkpincode,
          })
          .then((res) => {
            if (res.data.success) {
              Vue.swal.fire({
                icon: "success",
                title: res.data.title,
                text: res.data.message,
              });
            } else {
              Vue.swal.fire({
                icon: "error",
                title: res.data.title,
                text: res.data.message,
              });
            }
          }).then(()=>{
$('.collapse').collapse('hide')
this.checkpincode=''
          })
          .catch((err) => {
            console.error(err);
          });
      } else {
        Vue.swal.fire({
          icon: "error",
          title: "Error !!!",
          text: "Please Enter a valid Pincode",
        });
      }
    },
  },
};
</script>
