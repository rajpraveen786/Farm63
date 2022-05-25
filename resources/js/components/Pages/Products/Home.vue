<template>
  <div class="container py-3">
    <form
      action="/profile/cart/checkout"
      method="POST"
      class="forms-"
      id="checkout"
      name="checkout"
      enctype="multipart/form-data"
    >
      <input type="hidden" name="_token" v-model="csrf" />

      <input type="hidden" name="qty" :value="[qty]" />
      <input type="hidden" name="id" :value="[data.id]" />
      <input type="hidden" name="name" :value="[data.name]" />
      <input type="hidden" name="disid" :value="[data.disid]" />
      <input type="hidden" name="disp" :value="[data.disp]" />
      <input type="hidden" name="disa" :value="[data.disa]" />
      <input type="hidden" name="fpricewtas" :value="[data.fpricewtas]" />
      <input type="hidden" name="fpricebefdis" :value="[data.fpricebefdis]" />
      <input type="hidden" name="taxp" :value="[data.taxp]" />
      <input type="hidden" name="weight" :value="[data.weight]" />
      <input type="hidden" name="length" :value="[data.length]" />
      <input type="hidden" name="breadth" :value="[data.breadth]" />
      <input type="hidden" name="width" :value="[data.width]" />
      <input type="hidden" name="weighttotal" :value="weighttotal" />
      <input type="hidden" name="qtotal" :value="qtotal" />
      <input type="hidden" name="mrptotal" :value="mrptotal" />
      <input type="hidden" name="discounttotal" :value="discounttotal" />
      <input type="hidden" name="nettotal" :value="nettotal" />
    </form>
    <div class="btn-group btn-group-toggle prod-qua mt-2" data-toggle="buttons">
      <button v-on:click="changeval(-1)" class="no-foc btn product-decrement-quantity">
        -
      </button>
      <input
        v-model="qty"
        type="button"
        name="options"
        value="0"
        class="no-foc btn quantity"
      />
      <button v-on:click="changeval(1)" class="no-foc btn product-decrement-quantity">
        +
      </button>
    </div>
    <div class="btn-group mt-2" role="group" aria-label="BUY">
      <button
        v-on:click="addtocart"
        type="button"
        class="btn mx-1 btn btn-danger rounded-pill px-3"
      >
        <i class="fas fa-shopping-cart mr-md-2"></i
        ><span class="small"> Add to Cart </span>
      </button>
      <button
        v-on:click="buynow"
        type="button"
        class="btn mx-1 btn-danger rounded-pill px-3"
      >
        <i class="fas fa-shopping-bag mr-2"></i><span class="small"> Buy Now </span>
      </button>
    </div>

    <div class="mt-2">
      <button
        v-on:click="wishlist"
        class="btn btn-light rounded-pill mx-1 text-muted small"
      >
        <i class="fas fa-heart"></i> <span class="small"> Add to Wishlist </span>
      </button>
      <a
        class="btn mx-1 rounded-pill btn-light text-muted small"
        :href="
          'mailto:?&amp;subject=Check%20this%20Product&body=Check%20out%20this%20product%20.' +
          link +
          '/products/' +
          data.urlslug
        "
        target="_blank"
        ><i class="fas fa-at mr-1"></i> <span class="small"> Email to a friend </span></a
      >
    </div>
    <form
      action="/profile/cart/checkout"
      method="POST"
      class="forms-"
      id="checkout"
      name="checkout"
      enctype="multipart/form-data"
    ></form>
  </div>
</template>

<script>
export default {
  props: ["data", "enablestock", "enableqty", "user", "link"],
  data() {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
      qty: 1,
      netweight: 0,
      mrptotal: 0,
      discounttotal: 0,
      qtotal: 0,
      weighttotal: 0,
      nettotal: 0,
    };
  },
  mounted() {
    this.calctotal();
  },
  methods: {
    changeselected(val) {
      this.selected = val;
    },
    changeval(val) {
      if (this.qty + val > 0 && this.qty + val < 12) {
        this.qty += val;
        this.calctotal();
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
      document.getElementById("cartcount").innerHTML = res.data.count ?? 0;
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
    calctotal() {
      var temp = this.data.fpricewtas;
      if (this.data.fpricebefdis) {
        var discount = (this.data.fpricebefdis - this.data.fpricewtas) * this.qty;
      } else {
        var discount = 0;
      }

      this.weighttotal = this.data.weight * this.qty;
      var mrp = temp * this.qty;

      this.qtotal = mrp;
      this.mrptotal = mrp;
      this.discounttotal = discount;
      this.nettotal = mrp;
    },
    buynow() {
      document.getElementById("checkout").submit();
    },
  },
};
</script>
