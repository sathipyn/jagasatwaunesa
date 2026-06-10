<?php

namespace App\Livewire;

use App\Models\LaporanKasus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class LaporKasusForm extends Component
{
    use WithFileUploads;

    public string $judul_laporan = '';
    public string $kategori_kasus = '';
    public string $deskripsi_kasus = '';
    public string $lokasi_laporan = '';
    public $bukti_pendukung = [];
    
    public bool $showSuccess = false;

    protected $messages = [
        'judul_laporan.required'   => 'Judul laporan wajib diisi.',
        'kategori_kasus.required'  => 'Kategori kasus wajib dipilih.',
        'kategori_kasus.in'        => 'Kategori kasus yang dipilih tidak valid.',
        'deskripsi_kasus.required' => 'Deskripsi kasus wajib diisi.',
        'bukti_pendukung.*.image'   => 'File harus berupa gambar.',
        'bukti_pendukung.*.max'     => 'Ukuran file maksimal 10MB.',
    ];

    protected function rules(): array
    {
        return [
            'judul_laporan'     => 'required|string|max:255',
            'kategori_kasus'    => ['required', Rule::in(array_keys(LaporanKasus::kategoriKasusOptions()))],
            'deskripsi_kasus'   => 'required|string',
            'lokasi_laporan'    => 'nullable|string|max:255',
            'bukti_pendukung.*' => 'nullable|image|max:10240',
        ];
    }

    public function submit()
    {
        $this->validate();

        // Upload bukti pendukung
        $paths = [];
        if ($this->bukti_pendukung) {
            foreach ($this->bukti_pendukung as $file) {
                $paths[] = $file->storeAs(
                    'laporan-kasus',
                    Str::uuid() . '.' . $file->getClientOriginalExtension(),
                    'public'
                );
            }
        }

        LaporanKasus::create([
            'user_id'          => Auth::id(),
            'kategori_kasus'   => $this->kategori_kasus,
            'judul_laporan'    => $this->judul_laporan,
            'deskripsi_kasus'  => $this->deskripsi_kasus,
            'tanggal_laporan'  => now(),
            'lokasi_laporan'   => $this->lokasi_laporan,
            'status_laporan'   => 'Diproses',
            'bukti_pendukung'  => !empty($paths) ? $paths : null,
        ]);

        // Reset form
        $this->reset(['judul_laporan', 'kategori_kasus', 'deskripsi_kasus', 'lokasi_laporan', 'bukti_pendukung']);
        $this->showSuccess = true;
    }

    public function render()
    {
        $riwayat = [];
        if (Auth::check()) {
            $riwayat = LaporanKasus::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('livewire.lapor-kasus-form', [
            'riwayat' => $riwayat,
            'kategoriKasus' => LaporanKasus::kategoriKasusCards(),
        ]);
    }
}
