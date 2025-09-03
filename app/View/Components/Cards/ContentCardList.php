<?php

namespace App\View\Components\Cards;

use Closure;
use App\Models\Content;
use App\Models\ContentPreview;
use Illuminate\View\Component;
use App\Models\ContentCategory;
use Illuminate\Contracts\View\View;

class ContentCardList extends Component
{
    protected Content|ContentCategory|ContentPreview $content;
    protected ?bool $useDate;
    protected ?bool $useMeta;
    protected ?string $useSummary;
    public function __construct($content,$useDate = false, $useMeta = false, $useSummary = "")
    {
        $this->content = $content;
        $this->useDate = $useDate;
        $this->useMeta = $useMeta;
        $this->useSummary = $useSummary;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.content-card-list',[
            'content' => $this->content,
            'useDate' => $this->useDate,
            'useMeta' => $this->useMeta,
            'useSummary' => $this->useSummary,
        ]);
    }
}
