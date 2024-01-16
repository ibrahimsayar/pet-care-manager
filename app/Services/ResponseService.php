<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\select;

class ResponseService
{
    /**
     * @var array
     */
    private array $header = [];

    /**
     * @var string
     */
    private string $message = '';

    /**
     * @var int
     */
    private int $statusCode = Response::HTTP_OK;

    /**
     * @var bool
     */
    private bool $status = true;

    /**
     * @var array|object
     */
    private array|object $data = [];

    /**
     * @param  array  $header
     * @return $this
     */
    public function header(array $header = []): static
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param  string  $messageKey
     * @return $this
     */
    public function message(string $messageKey = 'SUCCESS'): static
    {
        $this->message = __("messages.$messageKey");
        return $this;
    }

    /**
     * @param  int  $statusCode
     * @return $this
     */
    public function statusCode(int $statusCode = Response::HTTP_OK): static
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param  bool  $status
     * @return $this
     */
    public function status(bool $status = true): static
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function data($data): static
    {
        $this->data = ['data' => $data];
        return $this;
    }

    /**
     * @return JsonResponse
     */
    public function response(): JsonResponse
    {
        $responseData = [
            'status' => $this->status,
            'message' => $this->message ?: __('messages.SUCCESS'),
        ];

        $responseData = [
            ...$responseData,
            ...$this->data
        ];

        $response = response()->json(
            $responseData,
            $this->statusCode
        );

        foreach ($this->header as $key => $item) {
            $response->header($key, $item);
        }

        return $response;
    }
}
