@extends('dashboard_patient.layouts.layout')
@include('dashboard_patient.layouts.header')


<div class="container-fluid">
    <div class="row">
        @include('dashboard_patient.layouts.sidebar')
              <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
                <div class="row">
                    <div class="col-8">
                        <div class="grid-3 mb-5">
                            <div class="card border-0 rounded-3">
                                <div class="card-body ">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.49999 8.33334C9.34094 8.33334 10.8333 6.84095 10.8333 5C10.8333 3.15906 9.34094 1.66667 7.49999 1.66667C5.65904 1.66667 4.16666 3.15906 4.16666 5C4.16666 6.84095 5.65904 8.33334 7.49999 8.33334Z"
                                                stroke="#2F70F2" stroke-width="1.5" />
                                            <path
                                                d="M12.5 7.5C13.163 7.5 13.7989 7.23661 14.2678 6.76777C14.7366 6.29893 15 5.66304 15 5C15 4.33696 14.7366 3.70107 14.2678 3.23223C13.7989 2.76339 13.163 2.5 12.5 2.5"
                                                stroke="#2F70F2" stroke-width="1.5" stroke-linecap="round" />
                                            <path
                                                d="M7.49999 17.5C10.7217 17.5 13.3333 16.0076 13.3333 14.1667C13.3333 12.3257 10.7217 10.8333 7.49999 10.8333C4.27833 10.8333 1.66666 12.3257 1.66666 14.1667C1.66666 16.0076 4.27833 17.5 7.49999 17.5Z"
                                                stroke="#2F70F2" stroke-width="1.5" />
                                            <path
                                                d="M15 11.6667C16.4617 11.9875 17.5 12.7992 17.5 13.75C17.5 14.6083 16.655 15.3525 15.4167 15.725"
                                                stroke="#2F70F2" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                        <span class="fw-semibold" style="color:#2F70F2">Active Users</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fs-4 text-dark fw-semibold">14,7K</span>
                                        <div class="text-success-light">
                                            <i class="bi bi-caret-up-fill"></i>
                                            <span class="">20%</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 rounded-3">
                                <div class="card-body ">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.50002 8.33334C9.34097 8.33334 10.8334 6.84095 10.8334 5C10.8334 3.15906 9.34097 1.66667 7.50002 1.66667C5.65907 1.66667 4.16669 3.15906 4.16669 5C4.16669 6.84095 5.65907 8.33334 7.50002 8.33334Z"
                                                stroke="#FFBC02" stroke-width="1.5" />
                                            <path
                                                d="M12.5 7.5C13.163 7.5 13.7989 7.23661 14.2678 6.76777C14.7366 6.29893 15 5.66304 15 5C15 4.33696 14.7366 3.70107 14.2678 3.23223C13.7989 2.76339 13.163 2.5 12.5 2.5"
                                                stroke="#FFBC02" stroke-width="1.5" stroke-linecap="round" />
                                            <path
                                                d="M7.50002 17.5C10.7217 17.5 13.3334 16.0076 13.3334 14.1667C13.3334 12.3257 10.7217 10.8333 7.50002 10.8333C4.27836 10.8333 1.66669 12.3257 1.66669 14.1667C1.66669 16.0076 4.27836 17.5 7.50002 17.5Z"
                                                stroke="#FFBC02" stroke-width="1.5" />
                                            <path
                                                d="M15 11.6667C16.4617 11.9875 17.5 12.7992 17.5 13.75C17.5 14.6083 16.655 15.3525 15.4167 15.725"
                                                stroke="#FFBC02" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>

                                        <span class="fw-semibold" style="color:#FFBC02">New Sign-ups</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fs-4 text-dark fw-semibold">341</span>
                                        <div class="text-success-light">
                                            <i class="bi bi-caret-up-fill"></i>
                                            <span class="">20%</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 rounded-3">
                                <div class="card-body ">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18.3334 7.16666C18.325 4.57166 18.2434 3.19583 17.3567 2.30999C16.3809 1.33333 14.8092 1.33333 11.6667 1.33333H8.33335C5.19085 1.33333 3.61919 1.33333 2.64335 2.30999C1.66669 3.28583 1.66669 4.85749 1.66669 7.99999C1.66669 11.1425 1.66669 12.7142 2.64335 13.69C3.61919 14.6667 5.19085 14.6667 8.33335 14.6667H9.58335"
                                                stroke="#876AFE" stroke-width="1.5" stroke-linecap="round" />
                                            <path
                                                d="M12.9167 9.66666V14.6667M12.9167 14.6667L14.5833 13M12.9167 14.6667L11.25 13M16.6667 14.6667V9.66666M16.6667 9.66666L18.3333 11.3333M16.6667 9.66666L15 11.3333"
                                                stroke="#876AFE" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M8.33335 11.3333H5.00002M1.66669 6.33333H18.3334" stroke="#876AFE"
                                                stroke-width="1.5" stroke-linecap="round" />
                                        </svg>


                                        <span class="fw-semibold" style="color:#876AFE">Transactions</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fs-4 text-dark fw-semibold">$1,021,11</span>
                                        <div class="text-danger">
                                            <i class="bi bi-caret-down-fill"></i>
                                            <span class="">20%</span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card border-0 mb-5">
                            <div class="card-header bg-white p-4">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.99999 18.3333C14.6024 18.3333 18.3333 14.6024 18.3333 9.99999C18.3333 5.39762 14.6024 1.66666 9.99999 1.66666C5.39762 1.66666 1.66666 5.39762 1.66666 9.99999C1.66666 14.6024 5.39762 18.3333 9.99999 18.3333Z"
                                        stroke="#121212" stroke-width="1.5" />
                                    <path
                                        d="M14.1666 8.33331H5.83331L8.69831 5.83331M5.83331 11.6666H14.1666L11.3016 14.1666"
                                        stroke="#121212" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span class="fw-semibold">Messages & Alerts</span>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column gap-3 px-3 py-2">
                                    <div class="d-flex gap-3 border-bottom pb-1">
                                        <svg width="42" height="33" viewBox="0 0 42 33" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1 22.5C5.23946 22.1576 7.45498 19.8366 8.30374 18.2345C8.4895 17.8839 8.21436 17.5 7.81756 17.5C4.57832 17.5 1.95239 14.8741 1.95239 11.6348V9.25C1.95239 4.69365 5.64604 1 10.2024 1H16.9645C22.3493 1 26.7145 5.36522 26.7145 10.75C26.7145 16.1348 22.3493 20.5 16.9645 20.5H11.0001C7.19054 22.9 2.74605 22.8333 1 22.5Z"
                                                stroke="#5C9F9B" stroke-width="2" />
                                            <path
                                                d="M41 31C36.7605 30.6576 34.545 28.3366 33.6963 26.7345C33.5105 26.3839 33.7856 26 34.1824 26C37.4217 26 40.0476 23.3741 40.0476 20.1348V17.75C40.0476 13.1937 36.354 9.5 31.7976 9.5H25.0355C19.6507 9.5 15.2855 13.8652 15.2855 19.25C15.2855 24.6348 19.6507 29 25.0355 29H30.9999C34.8095 31.4 39.254 31.3333 41 31Z"
                                                stroke="#5C9F9B" stroke-width="2" />
                                        </svg>
                                        <span>You have 28 appointment requests. Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Aenean commodo feugiat sodales.</span>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <svg width="42" height="33" viewBox="0 0 42 33" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1 22.5C5.23946 22.1576 7.45498 19.8366 8.30374 18.2345C8.4895 17.8839 8.21436 17.5 7.81756 17.5C4.57832 17.5 1.95239 14.8741 1.95239 11.6348V9.25C1.95239 4.69365 5.64604 1 10.2024 1H16.9645C22.3493 1 26.7145 5.36522 26.7145 10.75C26.7145 16.1348 22.3493 20.5 16.9645 20.5H11.0001C7.19054 22.9 2.74605 22.8333 1 22.5Z"
                                                stroke="#5C9F9B" stroke-width="2" />
                                            <path
                                                d="M41 31C36.7605 30.6576 34.545 28.3366 33.6963 26.7345C33.5105 26.3839 33.7856 26 34.1824 26C37.4217 26 40.0476 23.3741 40.0476 20.1348V17.75C40.0476 13.1937 36.354 9.5 31.7976 9.5H25.0355C19.6507 9.5 15.2855 13.8652 15.2855 19.25C15.2855 24.6348 19.6507 29 25.0355 29H30.9999C34.8095 31.4 39.254 31.3333 41 31Z"
                                                stroke="#5C9F9B" stroke-width="2" />
                                        </svg>
                                        <span>You have 28 appointment requests. Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Aenean commodo feugiat sodales.</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="col px-4">
                        <div class="card border-0">
                            <div class="card-header bg-white p-4">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.99999 18.3333C14.6024 18.3333 18.3333 14.6024 18.3333 9.99999C18.3333 5.39762 14.6024 1.66666 9.99999 1.66666C5.39762 1.66666 1.66666 5.39762 1.66666 9.99999C1.66666 14.6024 5.39762 18.3333 9.99999 18.3333Z"
                                        stroke="#121212" stroke-width="1.5" />
                                    <path
                                        d="M14.1666 8.33331H5.83331L8.69831 5.83331M5.83331 11.6666H14.1666L11.3016 14.1666"
                                        stroke="#121212" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span class="fw-semibold">Pending Approvals</span>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column gap-3 px-3 py-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/images/doctor.png') }}" alt="" width="35px" height="35px"
                                                class="border rounded-circle">
                                            <div class="d-flex flex-column gap-1">
                                                <span>George Hill</span>
                                                <span class="timing">June 19 2025 at 16.42</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-purple text-white rounded-4 btn-sm">Approve</button>
                                            <button class="btn btn-danger rounded-4 btn-sm">Cancel</button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/images/doctor.png') }}" alt="" width="35px" height="35px"
                                                class="border rounded-circle">
                                            <div class="d-flex flex-column gap-1">
                                                <span>George Hill</span>
                                                <span class="timing">June 19 2025 at 16.42</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-purple text-white rounded-4 btn-sm">Approve</button>
                                            <button class="btn btn-danger rounded-4 btn-sm">Cancel</button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/images/doctor.png') }}" alt="" width="35px" height="35px"
                                                class="border rounded-circle">
                                            <div class="d-flex flex-column gap-1">
                                                <span>George Hill</span>
                                                <span class="timing">June 19 2025 at 16.42</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-purple text-white rounded-4 btn-sm">Approve</button>
                                            <button class="btn btn-danger rounded-4 btn-sm">Cancel</button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col pe-4">
                        <nav class="mb-4 mx-1">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-trans-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-trans" type="button" role="tab" aria-controls="nav-trans"
                                    aria-selected="true">All Transactions</button>
                                <button class="nav-link" id="nav-pendPayment-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-pendPayment" type="button" role="tab"
                                    aria-controls="nav-pendPayment" aria-selected="false">Pending Payments</button>
                            </div>
                        </nav>


                        <div class="card border-0 p-4 rounded-4">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-trans" role="tabpanel"
                                    aria-labelledby="nav-trans-tab">
                                    <table class="table table-borderless transaction-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Description</th>
                                                <th scope="col">Transaction ID</th>
                                                <th scope="col">Card</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Receipt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Payment from Andrew</td>
                                                <td>#12548796</td>
                                                <td>1234 ****</td>
                                                <td>28 Jan, 12.30 AM</td>
                                                <td>$2,500</td>
                                                <td><button class="btn btn-sm rounded-pill"
                                                        style="color: #123288;border: 1px solid #123288;">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment from Andrew</td>
                                                <td>#12548796</td>
                                                <td>1234 ****</td>
                                                <td>28 Jan, 12.30 AM</td>
                                                <td>$2,500</td>
                                                <td><button class="btn btn-sm rounded-pill"
                                                        style="color: #123288;border: 1px solid #123288;">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment from Andrew</td>
                                                <td>#12548796</td>
                                                <td>1234 ****</td>
                                                <td>28 Jan, 12.30 AM</td>
                                                <td>$2,500</td>
                                                <td><button class="btn btn-sm rounded-pill"
                                                        style="color: #123288;border: 1px solid #123288;">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment from Andrew</td>
                                                <td>#12548796</td>
                                                <td>1234 ****</td>
                                                <td>28 Jan, 12.30 AM</td>
                                                <td>$2,500</td>
                                                <td><button class="btn btn-sm rounded-pill"
                                                        style="color: #123288;border: 1px solid #123288;">Download</button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-pendPayment" role="tabpanel"
                                    aria-labelledby="nav-pendPayment-tab">
                                    <table class="table table-borderless transaction-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Description</th>
                                                <th scope="col">Transaction ID</th>
                                                <th scope="col">Card</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Receipt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Payment from Andrew</td>
                                                <td>#12548796</td>
                                                <td>1234 ****</td>
                                                <td>28 Jan, 12.30 AM</td>
                                                <td>$2,500</td>
                                                <td><button class="btn btn-sm rounded-pill"
                                                        style="color: #123288;border: 1px solid #123288;">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment from Andrew</td>
                                                <td>#12548796</td>
                                                <td>1234 ****</td>
                                                <td>28 Jan, 12.30 AM</td>
                                                <td>$2,500</td>
                                                <td><button class="btn btn-sm rounded-pill"
                                                        style="color: #123288;border: 1px solid #123288;">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment from Andrew</td>
                                                <td>#12548796</td>
                                                <td>1234 ****</td>
                                                <td>28 Jan, 12.30 AM</td>
                                                <td>$2,500</td>
                                                <td><button class="btn btn-sm rounded-pill"
                                                        style="color: #123288;border: 1px solid #123288;">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment from Andrew</td>
                                                <td>#12548796</td>
                                                <td>1234 ****</td>
                                                <td>28 Jan, 12.30 AM</td>
                                                <td>$2,500</td>
                                                <td><button class="btn btn-sm rounded-pill"
                                                        style="color: #123288;border: 1px solid #123288;">Download</button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </main>
    </div>
</div>
