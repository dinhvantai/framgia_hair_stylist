<?php

namespace App\Eloquents\Relations;

use App\Eloquents\User;
use App\Eloquents\RenderBooking;
use App\Eloquents\OrderItem;
use App\Eloquents\Bill;
use App\Eloquents\Media;
use App\Eloquents\LogStatus;

trait OrderBookingRelations
{
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStylist()
    {
        return $this->belongsTo(User::class, 'stylist_id');
    }

    public function getBookingRender()
    {
        return $this->belongsTo(RenderBooking::class, 'render_booking_id');
    }

    public function BookingRender()
    {
        return $this->belongsTo(RenderBooking::class, 'render_booking_id');
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_booking_id');
    }

    public function getBill()
    {
        return $this->hasOne(Bill::class, 'order_booking_id');
    }
    
    public function Images()
    {
        return $this->morphMany(Media::class, 'media_table');
    }

    public function getLogStatus()
    {
        return $this->hasMany(LogStatus::class, 'order_booking_id');
    }
}
