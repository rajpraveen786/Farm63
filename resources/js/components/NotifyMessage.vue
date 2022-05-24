<template>
</template>

<script>
export default {
  mounted() {
      if(this.datax.length>0){
          this.$notify({ type: this.typex, text: this.datax })
      }
  },
  props:['data','type'],
  data() {
    return {
      typex: this.type==1?'success':'error',
      titlex: this.type==1?'Success':'Error',
      datax: this.data,
    };
  },
};
</script>
