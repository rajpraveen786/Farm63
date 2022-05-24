/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
import 'sweetalert2/dist/sweetalert2.min.css';


import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect)


import Vue2Editor from "vue2-editor";
Vue.use(Vue2Editor);

Vue.use(require('vue-moment'));

import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)

import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);

Vue.component('mainchart', require('./components/Admin/mainchart.vue').default);
Vue.component('print', require('./components/Print.vue').default);
Vue.component('fileinput', require('./components/Admin/Fileinput.vue').default);

Vue.component('descinput', require('./components/DescInput/DescInput.vue').default);
Vue.component('descview', require('./components/DescInput/DescView.vue').default);
Vue.component('selectval', require('./components/Select.vue').default);
Vue.component('notifymessage', require('./components/NotifyMessage.vue').default);
Vue.component('selectpincode', require('./components/SelectPincode.vue').default);
Vue.component('searchapp', require('./components/SearchApp.vue').default);


Vue.component('adminnewsletterindex', require('./components/Admin/Newsletter/index.vue').default);
Vue.component('adminmasterattributeindex', require('./components/Admin/Master/Attribute/index.vue').default);
Vue.component('adminmasterpackingindex', require('./components/Admin/Master/Packing/index.vue').default);
Vue.component('adminmasteruomindex', require('./components/Admin/Master/UOM/index.vue').default);
Vue.component('adminmastertagsindex', require('./components/Admin/Master/Tags/index.vue').default);
Vue.component('adminbannerindex', require('./components/Admin/Banner/index.vue').default);
Vue.component('adminimportexport', require('./components/Admin/ImportExport.vue').default);

//Product
Vue.component('adminproductpricing', require('./components/Admin/Product/pricing.vue').default);
Vue.component('adminproductinventory', require('./components/Admin/Product/inventory.vue').default);
Vue.component('adminproducttags', require('./components/Admin/Product/tags.vue').default);
Vue.component('adminproductcategory', require('./components/Admin/Product/category.vue').default);
Vue.component('adminproductphoto', require('./components/Admin/Product/photo.vue').default);
Vue.component('adminproductbulkupdate', require('./components/Admin/Product/bulkupdate.vue').default);

//Attribute
Vue.component('adminproductattribute', require('./components/Admin/Product/attribute.vue').default);
Vue.component('adminproductattributeview', require('./components/Admin/Product/attributeview.vue').default);
Vue.component('adminchartpie', require('./components/Admin/Chart/Piechart.vue').default);


//Discount
Vue.component('admindiscounttype', require('./components/Admin/Discount/type.vue').default);
Vue.component('admindiscounttypeedit', require('./components/Admin/Discount/typeedit.vue').default);
Vue.component('admindiscountdatetime', require('./components/Admin/Discount/datetime.vue').default);

//Promo Code
Vue.component('adminpromotype', require('./components/Admin/PromoCode/type.vue').default);
Vue.component('adminpromotypeedit', require('./components/Admin/PromoCode/typeedit.vue').default);
Vue.component('adminpromousage', require('./components/Admin/PromoCode/usage.vue').default);
Vue.component('adminpromominreq', require('./components/Admin/PromoCode/minreq.vue').default);


//Pincode
Vue.component('adminorderindex', require('./components/Admin/Orders/index.vue').default);
Vue.component('adminpincode', require('./components/Admin/PinCode/index.vue').default);
Vue.component('adminlogs', require('./components/Admin/AdminLogs.vue').default);



//Welcome pages
Vue.component('checkout', require('./components/Checkout.vue').default);


//Product Pages

Vue.component('pagesproducts', require('./components/Pages/Products/Home.vue').default);
Vue.component('pagesimage', require('./components/Pages/Products/Image.vue').default);
Vue.component('pagesreview', require('./components/Pages/Products/Review.vue').default);
Vue.component('pagesreviewwrite', require('./components/Pages/Products/Reviewwrite.vue').default);

// Vue.component('productboughttogheter', require('./components/Pages/ProductBoughtTogheter.vue').default);

Vue.component('carouselsub', require('./components/Pages/CarouselSub.vue').default);
Vue.component('mscarouselcat', require('./components/Pages/MsCarouselCat.vue').default);
Vue.component('mscarousel', require('./components/Pages/MsCarousel.vue').default);
Vue.component('msproductgen', require('./components/Pages/MsProductGen.vue').default);
Vue.component('mssearch', require('./components/Pages/MsSearch.vue').default);
Vue.component('mshotdeals', require('./components/Pages/MsHotDeals.vue').default);
Vue.component('msbrand', require('./components/Pages/MsBrand.vue').default);
Vue.component('mscategory', require('./components/Pages/MsCategory.vue').default);


//Cart

Vue.component('cart', require('./components/Pages/Cart/List.vue').default);


//WishList
Vue.component('wishlist', require('./components/Pages/WishList/WishList.vue').default);

//Profile Page
Vue.component('profileverifyloginotp', require('./components/Profile/Verify/LoginOTP.vue').default);
Vue.component('profileaddressnew', require('./components/Profile/Address/Details.vue').default);


Vue.component('star', require('./components/Pages/Products/Star.vue').default);

/**
 *
 *
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('contactus', require('./components/ContactUs.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
