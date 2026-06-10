<?php

namespace App\Livewire;

use App\Models\Edukasi;
use App\Models\Kegiatan;
use App\Models\KomentarPostingan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostinganKomentar extends Component
{
    public ?Edukasi $edukasi = null;
    public ?Kegiatan $kegiatan = null;
    public string $isi_komentar = '';
    public bool $showSuccess = false;

    protected function rules(): array
    {
        return [
            'isi_komentar' => ['required', 'string', 'min:3', 'max:225'],
        ];
    }

    protected $messages = [
        'isi_komentar.required' => 'Komentar wajib diisi.',
        'isi_komentar.min' => 'Komentar minimal 3 karakter.',
        'isi_komentar.max' => 'Komentar maksimal 225 karakter.',
    ];

    public function submit(): void
    {
        abort_unless(Auth::check(), 403);
        abort_unless($this->edukasi || $this->kegiatan, 404);

        $validated = $this->validate();

        KomentarPostingan::create([
            'user_id' => Auth::id(),
            'edukasi_id' => $this->edukasi?->id,
            'kegiatan_id' => $this->kegiatan?->id,
            'isi_komentar' => $validated['isi_komentar'],
            'tanggal_komentar' => now(),
        ]);

        $this->reset('isi_komentar');
        $this->showSuccess = true;
    }

    public function render()
    {
        $komentar = KomentarPostingan::query()
            ->with('user')
            ->when($this->edukasi, fn ($query) => $query->where('edukasi_id', $this->edukasi->id))
            ->when($this->kegiatan, fn ($query) => $query->where('kegiatan_id', $this->kegiatan->id))
            ->latest('tanggal_komentar')
            ->latest('created_at')
            ->get();

        $judul = $this->edukasi?->judul ?? $this->kegiatan?->judul ?? 'postingan ini';
        $jenis = $this->edukasi ? 'artikel edukasi' : 'kegiatan ini';

        return view('livewire.postingan-komentar', [
            'komentar' => $komentar,
            'judul' => $judul,
            'jenis' => $jenis,
        ]);
    }
}
