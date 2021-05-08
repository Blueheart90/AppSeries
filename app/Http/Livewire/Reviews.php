<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\TvList;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Reviews extends Component
{

    public $content;
    public $apiId;
    public $recommended = null;
    public $oldData;
    public $showForm = true;

    public function mount(){
        $this->oldData = Review::where('api_id', $this->apiId)->where('user_id', auth()->id())->first();
        if ($this->oldData) {
            $this->content = $this->oldData->content;
            $this->recommended = $this->oldData->recommended;
            $this->showForm = false;
        }
    }

    protected $rules = [
        'content' => 'required',
        'recommended' => 'required',
    ];

    public function submit()
    {
        // $this->validate(['content' => 'required']);
        // $this->content = "goodbye";
        // Log::debug($this->content);
        $this->validate();

        try {

            DB::transaction(function () {
                $query = auth()->user()->reviews()->create([
                    'content' => $this->content,
                    'api_id' => $this->apiId,
                    'recommended' => $this->recommended,
                ]);

                $list = TvList::where([
                        ['api_id', $this->apiId],
                        ['user_id', $query->user_id]
                    ])->firstOrFail();

                $list->update([
                        'review_id' => $query->id
                    ]);

            }, $deadlockRetries = 5);

            session()->flash('success', 'Reseña agregada exitosamente');

        } catch (ModelNotFoundException $th) {
            Log::debug($th->getMessage());
            Log::debug($th->getCode());
            Log::debug(get_class($th));
            session()->flash('error', 'Error, aun no tienes agregada estas serie a una lista');
        }



    }


    public function edit()
    {

    }

    public function update(Review $review)
    {
        Log::debug($review);
        try {
            $review->update([
                'content' => $this->content,
                'recommended' => $this->recommended
            ]);

            session()->flash('success', 'Reseña actualizada exitosamente');

        } catch (\Throwable $e) {

        }
    }

    public function render()
    {
        $allReviews = Review::where('api_id', $this->apiId)->with(['user', 'tvlist'])->get();
        return view('livewire.reviews', compact('allReviews'));
    }
}
