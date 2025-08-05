<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Order status constants
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_status',
        'shipping_address',
        'billing_address',
        'phone',
        'notes',
        'cancelled_at',
        'cancellation_reason'
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber()
    {
        return 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());
    }

    public function canBeCancelled()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function cancel($reason = null)
    {
        if (!$this->canBeCancelled()) {
            throw new \Exception('This order cannot be cancelled.');
        }

        $this->update([
            'status' => self::STATUS_CANCELLED,
            'cancelled_at' => now(),
            'cancellation_reason' => $reason
        ]);

        // Restore product stock
        foreach ($this->orderItems as $item) {
            $product = $item->product;
            if ($product) {
                $product->increment('stock', $item->quantity);
            }
        }
    }

    public function getStatusBadgeClass()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'bg-yellow-100 text-yellow-800',
            self::STATUS_PROCESSING => 'bg-blue-100 text-blue-800',
            self::STATUS_SHIPPED => 'bg-purple-100 text-purple-800',
            self::STATUS_DELIVERED => 'bg-green-100 text-green-800',
            self::STATUS_CANCELLED => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusIcon()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'fas fa-clock',
            self::STATUS_PROCESSING => 'fas fa-cog',
            self::STATUS_SHIPPED => 'fas fa-shipping-fast',
            self::STATUS_DELIVERED => 'fas fa-check-circle',
            self::STATUS_CANCELLED => 'fas fa-times-circle',
            default => 'fas fa-question-circle',
        };
    }
}
