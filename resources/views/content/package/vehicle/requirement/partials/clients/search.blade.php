<form action="{{ route('admin.vehicle.requirement.filterClient') }}" method="GET">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <input type="search" name="search" value="{{ request('search') }}"
                class="w-100 p-3 border border-slate-300 border-lg shadow-sm focus:border-sky-500 bg-transparent"
                style="border-radius: 30px;outline:none" placeholder="search ...">
        </div>
    </div>
</form>
