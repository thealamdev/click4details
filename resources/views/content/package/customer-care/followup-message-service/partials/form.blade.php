<form action="{{ route('admin.customer-care.followup-message-service.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="package">Service Package</label>
        <select name="package_id" id="package_id" class="form-control">
            <option disabled>--select a package--</option>
            @foreach ($packages as $each)
                <option value="{{ $each->id }}">{{ $each->name }} &#x27A4; {{ $each->stage }} &#x27A4; (
                    {{ $each->starting_day }} &#x27A4; {{ $each->visit_day }} )</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="send_day" class="form-label">Send Day</label>
        <select name="send_day" id="" class="form-control">
            @foreach ($daysOfWeek as $day)
                <option value="{{ $day }}">{{ $day }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="message_send_time">Message Send time</label>
        <input type="time" value="12:00" name="message_send_time" class="form-control">
    </div>

    <div class="mb-3">
        <label for="call_time">Set Call time</label>
        <input type="time" name="call_time" class="form-control">
    </div>

    <div class="mt-3">
        <label for="message">Message</label>
        <select name="message" class="form-control" id="messageOptions">
            <option disabled>--select a message--</option>
        </select>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>

</form>
