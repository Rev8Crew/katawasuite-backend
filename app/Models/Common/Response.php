<?php

namespace App\Models\Common;

use App\Enums\ResponseStatusEnum;
use App\Helpers\BytesForHuman;
use App\Traits\Makeable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Throwable;

class Response implements Arrayable
{
    use Makeable;

    protected ResponseStatusEnum $status;

    protected JsonResource|Collection|array|Model $data = [];

    protected bool $hasErrors = false;

    protected array $errors = [];

    protected array $validationErrors = [];

    protected int $executionTime = 0;

    protected int $memoryUsageStart;

    protected string $memoryPeakUsage;

    protected Carbon $date;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        // Sets memory usage
        $this->memoryUsageStart = memory_get_usage();
        $this->executionTime = microtime(true);

        $this->status = ResponseStatusEnum::Unknown;
        $this->date = Carbon::now();
    }

    /**
     *  Return response with given error
     *
     * @return $this
     */
    public function withError(int $errorCode, string $message): self
    {
        $this->hasErrors = true;
        $this->status = ResponseStatusEnum::Error;

        $this->errors[] = [
            'code' => $errorCode,
            'message' => $message,
        ];

        return $this;
    }

    /**
     * @return $this
     */
    public function catch(Throwable $throwable): Response
    {
        $code = $throwable->getCode() ?: SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

        return $this->withError($code, $throwable->getMessage());
    }

    /**
     * @param  mixed  $data
     */
    public function withData($data): Response
    {
        $this->data = $data;
        $this->status = ResponseStatusEnum::Success;

        $this->memoryPeakUsage = BytesForHuman::format(memory_get_usage() - $this->memoryUsageStart);

        return $this;
    }

    public function withStatus(int $status): Response
    {
        $this->status = ResponseStatusEnum::from($status);

        return $this;
    }

    /**
     * @return $this
     */
    private function withMessage(string $message = ''): Response
    {
        if (! $message) {
            return $this;
        }
        $this->data['message'] = $message;

        return $this;
    }

    public function success(string $message = ''): Response
    {
        return $this->withStatus(ResponseStatusEnum::Success->value)->withMessage($message);
    }

    public function validation(Validator $validator): Response
    {
        if ($validator->fails()) {
            $this->withError(SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY, 'Validation Errors');
            $this->withStatus(ResponseStatusEnum::Error->value);

            foreach ($validator->errors()->getMessages() as $field => $error) {
                $this->validationErrors[$field] = $error;
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'status' => $this->status->value,
            'hasErrors' => $this->hasErrors,
            'errors' => $this->errors,
            'validationErrors' => $this->validationErrors,
            'execution_time' => microtime(true) - $this->executionTime,
            'memory_start_usage' => $this->memoryUsageStart,
            'memory_peak_usage' => $this->memoryPeakUsage,
            'memory_end_usage' => BytesForHuman::format(memory_get_usage() - $this->memoryUsageStart),
            'date' => $this->date->format('Y-m-d H:i:s'),
        ];
    }
}
