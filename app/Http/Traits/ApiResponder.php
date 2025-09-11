<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Trait untuk standarisasi response JSON API
 */
trait ApiResponder
{
    /**
     * Mengirim response sukses.
     *
     * @param mixed $data Data yang akan dikirim.
     * @param string $statusMessage Pesan status response.
     * @param int $statusCode Kode status HTTP.
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data, string $statusMessage = 'Success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'ResponseStatus' => $statusMessage,
            'ResponseMessage' => $data,
        ], $statusCode);
    }

    /**
     * Mengirim response error.
     *
     * @param string $errorMessage Pesan error.
     * @param int $statusCode Kode status HTTP.
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse(string $errorMessage, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'ResponseStatus' => 'Error',
            'ResponseMessage' => [
                'error' => $errorMessage
            ],
        ], $statusCode);
    }
}
