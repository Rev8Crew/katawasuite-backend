<?php

declare(strict_types=1);

namespace App\Models\Common;

use Laravel\Telescope\EntryType;
use Laravel\Telescope\IncomingEntry;

/**
 * [.
{
"Laravel\\Telescope\\IncomingEntry": {
"uuid": "95f357eb-960c-4910-9530-7addf6dd8adf",
"batchId": null,
"type": "request",
"familyHash": null,
"user": null,
"content": {
"ip_address": "172.18.0.1",
"uri": "",
"method": "POST",
"controller_action": "",
"middleware": [
"web",
],
"headers": {
"authorization": "********",
"content-type": "application/json",
"user-agent": "PostmanRuntime/7.29.0",
"accept": {"*",
"postman-token": "809a0081-dce5-48bb-9721-4bb28030a328",
"host": "localhost:8000",
"accept-encoding": "gzip, deflate, br",
"connection": "keep-alive",
"content-length": "2174",
"cookie": "gulliver_session=GX6kc7vt9z13VNaeLly1DPQ934G6DB21nOaZPtyl; locale=en",
"php-auth-user": "gulliver",
"php-auth-pw": "********"
},
"payload": {

},
"session": {
"_token": "OAnt6i6n5Eui96hkZO4fYpeOHwnnt4TZSjnfwm0r",
"_flash": {
"old": [],
"new": []
}
},
"response_status": 200,
"response": {
},
"duration": 521,
"memory": 32.5,
"hostname": "dd4d430ce331"
},
"tags": [],
"recordedAt": "2022-03-31T10:50:46.487256Z"
}
}
]
 */
class EntryContentDto
{
    public ?string $requestType;

    public ?int $responseStatus;

    // Content

    /** @var string|null Example: 192.168.0.1 */
    public ?string $ip;

    /** @var string|null Example: /api/mobile/calculate-cart */
    public ?string $uri;

    /** @var string|null Example: POST */
    public ?string $method;

    /** @var string|null Example: Controller@action */
    public ?string $controllerAction;

    /** @var array|null Example: ["web",""] */
    public ?array $middlewares;

    public ?int $duration;

    public ?array $headers;

    /**
     *  Request params.
     */
    public ?array $payload;

    public $response = null;

    public function __construct(IncomingEntry $entry)
    {
        $this->requestType = $entry->type;
        $this->responseStatus = $entry->content['response_status'] ?? null;

        $this->ip = $entry->content['ip'] ?? null;
        $this->uri = $entry->content['uri'] ?? null;
        $this->method = $entry->content['method'] ?? null;
        $this->controllerAction = $entry->content['controller_action'] ?? null;
        $this->middlewares = $entry->content['middleware'] ?? null;

        $this->headers = $entry->content['headers'] ?? null;
        $this->payload = $entry->content['payload'] ?? null;
        $this->response = $entry->content['response'] ?? null;

        $this->duration = isset($entry->content['duration']) ? (int) $entry->content['duration'] : null;
    }

    public function isRequest(): bool
    {
        return $this->requestType === EntryType::REQUEST;
    }

    public function isErrorRequest(int $errorCode): bool
    {
        return $this->isRequest() && $this->responseStatus === $errorCode;
    }

    public function isUriContain(string $needle): bool
    {
        return strpos($this->uri ?? '', $needle) !== false;
    }

    public function isSlowRequest(): bool
    {
        return $this->isRequest() && $this->duration && $this->duration > 1000;
    }

    public function isApiRequest(): bool
    {
        return $this->isRequest() && $this->isUriContain('/api/');
    }

    public function hasMiddleware(string $needle): bool
    {
        foreach ($this->middlewares ?? [] as $middleware) {
            if (str_contains($middleware, $needle)) {
                return true;
            }
        }

        return false;
    }
}
