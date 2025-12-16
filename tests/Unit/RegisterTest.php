<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\AuthService;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Mockery;

class RegisterTest extends TestCase
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
     * Test successful registration
     */
    public function test_register_with_valid_data(): void
    {
        // Arrange
        $data = [
            'name' => 'Test User',
            'email' => 'newuser@example.com',
            'password' => 'password123'
        ];
        
        $createdUser = new User();
        $createdUser->id = 1;
        $createdUser->name = $data['name'];
        $createdUser->email = $data['email'];
        $createdUser->password = Hash::make($data['password']);
        $createdUser->email_verified_at = Carbon::now();
        
        $this->userRepository
            ->shouldReceive('findByEmail')
            ->with($data['email'])
            ->once()
            ->andReturn(null);
        
        $this->userRepository
            ->shouldReceive('create')
            ->once()
            ->andReturnUsing(function ($userData) use ($createdUser) {
                return $createdUser;
            });

        // Act
        $result = $this->authService->register($data);

        // Assert
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('user', $result);
        $this->assertEquals($createdUser, $result['user']);
        $this->assertArrayNotHasKey('errors', $result);
    }

    /**
     * Test registration with existing email
     */
    public function test_register_with_existing_email(): void
    {
        // Arrange
        $data = [
            'name' => 'Test User',
            'email' => 'existing@example.com',
            'password' => 'password123'
        ];
        
        $existingUser = new User();
        $existingUser->id = 1;
        $existingUser->name = 'Existing User';
        $existingUser->email = $data['email'];
        $existingUser->password = Hash::make('somepassword');
        
        $this->userRepository
            ->shouldReceive('findByEmail')
            ->with($data['email'])
            ->once()
            ->andReturn($existingUser);

        // Act
        $result = $this->authService->register($data);

        // Assert
        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('errors', $result);
        $this->assertEquals('Email sudah terdaftar', $result['errors']['email']);
        $this->assertArrayNotHasKey('user', $result);
    }

    /**
     * Test that password is hashed during registration
     */
    public function test_password_is_hashed_during_registration(): void
    {
        // Arrange
        $plainPassword = 'password123';
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => $plainPassword
        ];
        
        $this->userRepository
            ->shouldReceive('findByEmail')
            ->with($data['email'])
            ->once()
            ->andReturn(null);
        
        $this->userRepository
            ->shouldReceive('create')
            ->once()
            ->andReturnUsing(function ($userData) use ($plainPassword) {
                // Verify that the password was hashed
                $this->assertNotEquals($plainPassword, $userData['password']);
                $this->assertTrue(Hash::check($plainPassword, $userData['password']));
                
                $user = new User();
                $user->password = $userData['password'];
                return $user;
            });

        // Act
        $this->authService->register($data);

        // This test will pass if the closure assertions pass
        $this->assertTrue(true);
    }

    /**
     * Test that email_verified_at is set during registration
     */
    public function test_email_verified_at_is_set_during_registration(): void
    {
        // Arrange
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123'
        ];
        
        $this->userRepository
            ->shouldReceive('findByEmail')
            ->with($data['email'])
            ->once()
            ->andReturn(null);
        
        $this->userRepository
            ->shouldReceive('create')
            ->once()
            ->andReturnUsing(function ($userData) {
                // Verify that email_verified_at is set
                $this->assertArrayHasKey('email_verified_at', $userData);
                $this->assertInstanceOf(Carbon::class, $userData['email_verified_at']);
                
                $user = new User();
                $user->email_verified_at = $userData['email_verified_at'];
                return $user;
            });

        // Act
        $this->authService->register($data);

        // This test will pass if the closure assertions pass
        $this->assertTrue(true);
    }
}
