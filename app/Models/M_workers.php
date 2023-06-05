<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_workers extends Model
{
    use HasFactory;

    public function getWorkersAll()
    {
        $workers = DB::table('users')
            ->select('dni', 'name', 'surname', 'phone', 'rol', 'company','activo')
            ->get();
        return $workers;
    }
    public function getWorkersAllByClient($clientCompanyID)
    {
        $workers = DB::table('users')
            ->select('dni', 'name', 'surname', 'phone', 'rol','activo')
            ->where('company', $clientCompanyID)
            ->get();
        return $workers;
    }
    public function getWorkerSimple($workerID)
    {
        $workers = DB::table('users')
            ->select('*')
            ->where('dni', $workerID)
            ->get();
        return $workers;
    }
    public function getWorkerSimpleByClient($clientID, $workerID)
    {
    }
    public function deleteWorker($dni)
    {
        $affected = DB::table('users')
            ->where('dni', $dni)
            ->update(['activo' => 1]);

        return $affected > 0;
    }
    public function updateWorker($data)
    {
        $affected=DB::table('users')
        ->where('dni', $data['dni_old'])
        ->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'sex' => $data['sex'],
            'phone' => $data['phone'],
            'identification' => $data['dni_type'],
            'dni' => $data['dni'],
            'country' => $data['country'],
            'email' => $data['email'],
            'rol' => $data['rol'],
        ]);
        return $affected > 0;
    }
}
