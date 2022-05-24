<template>
<div class="position-relative">
    <swiper :ref="'mySwiper'+carid" class="w-100" style="overflow: hidden" :options="swiperOptions">
        <swiper-slide v-for="(item, index) in data" v-if="item.products_count > 0" :key="index + carid">
            <div class="text-center car-menu py-3 mx-2">
                <a :href="'/' + link + '/' + item.name">
                    <img loading="lazy" :src="'/' + item.loc" :alt="item.name" class="mx-auto" />
                    <h6 class="mb-0 mt-2">{{ item.name }}</h6>
                </a>
            </div>
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
import { Swiper, SwiperSlide,directive } from "vue-awesome-swiper";
import "swiper/swiper-bundle.css";
    export default {
        props: ["data", "user", "newdata", "link", "carid"],
        components: {
    Swiper,
    SwiperSlide,
        },
        data() {
            return {
      sldx: null,
                settings: {
                    dots: true,
                    focusOnSelect: true,
                    infinite: true,
                    speed: 500,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    touchThreshold: 5,
                },
                swiperOptions: {
                    pagination: {
                        el: ".swiper-pagination",
                    },
                    breakpoints: {
                        1324: {
                            slidesPerView: 10,
                            spaceBetween: 0
                        },
                        1024: {
                            slidesPerView: 10,
                            spaceBetween: 0
                        },
                        768: {
                            slidesPerView: 7,
                            spaceBetween: 0
                        },
                        640: {
                            slidesPerView: 5,
                            spaceBetween: 0
                        },
                        500: {
                            slidesPerView: 5,
                            spaceBetween: 0
                        },
                        320: {
                            slidesPerView: 2,
                            spaceBetween: 0
                        },
                        0: {
                            slidesPerView: 2,
                            spaceBetween: 0
                        }
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
    },},
    };
</script>
