<?php

namespace App\Livewire;

use App\Models\Komentar;
use App\Models\Kucing;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KucingKomentar extends Component
{
    public Kucing $kucing;
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

        $validated = $this->validate();

        Komentar::create([
            'user_id' => Auth::id(),
            'kucing_id' => $this->kucing->id,
            'isi_komentar' => $validated['isi_komentar'],
            'tanggal_komentar' => now(),
        ]);

        $this->reset('isi_komentar');
        $this->showSuccess = true;
    }

    public function render()
    {
        $komentar = Komentar::query()
            ->with('user')
            ->where('kucing_id', $this->kucing->id)
            ->latest('tanggal_komentar')
            ->latest('created_at')
            ->get();

        return view('livewire.kucing-komentar', [
            'komentar' => $komentar,
        ]);
    }
}
