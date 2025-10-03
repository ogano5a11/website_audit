<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'auditor') {
            return redirect()->route('auditor.dashboard');
        } elseif ($role === 'auditee') {
            return redirect()->route('auditee.dashboard');
        } else {
            // Fallback jika role tidak terdefinisi
            return redirect('/');
        }
    }
}
