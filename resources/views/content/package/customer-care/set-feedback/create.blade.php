 <form id="createOrUpdateModal"
     action="{{ route('admin.vehicle.followup.feedback-message.store', ['followup' => $followup->id]) }}" method="POST"
     accept-charset="utf-8" autocomplete="on" class="need-validation" novalidate>
     @csrf

     <div class="row gx-3">
         <div class="col-lg-12">
             <div class="row">
                 <div class="col-12 col-md-4">
                     <div class="form-group mb-3" id="messageMain">
                         <label class="form-label fw-500 mb-1" for="message">Feedback Message<span
                                 class="ms-1 text-red-600"></span>
                         </label>

                         <select name="message" class="form-control" value="{{ old('message') }}">
                             <option selected value="">--select option--</option>
                             @foreach ($feedback_messages as $message)
                                 <option value="{{ $message?->message }}">{{ $message?->message }}</option>
                             @endforeach
                         </select>
                     </div>

                     <div class="mb-3" id="messageId" style="display: none">
                         <label for="package" class="fw-500 mb-1">Custom message(if needed)</label>
                         <textarea name="customMessage" placeholder="enter custom message..." id="messageCustom" class="form-control" cols="30"
                             rows="1"></textarea>
                     </div>

                     <button class="btn btn-sm btn-primary mb-2" type="button" id="customMessage"><i
                             class="fa-solid fa-plus"></i>
                     </button>

                 </div>

                 <div class="col-12 col-md-4">
                     <div class="form-group mb-3">
                         <label class="form-label fw-500 mb-1" for="set_time">Set Date(if required)<span
                                 class="ms-1 text-red-600"></span></label>
                         <input type="datetime-local" name="set_time" class="form-control"
                             value="{{ old('set_time') }}">
                     </div>
                 </div>

                 <div class="col-12 col-md-4">
                     <div class="form-group mb-3">
                         <label class="form-label fw-500 mb-1" for="budget">Budget(if needed)<span
                                 class="ms-1 text-red-600"></span></label>
                         <input type="number" name="budget" class="form-control" value="{{ old('budget') }}"
                             placeholder="budget if needed">
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-lg-12">
             <div class="table_content">
                 <table class="table">
                     <thead>
                         <th>SL</th>
                         <th>Message</th>
                     </thead>

                     <tbody>
                         @if (is_object($custoer_fedbadcks) && count($custoer_fedbadcks) > 0)
                             @foreach ($custoer_fedbadcks as $each)
                                 <tr>
                                     <td>{{ $each?->id }}</td>
                                     <td>{{ $each?->message }}
                                         {{ !empty($each?->set_time) ? date('d M ,Y', strtotime($each?->set_time)) : '' }}
                                         {{ $each?->budget }}</td>
                             @endforeach
                         @else
                             <td colspan="2" class="text-center">
                                 <p>No data found.</p>
                             </td>
                             </tr>
                         @endif
                     </tbody>
                 </table>
             </div>

         </div>
     </div>

     <button class="btn btn-success">Submit</button>
 </form>


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
