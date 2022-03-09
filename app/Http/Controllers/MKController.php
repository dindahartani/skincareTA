<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MKController extends Controller
{

        public function total()
    {
        //query untuk mengambil data masalah kulit skincare dan disimpan pada variabel result
        $mk = $this->sparql->query("SELECT * WHERE {?s rdf:type skincare:Masalah_Kulit. ?s skincare:Nama ?namamk.} ORDER BY ?s");
        $result = [];
        foreach($mk as $item){
            array_push($result, [
                'id'      => $this->parseData($item->s->getURI()),
                'namamk'      => $this->parseData($item->namamk->getValue())
            ]);
        }
        $data = [
            'mk' => $result
        ];
        return view('masalahkulit.totalmk', $data);
    }

        public function show($mk)
    {
         //query untuk mengambil data skincare berdasarkan masalah kulit tertentu dan disimpan pada variabel result
         $getnama = $this->sparql->query("SELECT* WHERE {?s skincare:Digunakan_Untuk_Mengatasi skincare:".$mk."; skincare:Nama ?namaprod ; skincare:Gambar ?gambar .} ORDER BY ?s");
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
             'mk'     => $mk
         ];
 
         return view('masalahkulit.produk_mk', $data);

    }

}


