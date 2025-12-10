<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthService
{
    protected UserRepositoryInterface $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function register(array $data): array
    {
        // assume validation was already performed by FormRequest
        if ($this->users->findByEmail($data['email'] ?? '')) {
            return ['success' => false, 'errors' => ['email' => 'Email sudah terdaftar']];
        }

        $data['password'] = Hash::make($data['password']);
        $data['email_verified_at'] = Carbon::now();

        $user = $this->users->create($data);

        return ['success' => true, 'user' => $user];
   
    }

    public function login(string $email, string $password): array
    {
        $user = $this->users->findByEmail($email);
        if (!$user) {
            return ['success' => false, 'errors' => ['email' => 'Email tidak ditemukan']];
        }

        if (!Hash::check($password, $user->password)) {
            return ['success' => false, 'errors' => ['password' => 'Password salah']];
        }

        Auth::login($user);
        return ['success' => true, 'user' => $user];
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
