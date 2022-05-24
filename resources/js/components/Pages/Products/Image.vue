<template>
  <div class="text-center card-prod-ms">
    <span class="discount pos" v-if="disp"><div id="cut-diamond">{{ disp }} <span> % OFF</span></div></span>
    <img loading="lazy" :src="'/' + image[sel].loc" alt="Product image" class="w-100 productView" />

<swiper
      :allow-touch-move="true"
      ref="mySwiperiamge"
      class="w-100"
      style="overflow: hidden; position: relative"
      :options="swiperOptions"
    >
      <swiper-slide v-for="(itemx, index) in image" :key="index + 'image'">
      <img
       loading="lazy"
        v-on:click="changeprod(index)"
        :src="'/' + itemx.loc"
        :alt="itemx.name"
        class="w-100 productMenu"
      />
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

export default {
  props: ["image",'disp'],
  components: {
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
        sel:0,
      sldx: null,
      swiperOptions: {
        breakpoints: {
          1324: {
            slidesPerView: 5,
          },
          1024: {
            slidesPerView: 5,
          },
          700: {
            slidesPerView: 5,
          },
          500: {
            slidesPerView: 4,
          },
          400: {
            slidesPerView: 3,
          },
          0: {
            slidesPerView: 3,
          },
        },
        // Some Swiper option/callback...
      },
    };
  },
  mounted() {

    var ref = "mySwiperiamge";
    this.sldx = this.$refs["mySwiperiamge"].$swiper;
  },
  methods: {

    prev() {
      this.sldx.slidePrev();
    },
    next() {
      this.sldx.slideNext();
    },
    zoom(e) {
      var zoomer = e.currentTarget;
      var offsetX;
      var offsetY;
      e.offsetX ? (offsetX = e.offsetX) : (offsetX = e.touches[0].pageX);
      e.offsetY ? (offsetY = e.offsetY) : (offsetX = e.touches[0].pageX);
      var x = (offsetX / zoomer.offsetWidth) * 100;
      var y = (offsetY / zoomer.offsetHeight) * 100;
      zoomer.style.backgroundPosition = x + "% " + y + "%";
    },
    changeprod(index) {
      this.sel = index;
    },
  },
};
</script>
