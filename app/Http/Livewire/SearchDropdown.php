<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search = '';
    public function render()
    {
        $searchResult = [];

        if(strlen($this->search)>=2)
        {
            $searchResult = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/multi?query='.$this->search)
                ->json()['results'];
        }

        // dump($searchResult);

        return view('livewire.search-dropdown', [
            'searchResult' => collect($searchResult)->map(function($search){
                
    
                if(isset($search['title'])){
                    $title = $search['title'];
                }
                elseif(isset($search['name'])){
                    $title = $search['name'];
                }    
                else{
                    $title = 'Untitled';
                }

                if(isset($search['poster_path'])){
                    $poster_path = 'https://image.tmdb.org/t/p/w92/'.$search['poster_path'];
                }  
                else{
                    $poster_path = 'https://via.placeholder.com/50x75';
                }

                return collect($search)->merge([
                    'title' => $title,
                    'linkToPage' => $search['media_type'] === 'movie' ? route('movies.show',$search['id']) :route('tv.show', $search['id']),
                    'poster_path' => $poster_path,
                    
                ])->only([
                    'linkToPage', 'title', 'id', 'media_type', 'poster_path'
                ]);
            })->take(7),
        ]);
    }
}
