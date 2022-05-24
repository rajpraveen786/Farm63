<template>
    <div class="">
        <div class="ql-editor w-100" v-html="datas"></div>
        <!-- <vue-editor name="datas" style="display:none" v-model="datas"></vue-editor> -->
    </div>
</template>

<script>
export default {
    props: ["content"],

    mounted() {
    },
    data() {
        return {
            datas: this.content,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        };
    },
    method:{
        showmod(val){
            this.show=val
        }
    }
};
</script>
