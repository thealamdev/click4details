<div>
    <h4 class="mb-0">FollowUp Message List</h4>
    <p class="mb-0">Manage all the followUp message</p>
</div>
<div class="dropdown me-1">
    <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
        aria-expanded="false" data-bs-offset="0,10">
        Quick Navigation
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
        <li>
            <a class="dropdown-item d-flex align-items-center justify-content-between"
                href="{{ route('admin.customer-care.followup-message.create') }}">
                Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
            </a>
            <a class="dropdown-item d-flex align-items-center justify-content-between"
                href="{{ route('admin.customer-care.followup-message.index') }}">
                Get All Record<i class="fa-solid fa-database text-body text-opacity-50"></i>
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

    </ul>
</div>