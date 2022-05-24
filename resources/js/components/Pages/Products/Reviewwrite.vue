<template>
  <div class="container" id="reviewadd">
    <div class="card shadow border ">

      <div class="card-body">
        <h4 class="font-prim font-weight-bold">Add Your Review</h4>
        <div class="product-rating mt-0" style="font-size: 0.7em">
          <star-rating
            class="mt-3 rev"
            border-color="#d8d8d8"
            :rounded-corners="true"
            v-bind:star-size="20"
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
          <!-- <ul class="addreview">
            <li>
              <i class="fa fa-star" star-data="1"></i>
            </li>
            <li>
              <i class="fa fa-star" star-data="2"></i>
            </li>
            <li>
              <i class="fa fa-star" star-data="3"></i>
            </li>
            <li>
              <i class="fa fa-star" star-data="4"></i>
            </li>
            <li>
              <i class="fa fa-star" star-data="5"></i>
            </li>
          </ul> -->
        </div>

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
        <!-- <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
          <label class="form-check-label" for="defaultCheck1">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, iusto!
          </label>
        </div> -->
        <div class="btn btn-success mt-3" v-on:click="postreview">Post Review</div>
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
            self.datas.unshift(res.data);
            self.review = "";
            self.ratinig = 5;
            Vue.swal.fire({
              icon: "success",
              title: "Product Reviewed",
              text: "Thank you for the review",
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
