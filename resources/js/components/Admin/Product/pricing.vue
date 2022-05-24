<template>
    <div>
        <div class="form-row my-2">
            <div class="form-group mt-2 col-sm-12 col-md-6">
                <input type="number" min="0" v-on:change="calamt" class="input-hov form-control" :class="[errors.cpi ? 'is-invalid ' : '']" autocomplete="off" name="cpi" id="inputcpi4" placeholder="Enter Cost per Item" v-model.number="cpi" />
                <label for="inputName4">Cost per Item</label>
                <small v-if="errors.cpi" class="form-text text-danger">{{ errors.cpi }}</small>
            </div>
            <div class="col-6 h6">
                Base Price
                <div class="col-6"><i class="fas fa-rupee-sign"></i> {{ fprice }}</div>
            </div>
            <div class="form-group mt-2 col-sm-12 col-md-6">
                <input type="number" min="0" :disabled="disableddisp==1" v-on:change="calamt" class="input-hov form-control" :class="[errors.disp ? 'is-invalid ' : '']" autocomplete="off" name="disp" id="inputdispe4" placeholder="Enter Discount %" v-model.number="disp" />
                <label for="inputdispe4">Discount %</label>
                <small v-if="errors.disp" class="form-text text-danger">{{ errors.disp }}</small>
            </div>
            <div class="col-6 h6">
                Discount amount
                <div class="col-6"><i class="fas fa-rupee-sign"></i> {{ disa }}</div>
            </div>
            <div class="form-group mt-2 col-sm-12 col-md-6">
                <input type="number" min="0" v-on:change="calamt" class="input-hov form-control" :class="[errors.taxp ? 'is-invalid ' : '']" autocomplete="off" name="taxp" id="inputtaxpe4" placeholder="Enter Tax %" v-model.number="taxp" />
                <label for="inputtaxpe4">Tax %</label>
                <small v-if="errors.taxp" class="form-text text-danger">{{ errors.taxp }}</small>
            </div>
            <div class="col-6 h6">
                Tax amount
                <div class="col-6"><i class="fas fa-rupee-sign"></i> {{ taxa }}</div>
            </div>
            <div class="form-group mt-2 col-sm-12 col-md-6">
                <input type="number" min="0" v-on:change="calamt" class="input-hov form-control" :class="[errors.fpricewtas ? 'is-invalid ' : '']" autocomplete="off" name="fpricewtas" id="inputprice4" placeholder="Enter Final Price" v-model.number="fpricewtas" />
                <label for="inputprice4">Final Price</label>
                <small v-if="errors.fpricewtas" class="form-text text-danger">{{
              errors.fpricewtas
            }}</small>
            </div>
        </div>
        <input type="hidden" v-model="margin" name="margin" />
        <input type="hidden" v-model="profit" name="profit" />
        <input type="hidden" v-model="fprice" name="price" />
        <input type="hidden" v-model="taxa" name="taxa" />
        <input type="hidden" v-model="disa" name="disa" />
        <input type="hidden" v-model="fpricebefdis" name="fpricebefdis" />
        <input type="hidden" v-model="actualprice" name="actualprice" />
    </div>
</template>

<script>
    export default {
        props: [
            "data",
            "oldcpi",
            "oldfpricewtas",
            "oldtaxp",
            "olddisp",
            "errorcpi",
            "errorfpricewtas",
            "errortaxp",
            "errordisp",
        ],
        mounted() {
            if(this.data && this.data.disid>0){
                this.disableddisp=1
            }
            else{
                this.disableddisp=0
            }
            this.calamt()
        },
        data() {
            return {
                cpi: this.oldcpi || 0,
                fpricebefdis:0,
                actualprice:0,
                fprice: 0,
                taxp: this.oldtaxp || 0,
                disp: this.olddisp || 0,
                margin: 0,
                profit: 0,
                fpricewtas: this.oldfpricewtas,
                taxa: 0,
                disa: 0,
                disableddisp:0,
                errors: {
                    cpi: this.errorcpi,
                    fpricewtas: this.errorfpricewtas,
                    taxp: this.errortaxp,
                    disp: this.errordisp,
                },
                csrf: document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            };
        },
        methods: {
            calamt() {

                this.fprice=Math.round(this.fpricewtas*10000/((100+this.taxp)*(100-this.disp))*100)/100
                this.taxa=0
                this.disa=0
                var distotal=0
                var taxtotal=0

                this.disa=Math.round(this.fprice*this.disp)/100
                this.taxa=Math.round((this.fprice-this.disa)*this.taxp)/100
                distotal=this.fprice-this.disa
                taxtotal=distotal-this.taxa

                this.fpricebefdis=this.fprice
                this.actualprice=this.fpricewtas

                this.profit = this.fprice - this.cpi;
                this.margin = Math.round((this.profit / this.fprice) * 1000) / 10;

            },
        },
    };
</script>
