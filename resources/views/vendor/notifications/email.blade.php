<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'ShopHub Notification' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            color: #2d3748;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 15px;
        }
        .order-details {
            background-color: #f7fafc;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        .order-details h3 {
            margin: 0 0 15px 0;
            color: #2d3748;
            font-size: 18px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .detail-label {
            font-weight: 600;
            color: #4a5568;
        }
        .detail-value {
            color: #2d3748;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
        }
        .footer {
            background-color: #f7fafc;
            padding: 20px;
            text-align: center;
            color: #718096;
            font-size: 14px;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-processing { background-color: #dbeafe; color: #1e40af; }
        .status-shipped { background-color: #e9d5ff; color: #7c3aed; }
        .status-delivered { background-color: #d1fae5; color: #065f46; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ShopHub</h1>
        </div>
        
        <div class="content">
            @if(isset($greeting))
                <div class="greeting">{{ $greeting }}</div>
            @endif
            
            @foreach($introLines as $line)
                <div class="message">{{ $line }}</div>
            @endforeach
            
            @if(isset($order))
                <div class="order-details">
                    <h3>Order Information</h3>
                    <div class="detail-row">
                        <span class="detail-label">Order Number:</span>
                        <span class="detail-value">{{ $order->order_number }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Order Date:</span>
                        <span class="detail-value">{{ $order->created_at->format('F d, Y \a\t g:i A') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Total Amount:</span>
                        <span class="detail-value">Rs. {{ number_format($order->total_amount) }}</span>
                    </div>
                    @if(isset($newStatus))
                        <div class="detail-row">
                            <span class="detail-label">Status:</span>
                            <span class="detail-value">
                                <span class="status-badge status-{{ $newStatus }}">{{ ucfirst($newStatus) }}</span>
                            </span>
                        </div>
                    @endif
                </div>
            @endif
            
            @if(isset($actionText))
                <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>
            @endif
            
            @foreach($outroLines as $line)
                <div class="message">{{ $line }}</div>
            @endforeach
        </div>
        
        <div class="footer">
            <p>Thank you for shopping with ShopHub!</p>
            <p>If you have any questions, please contact our customer support.</p>
        </div>
    </div>
</body>
</html> 