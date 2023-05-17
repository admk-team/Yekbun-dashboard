<div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="user-avatar-section">
                <div class=" d-flex align-items-center flex-column">
                    <img class="img-fluid rounded my-4" src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/10.png" height="110" width="110" alt="User avatar">
                    <div class="user-info text-center">
                        <h4 class="mb-2">{{ auth()->user()->name ?? '' }}</h4>
                                                        <span class="badge bg-label-secondary">
                                                            @php
                                                            $arr = request()->user()->roles; 
                                                            @endphp
                                                                <span>
                                                                    @foreach($arr  as $role)
                                                                    {{ $role->name ?? '' }}
                                                                    @endforeach
                                                                </span>
                                                            </span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                <div class="d-flex align-items-start me-4 mt-3 gap-3">
                    <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-check bx-sm"></i></span>
                    <div>
                        <h5 class="mb-0">1.23k</h5>
                        <span>Tasks Done</span>
                    </div>
                </div>
                <div class="d-flex align-items-start mt-3 gap-3">
                    <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-customize bx-sm"></i></span>
                    <div>
                        <h5 class="mb-0">568</h5>
                        <span>Projects Done</span>
                    </div>
                </div>
            </div>
            <h5 class="pb-2 border-bottom mb-4">Details</h5>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <span class="fw-bold me-2">Username:</span>
                        <span>{{ auth()->user()->username ?? '' }}</span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-bold me-2">Email:</span>
                        <span>{{ auth()->user()->email ?? '' }}</span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-bold me-2">Status:</span>
                        <span class="badge bg-label-success">Active</span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-bold me-2">Role:</span>
                        <span>
                            @php
                            $arr = request()->user()->roles; 
                            @endphp
                             @foreach($arr  as $role)
                             {{ $role->name ?? '' }}
                             @endforeach
                            

                                                            </span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-bold me-2">Contact:</span>
                        <span>{{ auth()->user()->number ?? '' }}</span>
                    </li>
                    
                    <li class="mb-3">
                        <span class="fw-bold me-2">Country:</span>
                        <span><{{ auth()->user()->country_id ?? '' }}/span>
                    </li>
                </ul>
                <div class="d-flex justify-content-center pt-3">
                    <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                    <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /User Card -->
    <!-- Plan Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <span class="badge bg-label-primary">Standard</span>
                <div class="d-flex justify-content-center">
                    <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                    <h1 class="display-5 mb-0 text-primary">99</h1>
                    <sub class="fs-6 pricing-duration mt-auto mb-3">/month</sub>
                </div>
            </div>
            <ul class="ps-3 g-2 my-4">
                <li class="mb-2">10 Users</li>
                <li class="mb-2">Up to 10 GB storage</li>
                <li>Basic Support</li>
            </ul>
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span>Days</span>
                <span>65% Completed</span>
            </div>
            <div class="progress mb-1" style="height: 8px;">
                <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span>4 days remaining</span>
            <div class="d-grid w-100 mt-4 pt-2">
                <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Upgrade Plan</button>
            </div>
        </div>
    </div>
    <!-- /Plan Card -->
</div>