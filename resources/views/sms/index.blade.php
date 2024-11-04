@extends('layouts.app')

@section('content')
<div class="container">
    <h1>SMS Messaging</h1>
    
    <!-- Single SMS Form -->
    <div class="card mb-4">
        <div class="card-header">Send Single SMS</div>
        <div class="card-body">
            <form action="{{ route('sms.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send SMS</button>
            </form>
        </div>
    </div>

    <!-- Bulk SMS Form -->
    <div class="card mb-4">
        <div class="card-header">Send Bulk SMS</div>
        <div class="card-body">
            <form action="{{ route('sms.sendBulk') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="contacts">Select Contacts</label>
                    <select multiple class="form-control" id="contacts" name="contacts[]" required>
                        <!-- You'll populate this with your contacts -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="bulk_message">Message</label>
                    <textarea class="form-control" id="bulk_message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Bulk SMS</button>
            </form>
        </div>
    </div>

    <!-- SMS History -->
    <div class="card">
        <div class="card-header">SMS History</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>To</th>
                        <th>Message</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- You'll populate this with your SMS history -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
