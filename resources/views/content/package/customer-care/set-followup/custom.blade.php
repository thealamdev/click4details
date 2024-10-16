<div class="card">
    <div class="card-body">
        <form
            action="{{ route('admin.vehicle.customer.followup-message.addFollowupStore', ['customer' => $customer->id, 'customerFollowupMessage' => $customerFollowupMessage?->id]) }}"
            method="POST">
            @csrf

            <div class="mb-3" id="messageMain">
                <label for="message">Package Message Service</label>
                <select name="message" class="form-control">
                    <option disabled>--select a PMS--</option>
                    @foreach ($followup_message as $each)
                        <option value="{{ $each->message }}">
                            {{ $each->message }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-sm btn-primary mb-2" type="button" id="customMessage"><i
                    class="fa-solid fa-plus"></i>
            </button>

            <div class="mb-3" id="messageId" style="display: none">
                <label for="package">Custom message(if needed)</label>
                <textarea name="messageCustom" id="messageCustom" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <div class="mb-3">
                <label for="send_date">Message Send Date</label>
                <input type="date" name="send_date" class="form-control">
            </div>

            <div class="mb-3">
                <label for="call_time">Call time</label>
                <input type="time" name="call_time" class="form-control">
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>

        </form>
    </div>
</div>
</div>

<script>
    let customMessage = document.querySelector('#customMessage'),
        messageId = document.querySelector('#messageId'),
        messageMain = document.querySelector('#messageMain'),
        messageCustom = document.querySelector('#messageCustom')

    customMessage.addEventListener('click', () => {
        if (messageId.style.display === 'none' || messageId.style.display === '') {
            messageId.style.display = 'block';
            customMessage.innerHTML = '<i class="fa-solid fa-xmark"></i>';
            messageMain.style.display = 'none';
        } else {
            messageId.style.display = 'none';
            messageMain.style.display = 'block';
            customMessage.innerHTML = '<i class="fa-solid fa-plus"></i>';
            messageCustom.value = '';
        }
    });
</script>
