<?php

namespace App\Livewire;

use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class DonasiForm extends Component
{
    use WithFileUploads;

    public string $jumlah_donasi = '';
    public string $tujuan_donasi = '';
    public string $metode_transfer = 'bca';
    public string $tanggal_donasi = '';
    public string $deskripsi = '';
    public $bukti_transfer;

    public bool $showSuccess = false;

    protected $rules = [
        'jumlah_donasi' => 'required|numeric|min:1000',
        'tujuan_donasi' => 'required|string|in:Pakan,Steril,Pengobatan,Vaksin,Lainnya',
        'metode_transfer' => 'required|string|in:bca,spay',
        'tanggal_donasi' => 'required|date',
        'deskripsi' => 'nullable|string|max:255',
        'bukti_transfer' => 'required|image|max:10240',
    ];

    protected $messages = [
        'jumlah_donasi.required' => 'Jumlah donasi wajib diisi.',
        'jumlah_donasi.numeric' => 'Jumlah donasi harus berupa angka.',
        'jumlah_donasi.min' => 'Jumlah donasi minimal Rp1.000.',
        'tujuan_donasi.required' => 'Tujuan donasi wajib dipilih.',
        'metode_transfer.required' => 'Metode transfer wajib dipilih.',
        'tanggal_donasi.required' => 'Tanggal donasi wajib diisi.',
        'bukti_transfer.required' => 'Bukti transfer wajib diunggah.',
        'bukti_transfer.image' => 'Bukti transfer harus berupa gambar.',
        'bukti_transfer.max' => 'Ukuran bukti transfer maksimal 10MB.',
    ];

    public function mount(): void
    {
        $this->tanggal_donasi = now()->format('Y-m-d');
    }

    public function submit(): void
    {
        $this->validate();

        $path = $this->bukti_transfer->storeAs(
            'donasi',
            Str::uuid() . '.' . $this->bukti_transfer->getClientOriginalExtension(),
            'public'
        );

        Donasi::create([
            'user_id' => Auth::id(),
            'jumlah_donasi' => (float) $this->jumlah_donasi,
            'tujuan_donasi' => $this->tujuan_donasi,
            'metode_transfer' => $this->metode_transfer,
            'tanggal_donasi' => $this->tanggal_donasi,
            'deskripsi' => $this->deskripsi ?: null,
            'bukti_transfer' => $path,
        ]);

        $this->reset(['jumlah_donasi', 'tujuan_donasi', 'deskripsi', 'bukti_transfer']);
        $this->metode_transfer = 'bca';
        $this->tanggal_donasi = now()->format('Y-m-d');
        $this->showSuccess = true;
    }

    public function render()
    {
        $riwayat = [];

        if (Auth::check()) {
            $riwayat = Donasi::where('user_id', Auth::id())
                ->latest('tanggal_donasi')
                ->latest('created_at')
                ->get();
        }

        return view('livewire.donasi-form', [
            'riwayat' => $riwayat,
        ]);
    }
}
