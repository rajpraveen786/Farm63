<template>
  <div id="mx-0" class="card border-0 shadow text-center card-body card-prod-ms">

    <a :href="'/products/' + data.urlslug">
      <img
      v-if="data.image.loc"
        :src="'/' + data.image.loc"
        :alt="data.name"
        class="card-img-top img-prod-ms"
      />

      <span class="discount pos" v-if="data.disp"
        ><div id="cut-diamond">{{ data.disp }} <span> % OFF</span></div></span
      >
      <h6 class="font-prim color-prim mt-2 mb-0 font-weight-bold">
        {{ data.name }}
      </h6>
    </a>
    <span class="btn btn-danger wish" v-on:click="wishlist">
        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2124 2.20295C15.0151 2.58924 13.9801 3.64757 13.577 4.89795C13.3709 5.53792 13.0407 5.94164 12.7236 5.94164C12.4393 5.94164 11.7327 6.27408 11.1538 6.68029L10.1013 7.41863L9.03956 6.68029C6.93015 5.21264 3.68305 6.0786 2.49791 8.42528C1.27538 10.8457 2.37751 14.5206 5.00013 16.7689C7.42968 18.851 9.75222 20.5714 10.1341 20.5714C10.6035 20.5714 15.2823 16.7316 16.2993 15.5117C17.4009 14.1907 17.6204 13.7639 18.019 12.1671C18.2841 11.1047 18.5291 10.7418 19.0332 10.6652C20.1138 10.5008 21.7157 8.6245 21.9407 7.25957C22.4758 4.0186 19.2932 1.20937 16.2124 2.20295ZM19.7894 3.96724C20.7507 4.95149 21.0238 5.8853 20.7644 7.30159C20.499 8.74901 19.6416 9.43007 17.8654 9.605C16.4954 9.73978 16.2708 9.66601 15.4301 8.80535C14.6621 8.01907 14.504 7.60882 14.504 6.4017C14.504 5.17498 14.6524 4.80457 15.4483 4.04319C16.7414 2.80651 18.6237 2.77352 19.7894 3.96724ZM17.1941 4.4631C17.1686 4.67726 17.1342 5.0623 17.1181 5.3191C17.1011 5.5871 16.732 5.82803 16.2522 5.88437C15.2145 6.0067 15.1145 6.87546 16.1382 6.87546C16.6973 6.87546 16.9013 7.08619 17.0427 7.80928C17.1497 8.35711 17.417 8.74309 17.6888 8.74309C18.0013 8.74309 18.1524 8.43867 18.1524 7.80928C18.1524 6.97351 18.2509 6.87546 19.0898 6.87546C20.253 6.87546 20.1487 6.1421 18.9651 5.99892C18.2908 5.91705 18.1524 5.74492 18.1524 4.98728C18.1524 4.3831 17.998 4.07401 17.6964 4.07401C17.4456 4.07401 17.2193 4.24926 17.1941 4.4631ZM9.06814 8.11339L10.1779 9.02635L10.744 8.38606C11.0553 8.0337 11.705 7.5366 12.1872 7.28105C12.9157 6.89538 13.1085 6.8876 13.3234 7.23529C13.466 7.46532 13.5846 7.8099 13.5873 8.00071C13.5961 8.65811 14.912 10.0644 15.9232 10.4971C17.2327 11.0571 17.2753 12.1789 16.0582 14.0344C15.2702 15.2356 10.7428 19.2974 10.1687 19.3179C9.82276 19.3304 7.83162 17.8011 5.90251 16.0406C3.09534 13.4791 2.32279 10.7997 3.74902 8.57096C4.94054 6.70955 7.13264 6.52092 9.06814 8.11339Z" fill="white"/>
        </svg>
    </span>

    <div class="price my-0">
      <span class="price-old" v-if="data.disp">Rs. {{ data.fpricebefdis }}</span> <br>
      <span class="price-new font-prim">Rs. {{ data.fpricewtas }}</span>
    </div>
    <div class="quantity-counter my-0">
      <button v-on:click="changeval(-1)" id="counter-decrement" class="decrement">
        -
      </button>
      <input v-model="qty" id="counter-value" class="value" type="number" value="0" />
      <button v-on:click="changeval(1)" id="counter-increment" class="increment">
        +
      </button>
    </div>
    <div class="btn btn-custom-gradient mt-2" v-on:click="addtocart">Add to Cart</div>
  </div>
</template>

<script>
export default {
  props: ["data", "newdata"],
  data() {
    return {
      qty: 1,
    };
  },
  mounted() {},
  methods: {
    changeval(val) {
      if (this.qty + val > 0 && this.qty + val < 12) {
        this.qty += val;
      }
    },
    addtocart() {
    //   if (this.user) {
        var self = this;
        axios
          .post("/cart/new", {
            // uid: this.user.id,
            pid: this.data.id,
            qty: this.qty,
          })
          .then((res) => {
            Vue.swal({
                title: res.data.title,
                text: res.data.message,
                icon: res.data.success ? "success" : "error",
              });
            document.getElementById('cartcount').innerHTML=res.data.count??0;
            self.qty = 1;
          })
          .catch((err) => {
            console.error(err);
          });
    //   } else {
    //     Vue.swal.fire({
    //       icon: "error",
    //       title: "Login...",
    //       text: "Please Login to Proceed",
    //       footer: '<a href="/login" style="color:blue">Please click to Login?</a>',
    //     });
    //   }
    },
    wishlist() {
    //   if (this.user) {
        var self = this;
        axios
          .post("/profile/wishlist/new", {
            // uid: this.user.id,
            pid: this.data.id,
          })
          .then((res) => {
              document.getElementById('wishcount').innerHTML=res.data.count ;
            Vue.swal({
                title: res.data.title,
                text: res.data.message,
                icon: res.data.success ? "success" : "error",
              });
          })
          .catch((err) => {
              console.error(err);
          });
    //   } else {
    //     Vue.swal.fire({
    //       icon: "error",
    //       title: "Login...",
    //       text: "Please Login to Proceed",
    //       footer: '<a href="/login" style="color:blue">Please click to Login?</a>',
    //     });
    //   }
    },
  },
};
</script>
