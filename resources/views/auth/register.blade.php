<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div x-data="{ 
                step: 1,
                passwordVisible: false,
                passwordConfirmationVisible: false,
                validateStep1() {
                    const inputs = this.$refs.step1.querySelectorAll('input, select');
                    let allValid = true;
                    for (const input of inputs) {
                        if (!input.checkValidity()) {
                            input.reportValidity();
                            allValid = false;
                            break; 
                        }
                    }
                    if (allValid) {
                        this.step = 2;
                    }
                }
            }">

            <div x-show="step === 1" x-ref="step1">
                <h2 class="text-2xl font-bold text-center mb-4">Langkah 1: Data Diri</h2>
                
                {{-- Form fields for step 1 remain the same --}}
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
                    <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip" :value="old('nip')" required maxlength="18" />
                </div>
                <div class="mt-4">
                    <x-input-label for="nidn_nuptk" :value="__('NIDN/NUPTK')" />
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
                    <div class="relative">
                        <x-text-input id="password" class="block mt-1 w-full pr-10" {{-- <-- TAMBAHKAN pr-10 DI SINI --}}
                                      x-bind:type="passwordVisible ? 'text' : 'password'"
                                      name="password"
                                      required autocomplete="new-password" />
                        
                        <div @click="passwordVisible = !passwordVisible" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                           {{-- SVG Icons --}}
                           <svg x-show="!passwordVisible" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                           <svg x-show="passwordVisible" style="display: none;" class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.243 4.243L6.228 6.228" /></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <div class="relative">
                        <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10" {{-- <-- TAMBAHKAN pr-10 DI SINI --}}
                                      x-bind:type="passwordConfirmationVisible ? 'text' : 'password'"
                                      name="password_confirmation" required autocomplete="new-password" />
                        
                        <div @click="passwordConfirmationVisible = !passwordConfirmationVisible" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                            {{-- SVG Icons --}}
                            <svg x-show="!passwordConfirmationVisible" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                            <svg x-show="passwordConfirmationVisible" style="display: none;" class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.243 4.243L6.228 6.228" /></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                
                <div class="flex items-center justify-between mt-4">
                    <x-secondary-button @click.prevent="step = 1">
                        {{ __('Back') }}
                    </x-secondary-button>
                    
                    <x-primary-button>
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>