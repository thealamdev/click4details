<div>
    <h4 class="mb-0">Requirement List</h4>
    <p class="mb-0">Manage all the requirement list</p>
</div>

<div class="dropdown me-1">
    <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown"
        aria-expanded="false" data-bs-offset="0,10">
        Quick Navigation
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuOffset">
        <li>
            <a class="dropdown-item d-flex align-items-center justify-content-between"
                href="{{ route('admin.vehicle.product.create') }}">
                Create Record<i class="fa-solid fa-plus text-body text-opacity-50"></i>
            </a>
            <a class="dropdown-item d-flex align-items-center justify-content-between"
                href="{{ route('admin.vehicle.product.index') }}">
                Get All Record<i class="fa-solid fa-database text-body text-opacity-50"></i>
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:;">
                Export Excel<i class="fa-solid fa-file-lines text-body text-opacity-50"></i>
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:;">
                Stream PDF<i class="fa-solid fa-bolt text-body text-opacity-50"></i>
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:;">
                Download PDF<i class="fa-solid fa-shield-halved text-body text-opacity-50"></i>
            </a>
        </li>
    </ul>
</div>
