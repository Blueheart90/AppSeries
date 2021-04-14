<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\TvList;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Reviews extends Component
{

    public $content;
    public $apiId;
    public $recommended = null;


    protected $rules = [
        'content' => 'required',
        'recommended' => 'required',
    ];

    public function submit()
    {
        // $this->validate(['content' => 'required']);
        // $this->content = "goodbye";
        Log::debug($this->content);
        $this->validate();

        DB::transaction(function () {
            $query = auth()->user()->reviews()->create([
                'content' => $this->content,
                'api_id' => $this->apiId,
                'recommended' => $this->recommended,
            ]);

            $list = TvList::where([
                    ['api_id', $this->apiId],
                    ['user_id', $query->user_id]
                ]);
            $list->update([
                'review_id' => $query->id
            ]);

        }, $deadlockRetries = 5);
    }

    public function update(Review $review)
    {
        Log::debug($review);
    }

    public function render()
    {
        $allReviews = Review::where('api_id', $this->apiId)->with(['user', 'tvlist'])->get();
        return view('livewire.reviews', compact('allReviews'));
    }
}