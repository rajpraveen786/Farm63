<?php

use Illuminate\Database\Seeder;
use App\PagesCollections as CollectionPages;
class PagesCollection extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $x=[];
        $x['banner']=[];
        $x['bannercategory']=[];
        $x['bannerbrand']=[];
        $x['selectbrand']=[];
        $x['selectcategory']=[];
        $data=new CollectionPages;
        $data->name='Home Page';
        $data->data=$x;;
        $data->save();
    }
}
