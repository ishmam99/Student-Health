<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected int $itemPerPage = 20;
    protected string $defaultOrderBy = 'desc';

    /**
     * A Function to PUT a sl number with Collection of data.
     *
     * @param $collection - A collection of data collected with paginate function
     * @return void
     */
    public function putSL($collection)
    {
        $start = ($collection->currentPage() * $this->itemPerPage - $this->itemPerPage) + 1;
        $collection->each(function ($value) use (&$start) {
            $value->sl = $start++;
        });

        // Checking pagination need or not and putting to collection
        $collection->hasPagination = $collection->total() > $collection->perPage();
    }

    public function apiResponse(int $statusCode,string $status = null, string $statusMessage, $data = []): JsonResponse
    {
        $data['message'] = $statusMessage;
        $data['status']=$status;
        return response()->json($data, $statusCode);
    }

    public function apiResponseResourceCollection(int $statusCode, string $statusMessage, object $resourceCollection): JsonResponse
    {
        $resourceCollection = $resourceCollection->additional([
            'message' => $statusMessage
        ])->response()->getData();
        return response()->json($resourceCollection, $statusCode);
    }

    public function dateFormat(Carbon $carbon): string
    {
        return $carbon->format('d-m-Y');
    }
}
