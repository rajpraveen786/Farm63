<template>
    <div>
        <div class="float-right">
            <button type="button" class="btn btn-outline-custom" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add
            </button>
        </div>
        <h5 class="color-prim"><strong> Category</strong></h5>
        <table class="table table-list table-responsive-sm">
            <thead>
                <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">
                    <th style="width:20%">Photo</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th style="width:10%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="container text-center">
            <img loading="lazy" src="/storage/sorry.svg" alt="" class="w-25">
            <h5>Sorry No data Found</h5>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "data",
            "oldcity",
            "oldpincode",
            "oldstate",
            "oldcountry",
            "oldstatus",
        ],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                datas: this.data.data,
                city: this.oldcity,
                pincode: this.oldpincode,
                state: this.oldstate,
                country: this.oldcountry,
                status: this.oldstatus ? this.oldstatus : -1,
                datax: {
                    city: "",
                    state: "",
                    pincode: "",
                    country: "",
                    cost: "",
                    deldays: "",
                    status: 1,
                },
                errors: {},
                errorstemp: {
                    city: "",
                    state: "",
                    pincode: "",
                    country: "",
                    cost: "",
                    deldays: "",
                    status: 1,
                },
                type: 0,
                seldata: "",
                selid: "",
                selind: "",
            };
        },
        mounted() {},
        methods: {
            cleardata() {
                $("#exampleModalLong").modal("hide");
                this.datax.country = "";
                this.datax.state = "";
                this.datax.city = "";
                this.datax.pincode = "";
                this.datax.status = 0;
                this.datax.cost = "";
                this.datax.deldays = 0;
                this.selid = "";
                this.selind = "";
                this.type = 0;
                this.errors = this.errorstemp;
            },
            newdata() {
                var self = this;
                this.errors = this.errorstemp;
                axios
                    .post("/admin/pincode/add", {
                        city: this.datax.city,
                        state: this.datax.state,
                        pincode: this.datax.pincode,
                        status: this.datax.status,
                        country: this.datax.country,
                        cost: this.datax.cost,
                        deldays: this.datax.deldays,
                    })
                    .then((res) => {
                        if (res.data.errorstat) {
                            this.errors = res.data.errors;
                        } else {
                            self.datas.push(res.data.data);
                            self.cleardata();
                            Vue.swal({
                                title: "Sucess.",
                                text: "Pin Code added successfull.",
                                icon: "success",
                            });
                        }
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            },
            editmodal(index) {
                this.errors = this.errorstemp;
                this.type = 1;
                this.selind = index;
                this.datax.country = this.datas[index].country;
                this.datax.state = this.datas[index].state;
                this.datax.city = this.datas[index].city;
                this.datax.pincode = this.datas[index].pincode;
                this.datax.status = this.datas[index].status;
                this.datax.cost = this.datas[index].cost;
                this.datax.deldays = this.datas[index].deldays;
                this.selid = this.datas[index].id;
                $("#exampleModalLong").modal({
                    backdrop: "static",
                    keyboard: false,
                    show: true,
                });
            },
            editdata() {
                var self = this;
                axios
                    .post("/admin/pincode/edit", {
                        city: this.datax.city,
                        state: this.datax.state,
                        pincode: this.datax.pincode,
                        status: this.datax.status,
                        country: this.datax.country,
                        cost: this.datax.cost,
                        deldays: this.datax.deldays,
                        id: this.selid,
                    })
                    .then((res) => {
                        if (res.data.errorstat) {
                            this.errors = res.data.errors;
                        } else {
                            self.datas[self.selind] = res.data.data;
                            self.cleardata();
                            Vue.swal({
                                title: "Sucess.",
                                text: "Pin Code edited successfull.",
                                icon: "success",
                            });
                        }
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            },
            deletedata(item, index) {
                var self = this;
                if (confirm("Are you sure do you want to delete?")) {
                    axios
                        .post("/admin/pincode/delete", {
                            id: item.id,
                        })
                        .then((res) => {
                            self.datas.splice(index, 1);
                            self.cleardata();
                            Vue.swal({
                                title: "Sucess.",
                                text: "UOM deleted successfull.",
                                icon: "success",
                            });
                        })
                        .catch((err) => {
                            console.error(err);
                        });
                }
            },
        },
    };
</script>
