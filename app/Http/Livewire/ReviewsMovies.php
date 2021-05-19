<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;
use App\Models\MovieList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewsMovies extends Component
{
    public $content;
    public $recommended = null;
    public $oldData;
    public $showForm = true;
    public $movie;

    public function mount(){
        $this->checkUser();
        $this->fillFields();

    }

    protected $rules = [
        'content' => 'required',
        'recommended' => 'required',
    ];

    public function checkUser()
    {
        // Se revisa si ya el usuario tiene agregada un review de la serie
        $this->oldData = Review::where('api_id', $this->movie['id'])->where('user_id', auth()->id())->first();

    }

    public function fillFields()
    {
        if ($this->oldData) {
            $this->content = $this->oldData->content;
            $this->recommended = $this->oldData->recommended;
            $this->showForm = false;
        }
    }

    public function submit()
    {
        $validado = $this->validate();

        try {

            DB::transaction(function () {
                $query = auth()->user()->reviews()->create([
                    'content' => $this->content,
                    'api_id' => $this->movie['id'],
                    'recommended' => $this->recommended,
                ]);

                $list = MovieList::where([
                        ['api_id', $this->movie['id']],
                        ['user_id', $query->user_id]
                    ])->firstOrFail();

                $list->update([
                        'review_id' => $query->id
                    ]);

            }, $deadlockRetries = 5);

            $this->checkUser();
            $this->showForm = false;
            session()->flash('success', 'Reseña agregada exitosamente');

        } catch (ModelNotFoundException $th) {
            Log::debug($th->getMessage());
            Log::debug($th->getCode());
            Log::debug(get_class($th));
            session()->flash('error', 'Error, primero debes agregar la pelicula a una lista');
        }
    }

    public function update(Review $review)
    {
        Log::debug($review);
        try {
            $review->update([
                'content' => $this->content,
                'recommended' => $this->recommended
            ]);
            $this->showForm = false;
            session()->flash('success', 'Reseña actualizada exitosamente');

        } catch (\Throwable $e) {
            session()->flash('error', 'No se pudo actualizar');
        }
    }

    public function render()
    {
        $allReviews = Review::where('api_id', $this->movie['id'])->with(['user', 'movielist'])->get();
        return view('livewire.reviews-movies', compact('allReviews'));
    }
}
