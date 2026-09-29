<?php

namespace App\Controllers\Core;

use App\Models\User;
use App\Models\Siswa;
use Sakuci\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::current();

        $siswa = Siswa::where(
            'id_user',
            $user->id
        )->first();

        return view('core.dashboard', [
            'user' => $user,
            'siswa' => $siswa
        ]);
    }

    public function admin()
    {
        return view('core.admin.dashboard', [
            'user' => User::current()
        ]);
    }
}