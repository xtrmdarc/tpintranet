<?php

namespace App\Http\Controllers\Excel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportFromArray extends Controller
{
    //
    public function __construct($array)
    {
        $this->collection = collect($array);
    }

    public function collection()    
    {
        return $this->collection;
    }

    public function headings(): array
    {
        if( count($this->collection)>0 ){
            $headings_arr = [];

            foreach($this->collection[0] as $name=>$value){
                $headings_arr[] = $name;
            }
           
            return $headings_arr;    
        }
        return array();   
    }
}
