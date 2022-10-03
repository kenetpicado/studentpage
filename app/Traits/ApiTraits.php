<?php 

namespace App\Traits;

trait ApiTraits
{
    public function success()
    {
        return response()->json([
            'status' => '1',
            'message' => 'success',
        ], 200);
    }

    public function unauthorized()
    {
        return response()->json([
            'status' => '0',
            'message' => 'unauthorized',
        ], 403);
    }
}
