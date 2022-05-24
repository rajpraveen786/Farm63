<?php

namespace App\Imports;

use App\Model\Category;
use App\Model\Packing;
use App\Model\Products;
use App\Model\SubCategory;
use App\Model\Brand;
use App\Model\UOM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

HeadingRowFormatter::default('none');


class ProductsImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $prod=null;
        $brand=Brand::where('name', $row['Brand'])->first();
        if(!$brand){
            $brand=null;
        }
        $category=Category::where('name', $row['Category'])->first();
        if(!$category){
            $category=null;
        }

        $subcategory=SubCategory::where('name', $row['SubCategory'])->first();
        if(!$subcategory){
            $subcategory=null;
        }

        $uom=UOM::where('name', $row['UOM'])->first();
        if(!$uom){
            $uom=null;
        }
        $packing=Packing::where('name', $row['Packing'])->first();
        if(!$packing){
            $packing=null;
        }

        $tempprice = floatval($row['Price'])??0;
        $price = $tempprice;

        $cpi = floatval($row['CPI'])??0;
        $taxp = floatval($row['Tax %'])??0;
        $tempprice=$tempprice*100/(100+$taxp);
        $profit = $tempprice - $cpi;
        if($tempprice){
            $margin = round(($profit / $tempprice) * 100, 2);
        }
        else{
            $margin=0;
        }

        $taxa = round(($tempprice * $taxp) / 100, 2);

        $prod=Products::where('name', $row['Name'])->first();
        if (!$prod) {
            $prod=new Products();
            $prod->name=$row['Name'];
            $prod->shortdesc=$row['Short Description'];
            $prod->desc=$row['Description'];

            $prod->cpi=$cpi??0;
            $prod->fprice=$tempprice??0;
            $prod->margin=$margin??0;
            $prod->profit=$profit??0;

            $prod->taxp=$taxp;
            $prod->taxa=$taxa;
            $prod->fpricebefdis=0;
            $prod->fpricewtas=$price;
            $prod->actualprice=$price;


            $prod->sku=$row['SKU'];
            $prod->barcode=$row['Barcode'];
            $prod->stock=$row['Stock']??0;
            $prod->minstock=$row['MinStock']??0;

            $prod->trackqty=$row['Track Qty(T/F)']=='T'?1:0;
            $prod->oosc=$row['Continue Out of Stock(T/F)']=='T'?1:0;

            $prod->weight=$row['Weight(Kg)']??0;
            $prod->length=$row['Length']??0;
            $prod->width=$row['Width']??0;
            $prod->breadth=$row['Breadth']??0;

            $prod->tags=explode(',',$row['Tags']??'');

            $prod->bid=$brand->id??0;
            $prod->cid=$category->id??0;
            $prod->scid=$subcategory->id??0;
            $prod->uomid=$uom->id??0;
            $prod->packingid=$packing->id??0;
            $prod->save();
        }
        return $prod;
    }
}
