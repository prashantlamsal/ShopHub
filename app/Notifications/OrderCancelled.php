<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderCancelled extends Notification
{
    use Queueable;

    public $order;
    public $reason;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, $reason = null)
    {
        $this->order = $order;
        $this->reason = $reason;
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
        $mailMessage = (new MailMessage)
            ->subject("Order Cancelled - #{$this->order->order_number}")
            ->greeting("Hello {$notifiable->name},")
            ->line("We regret to inform you that your order has been cancelled.")
            ->line("Order Number: {$this->order->order_number}")
            ->line("Order Date: " . $this->order->created_at->format('F d, Y \a\t g:i A'))
            ->line("Total Amount: Rs. " . number_format($this->order->total_amount));

        if ($this->reason) {
            $mailMessage->line("Cancellation Reason: {$this->reason}");
        }

        $mailMessage->line("If you have any questions about this cancellation, please contact our customer support.")
            ->action('Contact Support', url('/contact'))
            ->line('We apologize for any inconvenience caused.')
            ->with([
                'order' => $this->order,
                'newStatus' => 'cancelled'
            ]);

        return $mailMessage;
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
            'cancellation_reason' => $this->reason,
            'message' => "Order #{$this->order->order_number} has been cancelled"
        ];
    }
}
