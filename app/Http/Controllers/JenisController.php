<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisController extends Controller
{

        public function total()
    {
        //query untuk mengambil data jenis skincare dan disimpan pada variabel result
        $jenis = $this->sparql->query("SELECT * WHERE {?s rdf:type skincare:Jenis_Skincare. ?s skincare:Nama ?namajenis.} ORDER BY ?s");
        $result = [];
        foreach($jenis as $item){
            array_push($result, [
                'id'      => $this->parseData($item->s->getURI()),
                'namajenis'      => $this->parseData($item->namajenis->getValue())
            ]);
        }
        $data = [
            'jenis' => $result
        ];
        return view('jenis.totaljenis', $data);
    }

        public function show($jenis)
    {
         //query untuk mengambil data skincare berdasarkan jenis tertentu dan disimpan pada variabel result
         $getnama = $this->sparql->query("SELECT* WHERE {?s skincare:Memiliki_JenisSkincare skincare:".$jenis."; skincare:Nama ?namaprod ; skincare:Gambar ?gambar .} ORDER BY ?s");
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
             'jenis'     => $jenis
         ];
 
         return view('jenis.produk_jenis', $data);

    }

}


