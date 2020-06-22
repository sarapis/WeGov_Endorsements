<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

use App\Logic\User\UserRepository;
use App\Models\Election;
use App\Models\Campaign;

class ElectionController extends Controller
{
    //
    public function index()
    {
        $elections = Election::all();
        
        return view('frontend.elections', compact('elections'));
    }

    public function find($id)
    {
        $election = Election::where('recordid', '=', $id)->first();

        $offices = Campaign::where('winner', '=', '1')->where('election', '=', $election->recordid)->groupBy('campaigns.office')->select('campaigns.*', DB::raw('sum(campaigns.of_endorsements) as sum_endorsements'), DB::raw('count(campaigns.id) as sum_candidates'))->get();

        return view('frontend.elections_detail', compact('election', 'offices'));
    }
}
