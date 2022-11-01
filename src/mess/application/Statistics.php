<?php

namespace Mess\Application;

use Mess\Persistence\Database\User\UserStatisticsRepository;

class Statistics
{
    private UserStatisticsRepository $statisticsRepository;

    public function __construct(UserStatisticsRepository $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    public function userStatistics(int $userId): UserStatistics
    {
        return new UserStatistics(
            $this->statisticsRepository->countFriend($userId),
            $this->statisticsRepository->CountPost($userId),
            $this->statisticsRepository->CountPhoto($userId),
            $this->statisticsRepository->CountPostLike($userId, 'like'),
            $this->statisticsRepository->CountPostDislike($userId, 'dislike'),
            $this->statisticsRepository->CountPhotoLike($userId, 'like'),
            $this->statisticsRepository->CountPhotoDislike($userId, 'dislike'));
    }
}