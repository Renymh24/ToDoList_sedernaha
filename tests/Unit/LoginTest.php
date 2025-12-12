<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Mockery;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepository;
    protected $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = Mockery::mock(UserRepositoryInterface::class);
        $this->authService = new AuthService($this->userRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Test login dengan email dan password yang benar
     */
    public function test_login_dengan_kredensial_valid(): void
    {
        $user = new User([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);
        $user->id = 1;

        $this->userRepository->shouldReceive('findByEmail')
            ->with('test@example.com')
            ->once()
            ->andReturn($user);

        Auth::shouldReceive('login')
            ->with($user)
            ->once();

        $result = $this->authService->login('test@example.com', 'password123');

        $this->assertTrue($result['success']);
        $this->assertEquals($user, $result['user']);
    }

    /**
     * Test login dengan email yang tidak terdaftar
     */
    public function test_login_dengan_email_tidak_ditemukan(): void
    {
        $this->userRepository->shouldReceive('findByEmail')
            ->with('notfound@example.com')
            ->once()
            ->andReturn(null);

        $result = $this->authService->login('notfound@example.com', 'password123');

        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('errors', $result);
        $this->assertEquals('Email tidak ditemukan', $result['errors']['email']);
    }

    /**
     * Test login dengan password yang salah
     */
    public function test_login_dengan_password_salah(): void
    {
        $user = new User([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);
        $user->id = 1;

        $this->userRepository->shouldReceive('findByEmail')
            ->with('test@example.com')
            ->once()
            ->andReturn($user);

        $result = $this->authService->login('test@example.com', 'wrongpassword');

        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('errors', $result);
        $this->assertEquals('Password salah', $result['errors']['password']);
    }

    /**
     * Test register dengan data valid
     */
    public function test_register_dengan_data_valid(): void
    {
        $userData = [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123'
        ];

        $createdUser = new User([
            'name' => 'New User',
            'email' => 'newuser@example.com'
        ]);
        $createdUser->id = 1;

        $this->userRepository->shouldReceive('findByEmail')
            ->with('newuser@example.com')
            ->once()
            ->andReturn(null);

        $this->userRepository->shouldReceive('create')
            ->once()
            ->andReturn($createdUser);

        $result = $this->authService->register($userData);

        $this->assertTrue($result['success']);
        $this->assertEquals($createdUser, $result['user']);
    }

    /**
     * Test register dengan email yang sudah terdaftar
     */
    public function test_register_dengan_email_sudah_terdaftar(): void
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'existing@example.com',
            'password' => 'password123'
        ];

        $existingUser = new User([
            'name' => 'Existing User',
            'email' => 'existing@example.com'
        ]);
        $existingUser->id = 1;

        $this->userRepository->shouldReceive('findByEmail')
            ->with('existing@example.com')
            ->once()
            ->andReturn($existingUser);

        $result = $this->authService->register($userData);

        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('errors', $result);
        $this->assertEquals('Email sudah terdaftar', $result['errors']['email']);
    }

    /**
     * Test logout berhasil
     */
    public function test_logout_berhasil(): void
    {
        Auth::shouldReceive('logout')
            ->once();

        $this->authService->logout();

        $this->assertTrue(true); // Jika tidak ada exception, test berhasil
    }
}
