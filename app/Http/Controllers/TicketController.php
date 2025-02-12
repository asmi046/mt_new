<?php

namespace App\Http\Controllers;

use App\Models\PayOrder;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show_ticket(string $uuid) {
        $pay = PayOrder::with('clients')->where('uuid', $uuid)->firstOrFail();
        return view('ticket.show', ['pay' => $pay]);
    }
}
