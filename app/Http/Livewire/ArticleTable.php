<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use Log;

class ArticleTable extends Component
{
    // List that accumulates  data overtime
    public $dataRows;
    
    // This is total data rows for reference, 
    /// Also used to stop polling once reached
    public $totalRows;

    // Used for querying data to retrieve
    public $pagination;
    public $lastNsId;
    public $filters;

    // Override this to initialize our table 
    public function mount()
    {
        // Let's use this for search, filter, and sort logic  
        $this->filters    = [];
        $this->pagination = 10;
        $this->initializeData();
    }

    // When filters is updated, re-initialize data
    public function updatedFiltersSearch()
    {
        $this->initializeData();
    }

    /**
     * Gets the base query
     */
    public function getBaseQuery()
    {
        // Let's quickly refresh the totalRows every time we check with the db
        $this->totalRows = Article::filterQuery($this->filters)->count();

        // Most importantly, please return none-Sub rows to avoid duplicates in our $dataRows list
        return Article::filterQuery($this->filters)->whereNull('lead_article_id');
    }

    /**
     * Initially let's get double the first page data 
     * to have a smooth next page feel 
     * while we wait for the first poll result
     */
    public function initializeData()
    {
        $noneSubList = $this->getBaseQuery()
        ->limit($this->pagination*2)
        ->get();

        $this->addListToData( $noneSubList, true );
    }

    /**
     * For every next page, 
     * we'll get data after our last reference
     */
    public function nextPageData()
    {
        $noneSubList = $this->getBaseQuery()
        ->where('id','>',$this->lastNsId)
        ->limit($this->pagination*10)
        ->get();
       
        $this->addListToData( $noneSubList );
    }

    

    /**
     * 1. Merges none-Sub List data with Sub rows.
     * 2. Adds the merged row in proper order into the 
     * $dataRows attribute we'll pass to the client using dispatchBrowserEvent
     * 3. Updates the $lastNsId reference 
     */
    public function addListToData($noneSubList, $resetClientList=false)
    {
        $this->dataRows = array();
        $subList = $this->getSubRows($noneSubList);
        foreach( $noneSubList as $item ){
            $this->dataRows[] = $item;
            $this->lastNsId    = $item->id;
            foreach( $subList as $subItem){
                if( $subItem->lead_article_id == $item->id ){
                    $this->dataRows[] = $subItem;
                }
            }
        }

        $this->dispatchBrowserEvent('data-updated', ['newData' => $this->dataRows, 'reset'=>$resetClientList]); 
    }

    /**
     * Get the Sub rows for the given none-Sub data
     */
    private function getSubRows($noneSubList)
    {
        $idList = [];
        foreach($noneSubList as $item){
            $idList[] = $item->id;
        }

        return Article::filterQuery($this->filters)
        ->whereIn('lead_article_id', $idList)
        ->get();
    }

    public function render()
    {
        return view('livewire.article-table');
    }

}
