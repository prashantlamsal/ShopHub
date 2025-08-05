<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderPlaced extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Order Confirmation - #{$this->order->order_number}")
            ->greeting("Thank you for your order, {$notifiable->name}!")
            ->line("Your order has been successfully placed and is being processed.")
            ->line("Order Number: {$this->order->order_number}")
            ->line("Order Date: " . $this->order->created_at->format('F d, Y \a\t g:i A'))
            ->line("Total Amount: Rs. " . number_format($this->order->total_amount))
            ->line("Shipping Address: {$this->order->shipping_address}")
            ->action('View Order Details', url('/orders/' . $this->order->id))
            ->line('We will keep you updated on your order status via email.')
            ->line('Thank you for shopping with ShopHub!')
            ->with([
                'order' => $this->order,
                'newStatus' => 'pending'
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'total_amount' => $this->order->total_amount,
            'message' => "Order #{$this->order->order_number} has been placed successfully"
        ];
    }
}
