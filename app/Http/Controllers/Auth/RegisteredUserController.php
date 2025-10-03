<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
'role' => ['required', 'string', Rule::in(['auditee', 'auditor'])],
        'name' => ['required', 'string', 'max:255'],
        'no_tlp' => ['required', 'string', 'max:15'],
        'nip' => ['required', 'string', 'max:18', 'unique:users'],
        'nidn_nuptk' => ['required', 'string', 'max:255', 'unique:users'],
        'program_studi' => ['required', 'string', 'max:255'],
        'fakultas' => ['required', 'string', 'max:255'],
        'tanda_tangan' => ['required', 'image', 'max:1024'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $signaturePath = $request->file('tanda_tangan')->store('signatures', 'public');

        $user = User::create([
            'role' => $request->role,
            'name' => $request->name,
            'no_tlp' => $request->no_tlp,
            'nip' => $request->nip,
            'nidn_nuptk' => $request->nidn_nuptk,
            'program_studi' => $request->program_studi,
            'fakultas' => $request->fakultas,
            'signature_path' => $signaturePath,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('login')->with('status', 'Registrasi berhasil! Silakan login.');
    }
}