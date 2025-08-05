<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500'
        ]);

        // Check if user already reviewed this product
        $existingReview = Review::where('user_id', auth()->id())
                               ->where('product_id', $request->product_id)
                               ->first();

        if ($existingReview) {
            $existingReview->update([
                'rating' => $request->rating,
                'comment' => $request->comment
            ]);
            $message = 'Review updated successfully!';
        } else {
            Review::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_approved' => true // Auto-approve for now
            ]);
            $message = 'Review submitted successfully!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function destroy($id)
    {
        $review = Review::where('user_id', auth()->id())->findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }
}
