<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Paket Akad A',
            'harga' => '16545000',
            'description' => '<ol><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>3 Lokal Tenda dengan Luas +_ 72 m2</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Set Alat Prasmanan (Tanpa Alat Dapur) 100 Piring + Sendok Garpu</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Meja Panjang Untuk Prasmanan</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Meja Kecil Untuk Aqua</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>150 Kursi Plastik (Tanpa sarung / Cover)</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>2 Malam lampu penerangan, 8  lampu gantungan + genset</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>2 Rol foto wedding</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 DC video shooting</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>5 Mtr dekorasi pelaminan minimalis (Bunga kering) 3 kursi</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>3 Meter taman dekorasi</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Buah gapura masuk</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Meja tamu / meja souvenir</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Pasang baju akad CP wanita dan CP pria (Sudah di tentukan)</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>2 Pasang baju resepsi CP wanita dan CP pria (Sudah di tentukan)</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Pasang baju ortu CP wanita + make up</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Pasang baju ortu CP pria tanpa make up</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>3 Stel pagar ayu + make up</li></ol><p><br></p><p><strong>Bonus</strong></p><ol><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Kotak amplop (Di pinjamkan)</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Set plang ucapan (Di pinjamkan)</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>2 Orang make up (Tanpa bulu mata)</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>2 Lokal atap tenda di salur</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Ser melati asli / basah</li></ol><p>			#. Bunga basah tambah 2.5 juta pull dekor</p><p>			#. Belum termasuk transportasi</p>',
            'category_product_id' => 2,
            'cover_image' => 'cover-image-product/componen-wedding-13.jpg',
        ]);
        
        Product::create([
            'title' => 'Paket Akad A',
            'harga' => '122650000',
            'description' => '<ol><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>2 Lokal Tenda Biasa</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Set Prasmanan 100 Piring</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>50 Buah Kursi</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>2 Malam Diesel Lampu</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>3 Meter Decorasi Pelaminan 1 Kursi</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Pasang Baju Akad</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Pasang Baju Resepsi</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>1 Roll Foto Album</li></ol><p><br></p><p><strong>Bonus</strong></p><ol><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>Kotak Amplop (Dipinjamkan)</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>Meja Souvenir (Dipinjamkan)</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>Make up Ibu Hajat</li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>Melati Asli / Basah</li></ol>',
            'category_product_id' => 1,
            'cover_image' => 'cover-image-product/componen-wedding-3.jpg',
        ]);
    }
}
