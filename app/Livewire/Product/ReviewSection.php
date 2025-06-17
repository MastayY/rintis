<?php

namespace App\Livewire\Product;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewHelpful;
use Illuminate\Support\Facades\Auth;

class ReviewSection extends Component
{
    public Product $product;
    public $rating = 0;
    public $body = '';
    public bool $openModal = false; // untuk Alpine bind
    public float $averageRating = 0;
    public function togglePopup()
    {
        $this->openModal = !$this->openModal;
    }

    public function mount(): void
    {
        $this->averageRating = $this->product->reviews()->avg('rating') ?? 0;
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'body' => 'required|string|min:10',
        ]);

        $this->product->reviews()->create([
            'user_id' => Auth::id(),
            'rating' => $this->rating,
            'body' => $this->body,
        ]);

        $this->reset(['rating', 'body']);
        $this->openModal = false; // tutup modal setelah submit
        $this->averageRating = $this->product->reviews()->avg('rating') ?? 0; // update rata-rata rating
        session()->flash('message', 'Berhasil menambahkan ulasan!');
    }

    public function markHelpful($reviewId)
    {
        $exists = ReviewHelpful::where('user_id', auth()->id())
            ->where('review_id', $reviewId)
            ->exists();

        if (!$exists) {
            ReviewHelpful::create([
                'user_id' => auth()->id(),
                'review_id' => $reviewId,
            ]);
        }
    }

    public function unmarkHelpful($reviewId)
    {
        ReviewHelpful::where('user_id', auth()->id())
            ->where('review_id', $reviewId)
            ->delete();
    }

    public function isHelpful($reviewId): bool
    {
        return ReviewHelpful::where('user_id', auth()->id())
            ->where('review_id', $reviewId)
            ->exists();
    }

    public function alreadyReviewed(): bool
    {
        return $this->product->reviews()->where('user_id', Auth::id())->exists();
    }

    public function deleteReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        if ($review->user_id === Auth::id()) {
            $review->delete();
            session()->flash('message', 'Ulasan berhasil dihapus.');
        } else {
            session()->flash('error', 'Anda tidak dapat menghapus ulasan orang lain.');
        }
    }

    // percentage of each star rating 1-5 to pass it in to progress bar like play store


    #[Layout('components.layouts.app')]
    public function render(): View
    {
        // reviews with counts of reviews count
        $reviews = Review::withCount(['helpfuls'])->with(['user', 'helpfuls'])->where('product_id', $this->product->id)->latest()->get();
        return view('livewire.product.review-section', compact('reviews'));
    }
}
