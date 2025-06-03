<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi</title>
    <style>
        body { font-family: monospace; font-size: 10px; margin:  15px 10px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .line { border-top: 1px dashed #000; margin: 5px 0; }
        @media print {
            @page { size: 58mm auto; margin: 5mm; }
            button { display: none; }
            body { margin: 0; }
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 2px 0; }
    </style>
</head>
<body>

    <div class="Container">
        <p class="text-center"><strong>LAUNDRY EXPRESS</strong></p>
        <p class="text-center">Jl. Contoh No.123, Kota</p>
        <p>Tanggal: {{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
        <p>Kode Transaksi: {{ $transaksi->kode }}</p>

        <div class="line"></div>

        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->detailTransaksis as $item)
                    <tr>
                        <td>{{ $item->produk->nama }}</td>
                        <td class="text-right">{{ $item->jumlah }}</td>
                        <td class="text-right">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="line"></div>

        <p class="text-right"><strong>Total: Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong></p>

        <p class="text-center">Terima kasih telah menggunakan layanan kami!</p>

        <div class="text-center">
            <button onclick="window.print()">Cetak Struk</button>
        </div>
    </div>

</body>
</html>
