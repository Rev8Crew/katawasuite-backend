<?php

namespace Modules\Feedback\Tests\Unit;

use AllowDynamicProperties;
use Encore\Admin\Show\Relation;
use Modules\Feedback\Entities\DTO\FeedbackCreateDto;
use Modules\Feedback\Enums\FeedbackRelationEnum;
use Modules\Feedback\Services\FeedbackServiceInterface;
use Modules\User\Database\factories\UserFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

#[AllowDynamicProperties] class FeedbackServiceTest extends TestCase
{
    private ?FeedbackServiceInterface $feedbackService = null;

    private ?UserFactory $userFactory = null;

    public function setUp(): void
    {
        parent::setUp();

        $this->feedbackService = $this->app->make(FeedbackServiceInterface::class);
        $this->userFactory = $this->app->make(UserFactory::class);
    }

    public function testCreate(): void
    {
        $user = $this->userFactory->create();

        $dto = new FeedbackCreateDto(
            $this->faker->name(),
            $this->faker->email(),
            $this->faker->text(),
            $user->id,
            $this->relation = 'site'
        );

        $feedback = $this->feedbackService->create($dto);

        $this->assertSame($dto->name, $feedback->name);
        $this->assertSame($dto->email, $feedback->email);
        $this->assertSame($dto->text, $feedback->text);
        $this->assertSame($dto->userId, $feedback->user_id);
        $this->assertSame($dto->relation, $feedback->relation);
    }
}
