<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoticeResource;
use App\Models\Notice;
use Illuminate\Http\JsonResponse;

class NoticeController extends Controller
{
    public function index(): JsonResponse
    {
        return $this->apiResponseResourceCollection(
            200,
            'Notice List',
            NoticeResource::make(
                Notice::active()
                    ->select(['title', 'message'])
                    ->latest()
                    ->paginate(10)
            )
        );
    }
}
