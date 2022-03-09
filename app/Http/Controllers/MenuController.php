<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function home(){

        return view('home');
    }
    public function browsing(){

            //query untuk mengambil data skincare, merek, jenis, rentang usia, masalah kulit, tipe kulit, waktu penggunaan
            $skincare = $this->sparql->query('SELECT * WHERE {?s rdf:type skincare:Nama_Produk. ?s skincare:Nama ?o} ORDER BY ?s');
            $merek = $this->sparql->query('SELECT * WHERE {?s rdf:type skincare:Merek_Skincare. ?s skincare:Nama ?o } ORDER BY ?s');
            $jenis = $this->sparql->query('SELECT * WHERE {?s rdf:type skincare:Jenis_Skincare. ?s skincare:Nama ?o} ORDER BY ?s');
            $usia = $this->sparql->query('SELECT * WHERE {?s rdf:type skincare:Usia. ?s skincare:Nama ?o} ORDER BY ?s');
            $mk = $this->sparql->query('SELECT * WHERE {?s rdf:type skincare:Masalah_Kulit. ?s skincare:Nama ?o} ORDER BY ?s');
            $tk = $this->sparql->query('SELECT * WHERE {?s rdf:type skincare:Tipe_Kulit.?s skincare:Nama ?o} ORDER BY ?s');
            $wp = $this->sparql->query('SELECT * WHERE {?s rdf:type skincare:Waktu_Penggunaan.?s skincare:Nama ?o} ORDER BY ?s');
            $jumlahskincare = $jumlahmerek = $jumlahjenis = $jumlahusia = $jumlahmk = $jumlahtk = $jumlahwp = 0;
            foreach($skincare as $item){
                $jumlahskincare = $jumlahskincare + 1;
            }
            foreach($merek as $item){
                $jumlahmerek = $jumlahmerek + 1;
            }
            foreach($jenis as $item){
                $jumlahjenis = $jumlahjenis + 1;
            }
            foreach($usia as $item){
                $jumlahusia = $jumlahusia + 1;
            }
            foreach($mk as $item){
                $jumlahmk = $jumlahmk + 1;
            }
            foreach($tk as $item){
                $jumlahtk = $jumlahtk + 1;
            }
            foreach($wp as $item){
                $jumlahwp = $jumlahwp + 1;
            }
            $data = array(
                'jumlahskincare'    => $jumlahskincare,
                'jumlahmerek'       => $jumlahmerek,
                'jumlahjenis'       => $jumlahjenis,
                'jumlahusia'        => $jumlahusia,
                'jumlahmk'          => $jumlahmk,
                'jumlahtk'          => $jumlahtk,
                'jumlahwp'          => $jumlahwp
            );
    

        return view('browsing', ['data' => $data]);
    }
    public function searching(){

        return view('searching');
    }


}
