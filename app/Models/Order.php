<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_ORDER = [
        'pending' => 'Chờ xác nhận',
        'confirmed' => 'Đã xác nhận',
        'preparing_goods' => 'Đang chuẩn bị hàng',
        'shipping' => 'Đang vận chuyển',
        'delivered' => 'Đã giao hàng',
        'canceled' => 'Đơn hàng đã bị hủy',
    ];

    const STATUS_PAYMENT = [
        'unpaid' => 'Chưa thanh toán',
        'paid' => 'Đã thanh toán',
    ];
    
    const STATUS_ORDER_PENDING = 'pending';
    const STATUS_ORDER_CONFIRMED = 'confirmed';
    const STATUS_ORDER_PREPARING_GOODS = 'preparing_goods';
    const STATUS_ORDER_SHIPPING = 'shipping';
    const STATUS_ORDER_DELIVERED = 'delivered';
    const STATUS_ORDER_CANCELED = 'canceled';

    const STATUS_PAYMENT_UNPAID = 'unpaid';
    const STATUS_PAYMENT_PAID = 'paid';

}
