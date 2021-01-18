@extends('layouts.app')

@section('content')
<a href="javascript:history.back()" class="btn btn-primary">Back</a>

<div class="container">
 @forelse($notifications as $notification)
 <li>
        @if($notification->notifiable_id == auth()->user()->id)
            We have received a payment of ${{ $notification->data['amount'] }} from you.
        @endif
</li>
@empty
    <li> You have no unread Notifications at this time </li>
@endforelse
</div>
@endsection