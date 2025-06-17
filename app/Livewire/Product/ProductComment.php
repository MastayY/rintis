<?php

namespace App\Livewire\Product;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ProductComment extends Component
{

    public Product $product;
    public $content = '';
    public $replyContent = [];
    public $replyingTo = null;

    public function addComment()
    {
        $this->validate(['content' => 'required|string']);
        $this->product->comments()->create([
            'user_id' => Auth::id(),
            'content' => $this->content,
            'parent_id' => null,
        ]);
        $this->content = '';
    }

    public function addReply($parentId)
    {
        $this->validate([
            "replyContent.$parentId" => 'required|string'
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $this->product->id,
            'parent_id' => $parentId,
            'content' => $this->replyContent[$parentId],
        ]);

        $this->replyContent[$parentId] = '';
    }

    #[Layout('components.layouts.app')]
    public function render(): View
    {
        $comments = $this->product->comments()->with(['user', 'replies'])->latest()->get();

        return view('livewire.product.product-comment', [
            'comments' => $comments,
        ]);
    }
}
