<?php

namespace App\Livewire;

use App\Models\Adopsi;
use App\Models\Kucing;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdopsiPublicForm extends Component
{
    public string $kucing_id = '';
    public string $nama_lengkap = '';
    public string $no_hp = '';
    public string $domisili = '';
    public string $status = '';
    public string $alasan = '';
    public string $pro_dokter_hewan = '';
    public string $update_kabar = '';
    public string $penghasilan = '';

    public bool $showSuccess = false;

    protected function rules(): array
    {
        return [
            'kucing_id' => ['required', 'exists:kucing,id'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'regex:/^08[0-9]{8,11}$/'],
            'domisili' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Bekerja,Kuliah,Lainnya'],
            'alasan' => ['required', 'string'],
            'pro_dokter_hewan' => ['required', 'in:Ya,Tidak,Mungkin'],
            'update_kabar' => ['required', 'in:Ya,Tidak'],
            'penghasilan' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected $messages = [
        'kucing_id.required' => 'Pilih kucing yang ingin diajukan.',
        'kucing_id.exists' => 'Kucing yang dipilih tidak valid.',
        'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
        'no_hp.required' => 'Nomor WhatsApp wajib diisi.',
        'no_hp.regex' => 'Nomor WhatsApp harus diawali 08 dan valid.',
        'domisili.required' => 'Domisili wajib diisi.',
        'status.required' => 'Status wajib dipilih.',
        'alasan.required' => 'Alasan adopsi wajib diisi.',
        'pro_dokter_hewan.required' => 'Pilih sikap terhadap dokter hewan.',
        'update_kabar.required' => 'Pilih kesiapan update kabar.',
        'penghasilan.required' => 'Penghasilan wajib diisi.',
        'penghasilan.numeric' => 'Penghasilan harus berupa angka.',
    ];

    public function mount(?string $kucingId = null): void
    {
        $user = Auth::user();

        if ($user) {
            $this->nama_lengkap = $user->nama_lengkap ?? '';
        }

        if ($kucingId && Kucing::query()->whereKey($kucingId)->where('open_adopsi', true)->exists()) {
            $this->kucing_id = $kucingId;
        }
    }

    public function submit(): void
    {
        $validated = $this->validate();

        Adopsi::create([
            'user_id' => Auth::id(),
            'kucing_id' => (int) $validated['kucing_id'],
            'tanggal_pengajuan' => now(),
            'status_adopsi' => 'Pending',
            'nama_lengkap' => $validated['nama_lengkap'],
            'status' => $validated['status'],
            'alasan' => $validated['alasan'],
            'no_hp' => $validated['no_hp'],
            'domisili' => $validated['domisili'],
            'pro_dokter_hewan' => $validated['pro_dokter_hewan'],
            'update_kabar' => $validated['update_kabar'],
            'penghasilan' => (float) $validated['penghasilan'],
        ]);

        $selectedKucingId = $this->kucing_id;

        $this->reset([
            'kucing_id',
            'no_hp',
            'domisili',
            'status',
            'alasan',
            'pro_dokter_hewan',
            'update_kabar',
            'penghasilan',
        ]);

        $this->kucing_id = $selectedKucingId;
        $this->showSuccess = true;
    }

    public function render()
    {
        $kucingTersedia = Kucing::query()
            ->where('open_adopsi', true)
            ->orderBy('nama_kucing')
            ->get();

        $riwayat = [];

        if (Auth::check()) {
            $riwayat = Adopsi::query()
                ->with('kucing')
                ->where('user_id', Auth::id())
                ->latest('tanggal_pengajuan')
                ->latest('created_at')
                ->get();
        }

        return view('livewire.adopsi-public-form', [
            'kucingTersedia' => $kucingTersedia,
            'riwayat' => $riwayat,
        ]);
    }
}
