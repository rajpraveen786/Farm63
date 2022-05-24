<template>
  <div class="mt-2">
    <div class="card mt-4">
      <div class="card-body">
        <h4>Import</h4>
      </div>
      <div class="card-body row">
        <button
          v-for="(item, index) in importdet"
          class="btn btn-outline-primary col-sm-6 col-md-2 m-2"
          v-on:click="importselfun(index)"
          :key="'importdet' + index"
        >
          {{ item.name }}
        </button>
      </div>
    </div>
    <div class="card mt-4">
      <div class="card-body">
        <h4>Export</h4>
      </div>
      <div class="card-body row">
        <a
          v-for="(item, index) in exprotdet"
          :href='item.link'
          class="btn btn-outline-primary col-sm-6 col-md-2 m-2"
          :key="'exprotdet' + index"
        >
          {{ item.name }}
        </a>
      </div>
    </div>
    <div
      class="modal fade"
      id="importModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="importModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="importModalLabel">Import {{seldata?seldata.name:''}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <a
              :href="seldata?seldata.storage:''"
              download
              class="btn btn-outline-dark float-right"
            >
              <i class="fa fa-download" aria-hidden="true"></i
            ></a>
            <form
              :action="seldata?seldata.link:''"
              method="post"
              enctype="multipart/form-data"
            >
              <input type="hidden" name="_token" v-bind:value="csrf" />
              <div class="row justify-content-center">
                <div class="col-8">
                  <div class="form-group">
                    <label for="">File</label>
                    <input
                      type="file"
                      class="form-control-file"
                      name="file"
                      id=""
                      placeholder=""
                      aria-describedby="fileHelpId"
                    />
                    <small id="fileHelpId" class="form-text text-muted"
                      >Please Import the Exported file Excel file</small
                    >
                  </div>
                </div>
              </div>
              <input
                type="submit"
                class="btn btn-outline-primary float-right"
                value="Import"
              />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [],
  data() {
    return {
      seldata: null,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      importdet: [
        {
          name: "Brand",
          link: "/admin/importexport/import/brand",
          storage: "/storage/Templates/Brand.xlsx",
        },
        {
          name: "Category",
          link: "/admin/importexport/import/category",
          storage: "/storage/Templates/Category.xlsx",
        },
        {
          name: "Sub Category",
          link: "/admin/importexport/import/subcategory",
          storage: "/storage/Templates/SubCategory.xlsx",
        },
        {
          name: "Packing",
          link: "/admin/importexport/import/packing",
          storage: "/storage/Templates/Packing.xlsx",
        },
        {
          name: "Tags",
          link: "/admin/importexport/import/tags",
          storage: "/storage/Templates/Tags.xlsx",
        },
        {
          name: "Attribute",
          link: "/admin/importexport/import/attribute",
          storage: "/storage/Templates/Attribute.xlsx",
        },
        {
          name: "UOM",
          link: "/admin/importexport/import/uom",
          storage: "/storage/Templates/UOM.xlsx",
        },
        {
          name: "Products",
          link: "/admin/importexport/import/products",
          storage: "/storage/Templates/Products.xlsx",
        },
        // {
        //   name: "Employee",
        //   link: "/admin/importexport/import/employee",
        //   storage: "/storage/Templates/Employee.xlsx",
        // },
      ],
      exprotdet: [
        {
          name: "Brand",
          link: "/admin/importexport/export/brand",
        },
        {
          name: "Category",
          link: "/admin/importexport/export/category",
        },
        {
          name: "Sub Category",
          link: "/admin/importexport/export/subcategory",
        },
        {
          name: "Packing",
          link: "/admin/importexport/export/packing",
        },
        {
          name: "Tags",
          link: "/admin/importexport/export/tags",
        },
        {
          name: "UOM",
          link: "/admin/importexport/export/uom",
        },
        {
          name: "Products",
          link: "/admin/importexport/export/products",
        },
      ],
    };
  },
  mounted() {},
  methods: {
    importselfun(index) {
      this.seldata = this.importdet[index];
      $("#importModal").modal({
        backdrop: "static",
        keyboard: false,
      });
    },
  },
};
</script>
