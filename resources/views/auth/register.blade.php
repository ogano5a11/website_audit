<x-guest-layout>
    {{-- Tambahkan x-ref="form" untuk referensi di Alpine.js --}}
    <form x-ref="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div x-data="{ 
                step: 1,
                validateStep1() {
                    // Ambil semua input yang terlihat di langkah 1
                    const inputs = this.$refs.step1.querySelectorAll('input, select');
                    let allValid = true;
                    
                    // Cek validitas setiap input menggunakan HTML5 validation API
                    for (const input of inputs) {
                        if (!input.checkValidity()) {
                            // Jika ada yang tidak valid, tampilkan pesan error browser dan hentikan
                            input.reportValidity();
                            allValid = false;
                            break; 
                        }
                    }

                    // Hanya lanjut ke step 2 jika semua valid
                    if (allValid) {
                        this.step = 2;
                    }
                }
            }">

            {{-- Tambahkan x-ref="step1" untuk referensi --}}
            <div x-show="step === 1" x-ref="step1">
                <h2 class="text-2xl font-bold text-center mb-4">Langkah 1: Data Diri</h2>

                <div class="mt-4">
                    <x-input-label for="role" :value="__('Daftar Sebagai')" />
                    <select id="role" name="role" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="auditee">Auditee</option>
                        <option value="auditor">Auditor</option>
                    </select>
                </div>

                <div class="mt-4">
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="no_tlp" :value="__('No. Telepon')" />
                    <x-text-input id="no_tlp" class="block mt-1 w-full" type="text" name="no_tlp" :value="old('no_tlp')" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="nip" :value="__('NIP')" />
                    {{-- Tambahkan required dan maxlength --}}
                    <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip" :value="old('nip')" required maxlength="18" />
                </div>
                
                <div class="mt-4">
                    <x-input-label for="nidn_nuptk" :value="__('NIDN/NUPTK')" />
                    {{-- Tambahkan required --}}
                    <x-text-input id="nidn_nuptk" class="block mt-1 w-full" type="text" name="nidn_nuptk" :value="old('nidn_nuptk')" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="program_studi" :value="__('Program Studi')" />
                    <x-text-input id="program_studi" class="block mt-1 w-full" type="text" name="program_studi" :value="old('program_studi')" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="fakultas" :value="__('Fakultas')" />
                    <x-text-input id="fakultas" class="block mt-1 w-full" type="text" name="fakultas" :value="old('fakultas')" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="tanda_tangan" :value="__('Upload Tanda Tangan (Gambar)')" />
                    <input id="tanda_tangan" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="tanda_tangan" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    {{-- Panggil fungsi validateStep1() saat tombol diklik --}}
                    <x-primary-button @click.prevent="validateStep1()">
                        {{ __('Next') }}
                    </x-primary-button>
                </div>
            </div>

            <div x-show="step === 2" style="display: none;">
                <h2 class="text-2xl font-bold text-center mb-4">Langkah 2: Data Akun</h2>
            
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email (untuk login)')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
            
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
            
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>
            
                <div class="flex items-center justify-between mt-4">
                    <x-secondary-button @click.prevent="step = 1">
                        {{ __('Back') }}
                    </x-secondary-button>
                    
                    {{-- Tombol submit akan mengirim seluruh form, yang kemudian divalidasi oleh Laravel --}}
                    <x-primary-button>
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>