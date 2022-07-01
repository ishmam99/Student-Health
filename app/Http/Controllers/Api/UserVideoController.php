<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\WatchedVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserVideoController extends Controller
{
    public function __construct(WatchedVideo $watch_vedio)
    {
        $this->watch_vedio = $watch_vedio;
    }

    public function watchedVideoCount($id): JsonResponse
    {
        //  dd($id);
        $videos = auth()->user()->videoWatchedToday;


        $responseVideos = array();

        foreach ($videos as $video) {
            if ($video->ads_type == 1 && $video->task_id == $id) {
                $responseVideos[WatchedVideo::ADSENCE] = $video->watched_count;
                $responseVideos['Task ID'] = $video->task_id;
            } else if ($video->ads_type == 2  && $video->task_id == $id) {

                $responseVideos[WatchedVideo::ADSTERRA] = $video->watched_count;
                $responseVideos['Task ID'] = $video->task_id;
            } else if ($video->ads_type == 3  && $video->task_id == $id) {
                $responseVideos[WatchedVideo::MEDIA] = $video->watched_count;
                $responseVideos['Task ID'] = $video->task_id;
            } else if ($video->ads_type == 4 && $video->task_id == $id) {
                $responseVideos[WatchedVideo::CAPCHA] = $video->watched_count;
                $responseVideos['Task ID'] = $video->task_id;
            } else if ($video->ads_type == 5 && $video->task_id == $id) {
                $responseVideos[WatchedVideo::MEGATYPE] = $video->watched_count;
                $responseVideos['Task ID'] = $video->task_id;
            } else if ($video->ads_type == 6 && $video->task_id == $id) {
                $responseVideos[WatchedVideo::ADSTERRA] = $video->watched_count;
                $responseVideos['Task ID'] = $video->task_id;
            }
        }
        return $this->apiResponse(200, 'success', 'Video watched count.', $responseVideos);
    }

    public function watchedVideo(Request $request): JsonResponse
    {
        $todayWatchedVideo = null;
        $subscribeDays = daysCount(auth()->user()->subscribePackage->first()->pivot->updated_at);
        if ($subscribeDays <= WatchedVideo::ADSMAXDAYS) {
            $todayWatchedVideo = $this->createWatchVedio($request->ads_type, $request->task_id, ['price' => auth()->user()->package->ads_period_1_price, 'tasks' => auth()->user()->package->tasks, $request->task_id, 'period' => 1]);
        } else if ($subscribeDays <= WatchedVideo::ADSMAXDAYS + 50) {
            $todayWatchedVideo = $this->createWatchVedio($request->ads_type, $request->task_id, ['price' => auth()->user()->package->ads_period_2_price, 'tasks' => auth()->user()->package->tasks, $request->task_id, 'period' => 2]);
        } else if ($subscribeDays <= WatchedVideo::ADSMAXDAYS + 100) {
            $todayWatchedVideo = $this->createWatchVedio($request->ads_type, $request->task_id, ['price' => auth()->user()->package->ads_period_3_price, 'tasks' => auth()->user()->package->tasks, $request->task_id, 'period' => 3]);
        } else if ($subscribeDays <= WatchedVideo::ADSMAXDAYS + 150) {
            $todayWatchedVideo = $this->createWatchVedio($request->ads_type, $request->task_id, ['price' => auth()->user()->package->ads_period_4_price, 'tasks' => auth()->user()->package->tasks, 'period' => 4]);
        } else {
            return $this->apiResponse(201, 'success', 'Your Subscribe Package days ended.', ['days' => $subscribeDays]);
        }
        return $this->apiResponse(201, 'success', $todayWatchedVideo['message'], ['watched_count' => $todayWatchedVideo['watched_count']]);
    }
    // fgfg

    public function createWatchVedio($adsType, $task_id, $package)
    {
        //  dd($adsType,$task_id);


        $count = auth()->user()->package->id;
        $todayWatchedVideo = auth()->user()->watchedVideos()
            ->whereDate('created_at', now()->toDateString())
            ->where(['package' => $count])
            ->where(['ads_type' => $adsType])
            ->where(['task_id' => $task_id])
            ->firstOrCreate();

        if ($adsType == 4 && $todayWatchedVideo->package == $count) {
            if ($todayWatchedVideo->task_id == ($count * 2) + 8 && $todayWatchedVideo->watched_count == 40) {
                return ['watched_count' => $todayWatchedVideo->watched_count, 'message' => 'Banner watch Target completed For Today.'];
            } elseif ($todayWatchedVideo->task_id <= ($count * 2) + 8 && $todayWatchedVideo->watched_count == 40) {

                return ['watched_count' => $todayWatchedVideo->watched_count, 'message' => 'Banner watch Target completed For Task ' . $task_id];
            }
        } else {
            if ($todayWatchedVideo->watched_count >= $package['tasks'] / 5) {
                return ['watched_count' => $todayWatchedVideo->watched_count, 'message' => 'Video watch target completed.'];
            }
        }


        $todayWatchedVideo->period = $package['period'];
        $todayWatchedVideo->package = $count;
        $todayWatchedVideo->ads_type = $adsType;
        $todayWatchedVideo->task_id = $task_id;
        $todayWatchedVideo->increment('watched_count');
        $todayWatchedVideo->save();

        if ($adsType == 4) {

            if ($todayWatchedVideo->watched_count == 40) {
                Transaction::newTransaction(auth()->user()->id, Transaction::TYPE_VIDEO_WATCH_BONUS, Transaction::STATUS_CREDITED, $package['price']);
                auth()->user()->increment('balance', $package['price']);
                return ['watched_count' => $todayWatchedVideo->watched_count, 'message' => 'Banner watch Target completed.'];
            } elseif ($todayWatchedVideo->watched_count <= 40) {

                if ($todayWatchedVideo->watched_count >= 30) {
                    $batch = 3;
                    return ['watched_count' => $todayWatchedVideo->watched_count, 'message' => 'Banner watch completed for Batch ' . $batch];
                } else if ($todayWatchedVideo->watched_count >= 20) {
                    $batch = 2;
                    return ['watched_count' => $todayWatchedVideo->watched_count, 'message' => 'Banner watch completed for Batch ' . $batch];
                } else if ($todayWatchedVideo->watched_count >= 10) {
                    $batch = 1;
                    return ['watched_count' => $todayWatchedVideo->watched_count, 'message' => 'Banner watch completed for Batch ' . $batch];
                } else
                    return ['watched_count' => $todayWatchedVideo->watched_count, 'message' => 'Banner watch completed '];
            }
        } else {
            Transaction::newTransaction(auth()->user()->id, Transaction::TYPE_VIDEO_WATCH_BONUS, Transaction::STATUS_CREDITED, $package['price']);
            auth()->user()->increment('balance', $package['price']);
        }

        return ['watched_count' => $todayWatchedVideo->watched_count, 'message' => 'Video watch completed.'];
    }
}
