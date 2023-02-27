<?php

namespace Modules\User\Tests\Unit;

use App\Enums\ActiveStatusEnum;
use Modules\User\Database\factories\UserFactory;
use Modules\User\Entities\DTO\RegisterDto;
use Modules\User\Services\UserServiceInterface;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private ?UserServiceInterface $userService = null;

    private ?UserFactory $userFactory = null;

    public function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserServiceInterface::class);
        $this->userFactory = $this->app->make(UserFactory::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->userService = null;
        $this->userFactory = null;
    }

    public function testCreate(): void
    {
        $dto = new RegisterDto(
            $this->faker->name(),
            $this->faker->unique()->safeEmail(),
            $this->faker->password(),
            $this->faker->phoneNumber(),
            ActiveStatusEnum::Active,
            false
        );

        $user = $this->userService->create($dto);

        $this->assertSame($dto->name, $user->name);
        $this->assertSame($dto->email, $user->email);
        $this->assertTrue(\Hash::check($dto->password, $user->password));
        $this->assertSame($dto->phone, $user->phone);
        $this->assertSame($dto->status->value, $user->is_active);
        $this->assertNull($user->email_verified_at);
    }

    public function testGetUserByEmail(): void
    {
        $user = $this->userFactory->create();

        $null = $this->userService->getUserByEmail('test');

        $this->assertNull($null);

        $someUser = $this->userService->getUserByEmail($user->email);

        $this->assertSame($user->id, $someUser->id);
    }
}
