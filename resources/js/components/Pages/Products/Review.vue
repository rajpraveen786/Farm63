<template>
  <div>
    <div class="" style="max-height: 50vh; overflow: auto">
      <div
        class="mb-2 card h-100 card-body"
        v-for="(item, index) in datas"
        :key="key + 'qqeqwe' + index"
      >
        <div class="row">
          <div class="col-lg-1 col-md-2 col-3">
            <div class="app-logo">{{ item.customer.name[0] }}</div>
          </div>
          <div class="col-lg-11 col-md-10 col-9">
            <p class="font-prim font-weight-bold mb-0">
              {{ item.customer.name }} -
              <vue-moments-ago suffix="ago" :date="item.created_at" lang="en" />
            </p>
            <star :data="item.rating || 0"></star>
            <p class="text-muted mb-0">
              {{ item.review }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="" id="reviewadd">
      <div class="card mt-4 position-relative shadow border">
        <div class="card-body">
          <div v-if="!user" class="">
            <div class="overlay-review p-5">
              <h4 class="text-center">Please login to post your review</h4>
              <a href="/login" class="px-5 btn btn-login-custom">Login</a>
            </div>
          </div>
          <h4 class="font-prim font-weight-bold">Add Your Review</h4>
          <div class="form-group">
            <label for="exampleFormControlTextarea1" class="small mb-0 mt-2 font-prim"
              >Your Review</label
            >
            <textarea
              style="background-color: rgba(140, 140, 140, 0.2)"
              class="form-control"
              v-model="review"
              id="exampleFormControlTextarea1"
              rows="3"
            ></textarea>
          </div>
          <div class="product-rating mt-0" style="font-size: 0.8em">
            <span>Choose your rating</span>
            <star-rating
              class="mt-1 rev"
              border-color="#d8d8d8"
              :rounded-corners="true"
              v-bind:star-size="13"
              :star-points="[
                23,
                2,
                14,
                17,
                0,
                19,
                10,
                34,
                7,
                50,
                23,
                43,
                38,
                50,
                36,
                34,
                46,
                19,
                31,
                17,
              ]"
              v-model="rating"
            ></star-rating>
          </div>
          <div class="btn btn-success mt-3" v-on:click="postreview">Post Review</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";
import VueMomentsAgo from "vue-moments-ago";
export default {
  components: {
    StarRating,
    VueMomentsAgo,
  },
  props: ["data", "enablestock", "pid", "user"],
  data() {
    return {
      qty: 1,
      key: "asdfads",
      rating: 5,
      review: "",
      datas: this.data || [],
    };
  },
  mounted() {},
  methods: {
    postreview() {
      var self = this;
      if (this.review && this.rating) {
        axios
          .post("/postreview", {
            // uid: this.user.id,
            pid: this.pid,
            review: this.review,
            rating: this.rating,
          })
          .then((res) => {
            if (res.data.success) {
              self.datas.unshift(res.data.data);
              self.review = "";
              self.ratinig = 5;
              this.key = "asd" + Math.random();
              Vue.swal.fire({
                icon: "success",
                title: res.data.title,
                text: res.data.message,
              });
            } else {
            }
          })
          .catch((err) => {
            console.error(err);

            Vue.swal.fire({
              icon: "error",
              title: "Error!!",
              text: "Please Contact Admin",
            });
          });
      } else {
        Vue.swal.fire({
          icon: "error",
          title: "Error!!",
          text: "Please Enter the Review",
        });
      }
    },
    reportreview(item, index) {
      var self = this;
      axios
        .post("/reportreview", {
          // uid: this.user.id,
          id: item.id,
        })
        .then((res) => {
          self.datas.splice(index, 1);
          this.key = "asd" + Math.random();
          Vue.swal.fire({
            icon: "success",
            title: "Review Reported",
            text: "Thank you for the helping us !!!!",
          });
        })
        .catch((err) => {
          console.error(err);
          Vue.swal.fire({
            icon: "error",
            title: "Error!!",
            text: "Please Contact Admin",
          });
        });
    },
  },
};
</script>
