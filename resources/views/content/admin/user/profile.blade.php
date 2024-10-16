@extends('layouts.master')
@section('title', 'User Profile')
@section('css')
    <style>
        .profile .profile-header .profile-header-cover {
            background: url('https://images.pexels.com/photos/1629236/pexels-photo-1629236.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 10.625rem;
            position: relative;
        }
    </style>
@endsection
@section('content')
    <div class="profile">

        <div class="profile-header">
            <div class="profile-header-cover">
            </div>
            <div class="profile-header-content">
                <div class="profile-header-img">
                    <img src="https://images.pexels.com/photos/2156881/pexels-photo-2156881.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt>
                </div>
                <ul class="profile-header-tab nav nav-tabs nav-tabs-v2">
                    <li class="nav-item">
                        <a href="#todayTab" class="nav-link active" data-bs-toggle="tab">
                            <div class="nav-field">Jobs</div>
                            <div class="nav-value">{{ count($schedule) }}</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#incompleteTab" class="nav-link" data-bs-toggle="tab">
                            <div class="nav-field">Day Off</div>
                            <div class="nav-value">{{ count($incompletedJobs) }}</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#completeTab" class="nav-link" data-bs-toggle="tab">
                            <div class="nav-field">Completed Jobs</div>
                            <div class="nav-value">{{ count($completedJobs) }}</div>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#profile-video" class="nav-link" data-bs-toggle="tab">
                            <div class="nav-field">Videos</div>
                            <div class="nav-value">120</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-followers" class="nav-link" data-bs-toggle="tab">
                            <div class="nav-field">Following</div>
                            <div class="nav-value">2,592</div>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>


        <div class="profile-container">

            <div class="profile-content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tab-content p-0">

                            @include('content.admin.user.partials.profile.today')
                            @include('content.admin.user.partials.profile.incomplete')
                            @include('content.admin.user.partials.profile.complete')

                            {{--  <div class="tab-pane fade" id="profile-video">
                                <div class="card mb-3">
                                    <div class="card-header fw-bold bg-transparent">Collections #1</div>
                                    <div class="card-body">
                                        <div class="row gx-1">
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=RQ5ljyGg-ig" data-lity>
                                                    <img src="../../img.youtube.com/vi/RQ5ljyGg-ig/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=5lWkZ-JaEOc" data-lity>
                                                    <img src="../../img.youtube.com/vi/5lWkZ-JaEOc/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=9ZfN87gSjvI" data-lity>
                                                    <img src="../../img.youtube.com/vi/9ZfN87gSjvI/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=w2H07DRv2_M" data-lity>
                                                    <img src="../../img.youtube.com/vi/w2H07DRv2_M/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=PntG8KEVjR8" data-lity>
                                                    <img src="../../img.youtube.com/vi/PntG8KEVjR8/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=q8kxKvSQ7MI" data-lity>
                                                    <img src="../../img.youtube.com/vi/q8kxKvSQ7MI/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=cutu3Bw4ep4" data-lity>
                                                    <img src="../../img.youtube.com/vi/cutu3Bw4ep4/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=gCspUXGrraM" data-lity>
                                                    <img src="../../img.youtube.com/vi/gCspUXGrraM/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header fw-bold bg-transparent">Collections #2</div>
                                    <div class="card-body">
                                        <div class="row gx-1">
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=COtpTM1MpAA" data-lity>
                                                    <img src="../../img.youtube.com/vi/COtpTM1MpAA/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=8NVkGHVOazc" data-lity>
                                                    <img src="../../img.youtube.com/vi/8NVkGHVOazc/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=QgQ7MWLsw1w" data-lity>
                                                    <img src="../../img.youtube.com/vi/QgQ7MWLsw1w/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=Dmw0ucCv8aQ" data-lity>
                                                    <img src="../../img.youtube.com/vi/Dmw0ucCv8aQ/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=r1d7ST2TG2U" data-lity>
                                                    <img src="../../img.youtube.com/vi/r1d7ST2TG2U/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=WUR-XWBcHvs" data-lity>
                                                    <img src="../../img.youtube.com/vi/WUR-XWBcHvs/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=A7sQ8RWj0Cw" data-lity>
                                                    <img src="../../img.youtube.com/vi/A7sQ8RWj0Cw/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 mb-1">
                                                <a href="https://www.youtube.com/watch?v=IMN2VfiXls4" data-lity>
                                                    <img src="../../img.youtube.com/vi/IMN2VfiXls4/mqdefault.jpg" alt
                                                        class="d-block w-100">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    {{-- <div class="col-xl-4">
                        <div class="desktop-sticky-top d-none d-lg-block">
                            <div class="card mb-3">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item fw-500 px-3 d-flex">
                                        <span class="flex-fill">Trends for you</span>
                                        <a href="#" class="text-muted"><i class="fa fa-cog"></i></a>
                                    </div>
                                    <div class="list-group-item px-3">
                                        <div class="text-muted"><small><strong>Trending
                                                    Worldwide</strong></small></div>
                                        <div class="fw-500 mb-2">#BreakingNews</div>
                                        <a href="#"
                                            class="card overflow-hidden mb-1 text-body text-decoration-none">
                                            <div class="row no-gutters">
                                                <div class="col-md-8">
                                                    <div class="card-body p-1 px-2">
                                                        <div class="fs-12px text-muted">Space</div>
                                                        <div class="h-40px fs-13px overflow-hidden">Distant star
                                                            explosion is brightest ever seen, study finds</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex">
                                                    <div class="h-100 w-100"
                                                        style="background: url(assets/img/gallery/news-1.jpg) center; background-size: cover;">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div><small class="text-muted">1.89m share</small></div>
                                    </div>
                                    <div class="list-group-item px-3">
                                        <div class="fw-500 mb-2">#TrollingForGood</div>
                                        <div class="fs-13px">Be a good Troll and spread some positivity on
                                            Studio today.</div>
                                        <div><small class="text-muted"><i class="fa fa-external-link-square-alt"></i>
                                                Promoted by
                                                Studio Trolls</small></div>
                                    </div>
                                    <div class="list-group-item px-3">
                                        <div class="text-muted"><small><strong>Trending
                                                    Worldwide</strong></small></div>
                                        <div class="fw-500 mb-2">#CronaOutbreak</div>
                                        <div class="fs-13px">The coronavirus is affecting 210 countries around
                                            the world and 2 ...</div>
                                        <div><small class="text-muted">49.3m share</small></div>
                                    </div>
                                    <div class="list-group-item px-3">
                                        <div class="text-muted"><small><strong>Trending in New
                                                    York</strong></small></div>
                                        <div class="fw-500 mb-2">#CoronavirusPandemic</div>
                                        <a href="#"
                                            class="card overflow-hidden mb-1 text-body text-decoration-none">
                                            <div class="row no-gutters">
                                                <div class="col-md-8">
                                                    <div class="card-body p-1 px-2">
                                                        <div class="fs-12px text-muted">Coronavirus</div>
                                                        <div class="h-40px fs-13px overflow-hidden">Coronavirus:
                                                            US suspends travel from Europe</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex">
                                                    <div class="h-100 w-100"
                                                        style="background: url(assets/img/gallery/news-2.jpg) center; background-size: cover;">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div><small class="text-muted">821k share</small></div>
                                    </div>
                                    <a href="#" class="list-group-item list-group-action text-center">
                                        Show more
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#bootModalShow', function(e) {
                e.preventDefault();
                let dialog = '';
                let modalUrl = $(this).attr('href');
                let formUrl = $(this).attr('formActionUrl');
                alert(formUrl)
                $.ajax({
                    type: "GET",
                    url: modalUrl,
                    success: function(response) {
                        dialog = bootbox.dialog({
                            title: 'A custom dialog with buttons and callbacks',
                            message: "<div class='modalContent'></div>",
                            size: 'large',

                        });
                        $('.modalContent').html(response);
                    }
                });

                $(document).on('submit', '#createOrUpdateModal', function(e) {
                    e.preventDefault();
                    let formData = new FormData($('#createOrUpdateModal')[0]);
                    $.ajax({
                        type: "POST",
                        url: formUrl,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('.reloadBody').load(location.href + ' .reloadBody');
                            dialog.modal('hide')
                        }
                    });
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#detailModalShow', function(e) {
                e.preventDefault();
                let dialog = '';
                let modalUrl = $(this).attr('href');
                let customerId = $(this).attr('formActionUrl');

                $.ajax({
                    type: "GET",
                    url: modalUrl,
                    success: function(response) {
                        dialog = bootbox.dialog({
                            title: 'Customer Follow up Details',
                            message: "<div class='modalContent'></div>",
                            size: 'large',

                        });
                        $('.modalContent').html(response);
                    }
                });


            });

        });
    </script>

    <script>
        function deleteItem(element, deleteItemClass) {
            if (confirm('Are you sure to delete this???')) {
                let actionUrl = $(element).attr('deleteAction');

                let removeItemClass = 'removeItem' + deleteItemClass;

                $.ajax({
                    type: "GET",
                    url: actionUrl,
                    success: function(response) {
                        $('.' + removeItemClass).remove();
                    }
                });
            }
        }
    </script>
@endpush
