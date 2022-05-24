<?php
use App\Model\SEO as ModelSEO;

use Illuminate\Database\Seeder;

class SEODB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data=new ModelSEO();
        $data->page='Home';
        $data->title='Home';
        $data->desc='Home';
        $data->save();

        //NewProducts
        $data=new ModelSEO();
        $data->page='NewProducts';
        $data->title='NewProducts';
        $data->desc='NewProducts';
        $data->save();

        //HotDeals
        $data=new ModelSEO();
        $data->page='HotDeals';
        $data->title='HotDeals';
        $data->desc='HotDeals';
        $data->save();

        //TrendingProdcuts
        $data=new ModelSEO();
        $data->page='TrendingProducts';
        $data->title='TrendingProducts';
        $data->desc='TrendingProducts';
        $data->save();
        //AllProdcuts
        $data=new ModelSEO();
        $data->page='AllProducts';
        $data->title='AllProducts';
        $data->desc='AllProducts';
        $data->save();

        //TopSelling
        $data=new ModelSEO();
        $data->page='TopSelling';
        $data->title='TopSelling';
        $data->desc='TopSelling';
        $data->save();

        //Category
        $data=new ModelSEO();
        $data->page='Category';
        $data->title='Category';
        $data->desc='Category';
        $data->save();

        //Brand
        $data=new ModelSEO();
        $data->page='Brand';
        $data->title='Brand';
        $data->desc='Brand';
        $data->save();

        //Contact Us
        $data=new ModelSEO();
        $data->page='ContactUs';
        $data->title='Contact Us';
        $data->desc='Contact Us';
        $data->save();

        //Terms&Cond
        $data=new ModelSEO();
        $data->page='Terms&Cond';
        $data->title='Terms&Cond';
        $data->desc='Terms&Cond';
        $data->save();

        //ShippingPolicy
        $data=new ModelSEO();
        $data->page='ShippingPolicy';
        $data->title='ShippingPolicy';
        $data->desc='ShippingPolicy';
        $data->save();

        //PrivacyPolicy
        $data=new ModelSEO();
        $data->page='PrivacyPolicy';
        $data->title='PrivacyPolicy';
        $data->desc='PrivacyPolicy';
        $data->save();

        //RefundPolicy
        $data=new ModelSEO();
        $data->page='RefundPolicy';
        $data->title='RefundPolicy';
        $data->desc='RefundPolicy';
        $data->save();

        //ReturnPolicy
        $data=new ModelSEO();
        $data->page='ReturnPolicy';
        $data->title='ReturnPolicy';
        $data->desc='ReturnPolicy';
        $data->save();

        //ABOUTUsPolicy
        $data=new ModelSEO();
        $data->page='AboutUS';
        $data->title='AboutUS';
        $data->desc='AboutUS';
        $data->save();

        //FAQ
        $data=new ModelSEO();
        $data->page='FAQ';
        $data->title='FAQ';
        $data->desc='FAQ';
        $data->save();

        //Profile
        $data=new ModelSEO();
        $data->page='Profile';
        $data->title='Profile';
        $data->desc='Profile';
        $data->save();

        //Contact US
        $data=new ModelSEO();
        $data->page='ContactUs';
        $data->title='Contact Us';
        $data->desc='Contact Us';
        $data->save();
    }
}
