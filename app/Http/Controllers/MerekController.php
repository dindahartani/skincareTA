<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerekController extends Controller
{

        public function total()
    {
        //query untuk mengambil data merek skincare dan disimpan pada variabel result
        $merek = $this->sparql->query("SELECT * WHERE {?s rdf:type skincare:Merek_Skincare.} ORDER BY ?s");
        $result = [];
        foreach($merek as $item){
            array_push($result, [
                'namamerek'      => $this->parseData($item->s->getURI()),
            ]);
        }
        $data = [
            'merek' => $result
        ];
        return view('merek.totalmerek', $data);
    }

        public function show($merek)
    {
         //query untuk mengambil data skincare berdasarkan merek tertentu dan disimpan pada variabel result
         $getnama = $this->sparql->query("SELECT* WHERE {?s skincare:Memiliki_MerekSkincare skincare:".$merek."; skincare:Nama ?namaprod ; skincare:Gambar ?gambar .} ORDER BY ?s");
         $result = [];
         $jumlah = 0;
         foreach($getnama as $item){
             array_push($result, [
                 'id'            => $this->parseData($item->s->getUri()),
                 'namaprod'      => $this->parseData($item->namaprod->getValue()),
                 'gambar'        => $this->parseData($item->gambar->getValue())
                 
             ]);
             $jumlah = $jumlah + 1;
         }
        
       
         $data = [
             'skincare'  => $result,
             'jumlah'    => $jumlah,
             'merek'     => $merek
         ];
 
         return view('merek.produk_merek', $data);

    }

}


