<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Emirate;
use Illuminate\Http\Request;


class CommunityController extends Controller
{
    public function index(Request $request)
    {
        $emirates = Emirate::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);
    
        $communities = Community::query()
            ->select([
                'id',
                'emirate_id',
                'name',
                'slug',
                'description',
                'display_order',
            ])
            ->with('emirate')
    
            ->withCount([
                'properties' => function ($query) {
                    $query->where('is_active', true);
                },
            ])
    
            ->where('is_active', true)
    
            ->when(
                $request->filled('emirate'),
                function ($query) use ($request) {
                    $query->where(
                        'emirate_id',
                        $request->integer('emirate')
                    );
                }
            )
    
            ->orderBy('display_order')
            ->get();
    
        return view('communities.index', compact(
            'communities',
            'emirates'
        ));
    }
}
