<?php
namespace App\Controllers\api;
use App\Models\Parameters;
use Illuminate\Database\Capsule\Manager as DB;

class ParametersApiController{
    public function store( $texts_id,  $parameters): bool {
        $success = true;
        DB::beginTransaction();
        foreach ($parameters as $parameter) {
            
            $result = Parameters::create([
                'texts_id' => $texts_id,
                'label' => $parameter->label,
                'key' => $parameter->key,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            if (!$result) {
                $success = false;
                break;
            }
        }
        if ($success) {
            DB::commit();
            return true;
        } else {
            DB::rollback();
            return false;
        }
    }
    public function update()
    {
       
        
    }
    public function delete()
    {
        
    }
    public function index()
    {
        
    }
}