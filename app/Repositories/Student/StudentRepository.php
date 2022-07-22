<?php

namespace App\Repositories\Student;

use App\Models\Subject;
use App\Repositories\BaseRepository;
use http\Env\Request;
use Illuminate\Support\Carbon;


class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    public function search($data)
    {
        $students = $this->model->with('subjects');
        $subjetcs = Subject::all()->count();


        if (!empty($data['min_age'])) {
            $min = Carbon::today()->subYears($data['min_age']);
            $students->where('birthdate', '<=', $min);
        }
        if (!empty($data['max_age'])) {
            $max = Carbon::today()->subYears($data['max_age']);
            $students->where('birthdate', '>=', $max);
        }

        if (!empty($data['min_point'])) {
            $students->whereHas('point', function ($query) use ($data) {
                $query->where('point', '>=', $data['min_point']);
            });
        }
        if (!empty($data['max_point'])) {
            $students->whereHas('point', function ($query) use ($data) {
                $query->where('point', '<=', $data['max_point']);
            });
        }
        $phonenumber = [
            'viettel' => '^(0?)(3[2-9]|8[6]|9[6|7|8])[0-9]{7}$',
            'mobifone' => '^(0?)(7[0|6-9]|8[9]|9[0|3])[0-9]{7}$',
            'vinaphone' => '^(0?)(8[1-5]|8|9[1|4])[0-9]{7}$',
        ];
        if (!empty($data['viettel']) || !empty($data['mobifone']) || !empty($data['vinaphone'])) {
            $students->where(function ($query) use ($data, $phonenumber) {
                foreach ($phonenumber as $field => $phone) {
                    if (!empty($data[$field])) {
                        $query->orWhere('phone', 'regexp', $phonenumber);
                    }
                }
            });
        }
        if (!empty($data['learn_status']) && $data['learn_status'] == 'finished') {
            $students->whereHas('subjects', function ($query) {
                $query->where('point', '>', 0);
            }, '=', $subjetcs);
        }
        if (!empty($data['learn_status']) && $data['learn_status'] == 'unfinished') {
            $students->has('subjects', '<', $subjetcs);
        }

        return $students->paginate(5);
    }

    public function badStudent()
    {
        $students = $this->model->with('subjects');
        $subjetcs = Subject::all()->count();
        $students->has('subjects', '<=', $subjetcs)->whereHas('point', function ($query) {
            $query->havingRaw('avg(point)<5');
        });
        return $students->paginate(5);
    }





}
