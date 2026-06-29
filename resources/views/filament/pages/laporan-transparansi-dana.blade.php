<x-filament-panels::page>
    @php
        $totalMasuk = $this->getTotalMasuk();
        $totalKeluar = $this->getTotalKeluar();
        $saldo = $this->getSaldo();
        $rincianPenggunaanPerBulan = $this->getRincianPenggunaanPerBulan();
    @endphp

    @include('partials.transparency-report', [
        'totalMasuk' => $totalMasuk,
        'totalKeluar' => $totalKeluar,
        'saldo' => $saldo,
        'rincianPenggunaanPerBulan' => $rincianPenggunaanPerBulan,
    ])
</x-filament-panels::page>
