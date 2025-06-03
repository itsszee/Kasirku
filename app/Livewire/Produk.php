<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Produk as ImportProduk;
use Illuminate\Support\Facades\Auth;

class Produk extends Component
{
    use WithFileUploads;
    public $pilihanMenu = 'lihat';
    public $nama, $kode, $harga, $stok, $gambar;
    public $produkTerpilih;
    public $fileExcel;


    public function mount()
    {
        if (Auth::user()->peran !== 'admin') {
            abort(403);
        }
    }

    public function importExcel()
    {
        $this->validate([
            'fileExcel' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new ImportProduk, $this->fileExcel->getRealPath());

        $this->reset('fileExcel');
        $this->pilihanMenu = 'lihat';
    }

    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->gambar = $this->produkTerpilih->gambar;
        $this->nama = $this->produkTerpilih->nama;
        $this->kode = $this->produkTerpilih->kode;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate(
            [
                'gambar' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
                'nama' => 'required',
                'kode' => 'required|unique:produks,kode,' . $this->produkTerpilih->id,
                'harga' => 'required',
                'stok' => 'required'
            ],
            [

                'gambar.required' => 'Gambar tidak boleh kosong',                
                'gambar.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif',
                'gambar.max' => 'Ukuran gambar maksimal 2MB',
                'nama.required' => 'Nama tidak boleh kosong',
                'kode.required' => 'Kode tidak boleh kosong',
                'kode.unique' => 'Kode sudah terdaftar',
                'harga.required' => 'Harga tidak boleh kosong',
                'stok.required' => 'Stok tidak boleh kosong'
            ]
        );

        $simpan = $this->produkTerpilih;
        $path = $this->gambar->store('gambar_produk', 'public');
        $simpan->gambar = $path;
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->harga = $this->harga;
        $simpan->stok = $this->stok;
        $simpan->save();

        $this->reset();
        $this->pilihanMenu = 'lihat';
    }

    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus()
    {
        $this->produkTerpilih->delete();
        $this->reset();
    }

    public function batal()
    {
        $this->reset();
    }

    public function simpan()
    {
        $this->validate(
            [
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'nama' => 'required',
                'kode' => 'required|unique:produks,kode',
                'harga' => 'required',
                'stok' => 'required'
            ],
            [
                'gambar.required' => 'Gambar tidak boleh kosong',
                'gambar.image' => 'File harus berupa gambar',
                'gambar.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif',
                'gambar.max' => 'Ukuran gambar maksimal 2MB',
                'nama.required' => 'Nama tidak boleh kosong',
                'kode.required' => 'Kode tidak boleh kosong',
                'kode.unique' => 'Kode sudah terdaftar',
                'harga.required' => 'Harga tidak boleh kosong',
                'stok.required' => 'Stok tidak boleh kosong'
            ]
        );

        $simpan = new ModelProduk();
        $path = $this->gambar->store('gambar_produk', 'public'); // simpan ke storage/app/public/gambar_produk
        $simpan->gambar = $path;
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->harga = $this->harga;
        $simpan->stok = $this->stok;
        $simpan->save();

        $this->reset(['nama', 'kode', 'harga', 'stok', 'gambar']);
        $this->pilihanMenu = 'lihat';
    }

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        return view('livewire.produk')->with([
            'semuaProduk' => ModelProduk::all()
        ]);
    }
}
