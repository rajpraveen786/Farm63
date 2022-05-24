<template>
  <div class="position-relative">
    <swiper
      :allow-touch-move="true"
      :ref="'mySwiper' + carid"
      class="w-100"
      style="overflow: hidden; position: relative"
      :options="swiperOptions"
    >
      <swiper-slide v-for="(item, index) in data" :key="index + carid" style="border-radius: 10px">
          <span v-if="item.status">
              <a v-if="item.link" :href="item.link">
                  <img loading="lazy" :src="'/'+item.loc" alt="">
                </a v-if="item.link">
          </span>
      </swiper-slide>
    </swiper>
    <div v-if="sldx">
        <div class="swiper-prev arrow">
            <a @click="prev()" v-if="!sldx.isBeginning" >
                <span class="right"></span>
            </a>
        </div>
        <div class="swiper-next arrow">
            <a @click="next()" v-if="!sldx.isEnd" >
                <span class="right"></span>
            </a>
        </div>
    </div>
  </div>
</template>

<script>
import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";
import "swiper/swiper-bundle.css";

//   import { Swiper, SwiperSlide } from 'swiper/vue';
export default {
  props: ["data", "user", "newdata", "carid"],
  components: {
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
      sldx: null,
      swiperOptions: {
        breakpoints: {
          1324: {
            slidesPerView: 6,
          },
          1024: {
            slidesPerView: 5,
          },
          768: {
            slidesPerView: 4,
          },
          400: {
            slidesPerView: 1.5,
          },
          0: {
            slidesPerView: 1.5,
          },
        },
        // Some Swiper option/callback...
      },
    };
  },
  mounted() {
    var ref = "mySwiper" + this.carid;
    this.sldx = this.$refs["mySwiper" + this.carid].$swiper;
  },
  methods: {
    prev() {
      var ref = "mySwiper" + this.carid;
      this.sldx.slidePrev();
    },
    next() {
      var ref = "mySwiper" + this.carid;
      this.sldx.slideNext();
    },
  },
};
</script>
