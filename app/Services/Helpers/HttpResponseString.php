<?php

use App\Enums\HttpCode;
use App\Enums\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\MessageBag;

if (!function_exists('apiResponseString')) {
    /**
     * Get the api response string
     * @param  string                                           $message
     * @param  HttpCode                                         $httpCode
     * @param  JsonResource|ResourceCollection|array|MessageBag $resource
     * @param  bool|null                                        $isPaginate
     * @return JsonResponse
     */
    function apiResponseString(string $message, HttpCode $httpCode, JsonResource|ResourceCollection|array|MessageBag $resource = [], ?bool $isPaginate = false): JsonResponse
    {
        $data['message'] = $message;
        $data['success'] = in_array($httpCode->toString(), ['200', '201']) ? Status::DONE->toString() : Status::FAIL->toString();
        $data['resCode'] = $httpCode->toString();
        if (isset($resource) && !empty($resource)) {
            $data['payload'] = $isPaginate === true ? $resource->response()->getData(true) : $resource;
        }
        return response()->json($data)->header('Content-Type', 'application/json')->header('Accept', 'application/json');
    }
}

if (!function_exists('webResponseStatus')) {
    /**
     * Get the web redirect status
     * @param  string    $context
     * @param  string    $message
     * @param  bool|null $error
     * @return array
     */
    function webResponseStatus(string $context, string $message, ?bool $error = true): array
    {
        return array_merge_recursive(['success' => $error ? Status::ERROR->toString() : Status::SUCCESS->toString()], [
            'context' => $context,
            'message' => $message
        ]);
    }
}
