<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\AuthService;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mockery;

class LoginTest extends TestCase
{
    protected $userRepository;
    protected $authService;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock UserRepository
        $this->userRepository = Mockery::mock(UserRepositoryInterface::class);
        $this->authService = new AuthService($this->userRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Test successful login
     */
    public function test_login_with_valid_credentials(): void
    {
        // Arrange
        $email = 'user@example.com';
        $password = 'password123';
        $hashedPassword = Hash::make($password);
        
        $user = new User();
        $user->id = 1;
        $user->name = 'Test User';
        $user->email = $email;
        $user->password = $hashedPassword;
        
        $this->userRepository
            ->shouldReceive('findByEmail')
            ->with($email)
            ->once()
            ->andReturn($user);
        
        Auth::shouldReceive('login')
            ->with($user)
            ->once();

        // Act
        $result = $this->authService->login($email, $password);

        // Assert
        $this->assertTrue($result['success']);
        $this->assertEquals($user, $result['user']);
        $this->assertArrayNotHasKey('errors', $result);
    }

    /**
     * Test login with non-existent email
     */
    public function test_login_with_non_existent_email(): void
    {
        // Arrange
        $email = 'nonexistent@example.com';
        $password = 'password123';
        
        $this->userRepository
            ->shouldReceive('findByEmail')
            ->with($email)
            ->once()
            ->andReturn(null);

        // Act
        $result = $this->authService->login($email, $password);

        // Assert
        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('errors', $result);
        $this->assertEquals('Email tidak ditemukan', $result['errors']['email']);
    }

    /**
     * Test login with wrong password
     */
    public function test_login_with_wrong_password(): void
    {
        // Arrange
        $email = 'user@example.com';
        $correctPassword = 'password123';
        $wrongPassword = 'wrongpassword';
        $hashedPassword = Hash::make($correctPassword);
        
        $user = new User();
        $user->id = 1;
        $user->name = 'Test User';
        $user->email = $email;
        $user->password = $hashedPassword;
        
        $this->userRepository
            ->shouldReceive('findByEmail')
            ->with($email)
            ->once()
            ->andReturn($user);

        // Act
        $result = $this->authService->login($email, $wrongPassword);

        // Assert
        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('errors', $result);
        $this->assertEquals('Password salah', $result['errors']['password']);
    }

    /**
     * Test logout functionality
     */
    public function test_logout(): void
    {
        // Arrange
        Auth::shouldReceive('logout')
            ->once();

        // Act
        $this->authService->logout();

        // Assert - if no exception thrown, test passes
        $this->assertTrue(true);
    }
}
