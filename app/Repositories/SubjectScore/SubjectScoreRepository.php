<?php
namespace App\Repositories\SubjectScore;

use App\Repositories\BaseRepository;

class SubjectScoreRepository extends BaseRepository implements SubjectScoreRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\SubjectScore::class;
    }

}
