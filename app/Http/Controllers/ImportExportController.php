<?php

namespace App\Http\Controllers;

use App\Imports\AttributeImport;
use App\Imports\BrandImport;
use App\Imports\CategryImport;
use App\Imports\EmployeeImport;
use App\Imports\PackingImport;
use App\Imports\ProductsImport;
use App\Imports\SubCategryImport;
use App\Imports\TagsImport;
use App\Imports\UOMImport;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Packing;
use App\Model\Products;
use App\Model\SubCategory;
use App\Model\Tags;
use App\Model\UOM;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
class ImportExportController extends Controller
{
    public function index(Request $request){
        return view('Admin.ImportExport');
    }
    public function importtype($name,Request $request){
        $validate = Validator::make($request->all(),[
            'file'=>'required|max:50000'
        ],[
            'file.mimes'=>'Sorry Please Check the Format',
            'file.max'=>'Maximum Size is 50 MB'
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $file=$request->file('file');

        if($name=='brand'){
            $funxc=new BrandImport;
        }
        else if($name=='category'){
            $funxc=new CategryImport;
        }
        else if($name=='subcategory'){
            $funxc=new SubCategryImport;
        }
        else if($name=='packing'){
            $funxc=new PackingImport;
        }
        else if($name=='tags'){
            $funxc=new TagsImport;
        }
        else if($name=='uom'){
            $funxc=new UOMImport;
        }
        else if($name=='products'){
            $funxc=new ProductsImport;
        }
        else if($name=='employee'){
            $funxc=new EmployeeImport;
        }
        else if($name=='attribute'){
            $funxc=new AttributeImport;
        }
        Excel::import($funxc, $file);
        $request->session()->flash('status', 'Imported Succesfully');
        return redirect('/admin/importexport');
    }


    public function exporttype($name,Request $request){

        if($name=='brand'){
            $this->brandexport();
        }
        else if($name=='category'){
            $this->categoryexport();
        }
        else if($name=='subcategory'){
            return $this->subcategoryexport();
        }
        else if($name=='packing'){
            $this->packingexport();
        }
        else if($name=='tags'){
            $this->tagsexport();
        }
        else if($name=='uom'){
            $this->uomexport();
        }
        else if($name=='products'){
            $this->productexport();
        }
        else if($name=='employee'){
            $this->employeeexport();
        }
        else if($name=='customer'){
            $this->customerexport();
        }
        else if($name=='attribute'){
            $this->attributeexport();
        }
    }

    public function brandexport(){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Brand.csv"');
        $fp = fopen('php://output', 'wb');

        $x=['S.no','ID','Name','Description','SeoTitle','SeoDescription','Status'];
        fputcsv($fp, $x);
        $data=Brand::get();
        for($i=0;$i<$data->count();$i++){
            $x=[$i+1,$data[$i]->id,$data[$i]->name,$data[$i]->desc,$data[$i]->seo_title,$data[$i]->seo_desc,$data[$i]->status];
            fputcsv($fp, $x);
        }
        fclose($fp);
    }
    public function categoryexport(){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Category.csv"');
        $fp = fopen('php://output', 'wb');

        $x=['S.no','ID','Name','Description','SeoTitle','SeoDescription','Status'];
        fputcsv($fp, $x);
        $data=Category::get();
        for($i=0;$i<$data->count();$i++){
            $x=[$i+1,$data[$i]->id,$data[$i]->name,$data[$i]->desc,$data[$i]->seo_title,$data[$i]->seo_desc,$data[$i]->status];
            fputcsv($fp, $x);
        }
        fclose($fp);
    }
    public function subcategoryexport(){

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="SubCategory.csv"');
        $fp = fopen('php://output', 'wb');

        $x=['S.no','ID','Name','Description','SeoTitle','SeoDescription','Status'];
        fputcsv($fp, $x);
        $data=SubCategory::get();
        for($i=0;$i<$data->count();$i++){
            $x=[$i+1,$data[$i]->id,$data[$i]->category->name??'',$data[$i]->name,$data[$i]->desc,$data[$i]->seo_title,$data[$i]->seo_desc,$data[$i]->status];
            fputcsv($fp, $x);
        }
        fclose($fp);
    }
    public function tagsexport(){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Tags.csv"');
        $fp = fopen('php://output', 'wb');

        $x=['S.no','ID','Name'];
        fputcsv($fp, $x);
        $data=Tags::get();
        for($i=0;$i<$data->count();$i++){
            $x=[$i+1,$data[$i]->id,$data[$i]->name];
            fputcsv($fp, $x);
        }
        fclose($fp);
    }

    public function attributeexport(){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Attribute.csv"');
        $fp = fopen('php://output', 'wb');

        $x=['S.no','ID','Name'];
        fputcsv($fp, $x);
        $data=Tags::get();
        for($i=0;$i<$data->count();$i++){
            $x=[$i+1,$data[$i]->id,$data[$i]->name];
            fputcsv($fp, $x);
        }
        fclose($fp);
    }
    public function packingexport(){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Packing.csv"');
        $fp = fopen('php://output', 'wb');

        $x=['S.no','ID','Name'];
        fputcsv($fp, $x);
        $data=Packing::get();
        for($i=0;$i<$data->count();$i++){
            $x=[$i+1,$data[$i]->id,$data[$i]->name];
            fputcsv($fp, $x);
        }
        fclose($fp);
    }
    public function uomexport(){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="UOM.csv"');
        $fp = fopen('php://output', 'wb');

        $x=['S.no','ID','Name'];
        fputcsv($fp, $x);
        $data=UOM::get();
        for($i=0;$i<$data->count();$i++){
            $x=[$i+1,$data[$i]->id,$data[$i]->name];
            fputcsv($fp, $x);
        }
        fclose($fp);
    }
    public function productexport(){
        $data=Products::get();
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Prodcuts.csv"');
        $fp = fopen('php://output', 'wb');

        $x=['S.no','ID','Name','Short Description','Description','CPI','Price','Discount %','Discount Amount','Tax %','Tax Amount','Final Price','SKU','Barcode','Stock','MinStock','Track Qty(T/F)','Continue Out of Stock(T/F)','Weight(Kg)','Length','Width','Breadth','Category','SubCategory','Brand','UOM','Packing','SEOTitle','SEODescription'];
        fputcsv($fp, $x);
        for($i=0;$i<$data->count();$i++){
            $x=[$i+1,$data[$i]->id,$data[$i]->name??'',$data[$i]->shortdesc??'',$data[$i]->desc??'',$data[$i]->cpi??0,$data[$i]->fprice??0,$data[$i]->disp??0,$data[$i]->disa??0,$data[$i]->taxp??0,$data[$i]->taxa??0,$data[$i]->fpricewtas??'',$data[$i]->sku??0,$data[$i]->barcode??0,$data[$i]->stock??'',$data[$i]->minstock??'',$data[$i]->trackqty?'T':'F',$data[$i]->oosc?'T':'F',$data[$i]->weight??'',$data[$i]->length??'',$data[$i]->width??'',$data[$i]->breadth??'',$data[$i]->category->name??'',$data[$i]->subcategory->name??'',$data[$i]->brand->name??'',$data[$i]->uom->name??'',$data[$i]->packing->name??'',$data[$i]->seo_title??'',$data[$i]->seo_desc??'',$data[$i]->status??'',];
            fputcsv($fp, $x);
        }
        fclose($fp);
    }
}
