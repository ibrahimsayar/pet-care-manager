<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
    private int $status = Response::HTTP_OK;

    /**
     * @var array|object
     */
    private array|object $data;

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
    public function message(string $messageKey = ''): static
    {
        $this->message = __("messages.$messageKey");
        return $this;
    }

    /**
     * @param  int  $status
     * @return $this
     */
    public function status(int $status = Response::HTTP_OK): static
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
        $responseData = [];

        if ($this->message) {
            $responseData['message'] = $this->message;
        }

        $responseData = [
            ...$responseData,
            ...$this->data
        ];

        $response = response()->json($responseData, $this->status);

        foreach ($this->header as $key => $item) {
            $response->header($key, $item);
        }

        return $response;
    }
}
