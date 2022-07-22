<?php
namespace App\Repositories\Faculty;

use App\Repositories\BaseRepository;

class FacultyRepository extends BaseRepository implements FacultyRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Faculty::class;
    }
    

}
