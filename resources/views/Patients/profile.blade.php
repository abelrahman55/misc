@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar - col-md-2 for medium screens and up, full width on smaller screens -->
            <aside class="col-md-2 d-flex flex-column p-2 bg-white">
                <ul class="nav-links flex-column nav position-relative ">
                    <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.66667 2H2V6.66667H6.66667V2Z" fill="#347FC2" fill-opacity="0.98"
                                        stroke="#347FC2" stroke-opacity="0.98" stroke-width="1.59942"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M14.0002 2H9.3335V6.66667H14.0002V2Z" stroke="#347FC2"
                                        stroke-opacity="0.98" stroke-width="1.59942" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M14.0002 9.33398H9.3335V14.0007H14.0002V9.33398Z" fill="#347FC2"
                                        fill-opacity="0.98" stroke="#347FC2" stroke-opacity="0.98"
                                        stroke-width="1.59942" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.66667 9.33398H2V14.0007H6.66667V9.33398Z" stroke="#347FC2"
                                        stroke-opacity="0.98" stroke-width="1.59942" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5 1.25C5.16576 1.25 5.32473 1.31585 5.44194 1.43306C5.55915 1.55027 5.625 1.70924 5.625 1.875V2.5H9.375V1.875C9.375 1.70924 9.44085 1.55027 9.55806 1.43306C9.67527 1.31585 9.83424 1.25 10 1.25C10.1658 1.25 10.3247 1.31585 10.4419 1.43306C10.5592 1.55027 10.625 1.70924 10.625 1.875V2.5H11.25C11.7473 2.5 12.2242 2.69754 12.5758 3.04917C12.9275 3.40081 13.125 3.87772 13.125 4.375V5H1.875V4.375C1.875 3.87772 2.07254 3.40081 2.42417 3.04917C2.77581 2.69754 3.25272 2.5 3.75 2.5H4.375V1.875C4.375 1.70924 4.44085 1.55027 4.55806 1.43306C4.67527 1.31585 4.83424 1.25 5 1.25ZM1.875 6.25V11.875C1.875 12.3723 2.07254 12.8492 2.42417 13.2008C2.77581 13.5525 3.25272 13.75 3.75 13.75H11.25C11.7473 13.75 12.2242 13.5525 12.5758 13.2008C12.9275 12.8492 13.125 12.3723 13.125 11.875V6.25H1.875Z"
                                        fill="#347FC2" fill-opacity="0.98" />
                                </svg>
                            </div>
                            Schedule
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Patients
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg>
                            </div>
                            Profile
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_681_14049)">
                                        <path
                                            d="M3.54669 15.0312H2.60919C2.42271 15.0312 2.24387 14.9572 2.11201 14.8253C1.98015 14.6934 1.90607 14.5146 1.90607 14.3281V10.1094C1.90607 9.92289 1.98015 9.74405 2.11201 9.61219C2.24387 9.48033 2.42271 9.40625 2.60919 9.40625H3.54669C3.73317 9.40625 3.91201 9.48033 4.04388 9.61219C4.17574 9.74405 4.24982 9.92289 4.24982 10.1094V14.3281C4.24982 14.5146 4.17574 14.6934 4.04388 14.8253C3.91201 14.9572 3.73317 15.0312 3.54669 15.0312V15.0312Z"
                                            fill="#347FC2" fill-opacity="0.98" />
                                        <path
                                            d="M10.1092 15.0312H9.17172C8.98524 15.0312 8.8064 14.9572 8.67454 14.8253C8.54268 14.6934 8.4686 14.5146 8.4686 14.3281V7.29687C8.4686 7.11039 8.54268 6.93155 8.67454 6.79969C8.8064 6.66783 8.98524 6.59375 9.17172 6.59375H10.1092C10.2957 6.59375 10.4745 6.66783 10.6064 6.79969C10.7383 6.93155 10.8123 7.11039 10.8123 7.29687V14.3281C10.8123 14.5146 10.7383 14.6934 10.6064 14.8253C10.4745 14.9572 10.2957 15.0312 10.1092 15.0312V15.0312Z"
                                            fill="#347FC2" fill-opacity="0.98" />
                                        <path
                                            d="M13.3904 15.0312H12.4529C12.2665 15.0312 12.0876 14.9572 11.9558 14.8253C11.8239 14.6934 11.7498 14.5146 11.7498 14.3281V4.01562C11.7498 3.82914 11.8239 3.6503 11.9558 3.51844C12.0876 3.38658 12.2665 3.3125 12.4529 3.3125H13.3904C13.5769 3.3125 13.7558 3.38658 13.8876 3.51844C14.0195 3.6503 14.0936 3.82914 14.0936 4.01562V14.3281C14.0936 14.5146 14.0195 14.6934 13.8876 14.8253C13.7558 14.9572 13.5769 15.0312 13.3904 15.0312V15.0312Z"
                                            fill="#347FC2" fill-opacity="0.98" />
                                        <path
                                            d="M6.82796 15.0312H5.89046C5.70398 15.0312 5.52513 14.9572 5.39327 14.8253C5.26141 14.6934 5.18733 14.5146 5.18733 14.3281V1.67187C5.18733 1.48539 5.26141 1.30655 5.39327 1.17469C5.52513 1.04283 5.70398 0.96875 5.89046 0.96875H6.82796C7.01444 0.96875 7.19328 1.04283 7.32514 1.17469C7.457 1.30655 7.53108 1.48539 7.53108 1.67187V14.3281C7.53108 14.5146 7.457 14.6934 7.32514 14.8253C7.19328 14.9572 7.01444 15.0312 6.82796 15.0312V15.0312Z"
                                            fill="#347FC2" fill-opacity="0.98" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_681_14049">
                                            <rect width="15" height="15" fill="white"
                                                transform="translate(0.499847 0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            Reviews & Rating
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main content - col-md-10 for medium screens and up, full width on smaller screens -->
            <main class="col-md-10 px-4 py-0">
                <div class="row h-100">
                    <div class="col-4 px-0 bg-white shadow-sm">
                        <div class="p-4">
                            <h2 class="header-page-1 mb-5">
                                <i class="bi bi-arrow-left-short"></i>
                                Patient Profile
                            </h2>

                            <div class="d-flex flex-column gap-1 align-items-center mb-3">
                                <img src="{{ asset($patient->prof_img) }}" alt="doctor" width="65" height="65"
                                    class="rounded-circle img-thumbnail">
                                <span class="heading-3 fw-bold text-dark">{{ $patient->f_name }} Hi</span>
                                <div class="d-flex gap-1 text-3 text-head">
                                    <span>{{ $patient->age }} years old</span>
                                    <span>|</span>
                                    <span><i class="bi bi-geo-alt"></i> {{isset($patient->country)? $patient->country->name:"" }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <!-- Navigation Tabs -->
                            <div class="nav flex-column nav-pills nav-profile w-100 px-1" id="v-pills-tab"
                                role="tablist" aria-orientation="vertical">
                                <button class="nav-link active text-start" id="v-pills-info-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-info" type="button" role="tab" aria-controls="v-pills-info"
                                    aria-selected="true">General Information</button>

                                <button class="nav-link text-start" id="v-pills-history-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-history" type="button" role="tab"
                                    aria-controls="v-pills-history" aria-selected="false">Medical History</button>

                                <button class="nav-link text-start" id="v-pills-notes-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-notes" type="button" role="tab"
                                    aria-controls="v-pills-notes" aria-selected="false">Consultation Notes</button>

                                <button class="nav-link text-start" id="v-pills-files-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-files" type="button" role="tab"
                                    aria-controls="v-pills-files" aria-selected="false">Files</button>
                            </div>
                        </div>
                    </div>

                    <div class="col p-4 h-100">
                        <!-- Tab Content -->
                        <div class="tab-content " id="v-pills-tabContent">
                            <!-- Tap Info -->
                            <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel"
                                aria-labelledby="v-pills-info-tab">

                                <div class="d-flex flex-column gap-3 overflow-auto" style="max-height: 85vh;">

                                    <div class="shadow-sm bg-white px-5 py-4 rounded">
                                        <h3 class="header-page mb-4">Demographics</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row">
                                                <span class="col text-2">Name</span>
                                                <span class="col text-2 text-dark">{{ $patient->f_name }}</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Gender</span>
                                                <span class="col text-2 text-dark">{{ $patient->gender }}</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Date Of Birth</span>
                                                <span class="col text-2 text-dark">{{ $patient->dob }}</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Age</span>
                                                <span class="col text-2 text-dark">{{ $patient->age }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shadow-sm bg-white px-5 py-4 rounded">
                                        <h3 class="header-page mb-4">Contact Information</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row">
                                                <span class="col text-2">Email</span>
                                                <span class="col text-2 text-dark">{{ $patient->email }}</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Phone</span>
                                                <span class="col text-2 text-dark">{{ $patient->phone }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shadow-sm bg-white px-5 py-4 rounded">
                                        <h3 class="header-page mb-4">Insurance</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row">
                                                <span class="col text-2">Member Id</span>
                                                <span class="col text-2 text-dark">{{$patient->id}}</span>
                                            </div>
                                            {{--  <div class="row">
                                                <span class="col text-2">Gender</span>
                                                <span class="col text-2 text-dark">Male</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Date Of Birth</span>
                                                <span class="col text-2 text-dark">May 7, 1980</span>
                                            </div>  --}}
                                            <div class="row">
                                                <span class="col text-2">Age</span>
                                                <span class="col text-2 text-dark">25</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shadow-sm bg-white px-5 py-4 rounded">
                                        <h3 class="header-page mb-4">Contact Information</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row">
                                                <span class="col text-2">Email</span>
                                                <span class="col text-2 text-dark">janedoe@@jmail.com</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Phone</span>
                                                <span class="col text-2 text-dark">000 000 000 000</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Address</span>
                                                <span class="col text-2 text-dark">Elm Street 123, Pensylvannia</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="shadow-sm bg-white px-5 py-4 rounded">
                                        <h3 class="header-page mb-4">Insurance</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row">
                                                <span class="col text-2">Member ID</span>
                                                <span class="col text-2 text-dark">123456789</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Policy Holder</span>
                                                <span class="col text-2 text-dark">Jane Doe</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Additional info</span>
                                                <span class="col text-2 text-dark">N/A</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="shadow-sm bg-white px-5 py-4 rounded">
                                        <h3 class="header-page mb-4">Insurance</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="row">
                                                <span class="col text-2">Member ID</span>
                                                <span class="col text-2 text-dark">123456789</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Policy Holder</span>
                                                <span class="col text-2 text-dark">Jane Doe</span>
                                            </div>
                                            <div class="row">
                                                <span class="col text-2">Additional info</span>
                                                <span class="col text-2 text-dark">N/A</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tap Medical History -->
                            <div class="tab-pane fade" id="v-pills-history" role="tabpanel"
                                aria-labelledby="v-pills-history-tab">
                                <div class="shadow-sm bg-white p-4 rounded">
                                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-summary-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-summary" type="button" role="tab"
                                            aria-controls="nav-summary" aria-selected="true">Summary</button>
                                        <button class="nav-link" id="nav-conditions-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-conditions" type="button" role="tab"
                                            aria-controls="nav-conditions" aria-selected="false">Conditions</button>
                                        <button class="nav-link" id="nav-notes-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-notes" type="button" role="tab"
                                            aria-controls="nav-notes" aria-selected="false">Notes</button>
                                    </div>

                                    <div class="tab-content p-2" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-summary" role="tabpanel"
                                            aria-labelledby="nav-summary-tab">
                                            James is a 32-year-old male with no known allergies or drug
                                            sensitivities. He has a history of seasonal allergies and occasional
                                            migraines. He takes no medications regularly.

                                        </div>
                                        <div class="tab-pane fade" id="nav-conditions" role="tabpanel"
                                            aria-labelledby="nav-conditions-tab">
                                            James is a 32-year-old male with no known allergies or drug
                                            sensitivities. He has a history of seasonal allergies and occasional
                                            migraines. He takes no medications regularly.
                                        </div>
                                        <div class="tab-pane fade" id="nav-notes" role="tabpanel"
                                            aria-labelledby="nav-notes-tab">
                                            James is a 32-year-old male with no known allergies or drug
                                            sensitivities. He has a history of seasonal allergies and occasional
                                            migraines. He takes no medications regularly.
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- Tap Consultation Notes -->
                            <div class="tab-pane fade" id="v-pills-notes" role="tabpanel"
                                aria-labelledby="v-pills-notes-tab">
                                <div class="shadow-sm bg-white p-4 rounded">
                                    <div class="d-flex flex-column gap-5 p-4">
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="box-icon-purple">
                                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_701_16191)">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M23.3103 8.87844L19.1216 4.68875C18.8402 4.40737 18.4587 4.24929 18.0608 4.24929C17.6629 4.24929 17.2813 4.40737 17 4.68875L5.43969 16.25C5.15711 16.5303 4.99873 16.9123 5 17.3103V21.5C5 22.3284 5.67157 23 6.5 23H10.6897C11.0877 23.0013 11.4697 22.8429 11.75 22.5603L23.3103 11C23.5917 10.7187 23.7498 10.3371 23.7498 9.93922C23.7498 9.54133 23.5917 9.15975 23.3103 8.87844ZM6.81031 17L14.75 9.06031L16.3147 10.625L8.375 18.5637L6.81031 17ZM6.5 18.8103L9.18969 21.5H6.5V18.8103ZM11 21.1897L9.43531 19.625L17.375 11.6853L18.9397 13.25L11 21.1897ZM20 12.1897L15.8103 8L18.0603 5.75L22.25 9.93875L20 12.1897Z"
                                                                fill="#F0F0F2" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_701_16191">
                                                                <rect width="24" height="24" fill="white"
                                                                    transform="translate(2 2)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col d-flex flex-column gap-1">
                                                <span class="text-4">Sep 2, 2023</span>
                                                <span class="text-2">Patient stated: I have been experiencing pain in my
                                                    wrists and
                                                    ankles. I am currently taking 2.5 mg of prednisone daily, 10 mg of
                                                    methotrexate weekly, and 1 mg of folic acid daily. I also take 10 mg
                                                    of leflunomide daily and 200 mg of hydroxychloroquine twice
                                                    daily.
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="box-icon-purple">
                                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_701_16191)">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M23.3103 8.87844L19.1216 4.68875C18.8402 4.40737 18.4587 4.24929 18.0608 4.24929C17.6629 4.24929 17.2813 4.40737 17 4.68875L5.43969 16.25C5.15711 16.5303 4.99873 16.9123 5 17.3103V21.5C5 22.3284 5.67157 23 6.5 23H10.6897C11.0877 23.0013 11.4697 22.8429 11.75 22.5603L23.3103 11C23.5917 10.7187 23.7498 10.3371 23.7498 9.93922C23.7498 9.54133 23.5917 9.15975 23.3103 8.87844ZM6.81031 17L14.75 9.06031L16.3147 10.625L8.375 18.5637L6.81031 17ZM6.5 18.8103L9.18969 21.5H6.5V18.8103ZM11 21.1897L9.43531 19.625L17.375 11.6853L18.9397 13.25L11 21.1897ZM20 12.1897L15.8103 8L18.0603 5.75L22.25 9.93875L20 12.1897Z"
                                                                fill="#F0F0F2" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_701_16191">
                                                                <rect width="24" height="24" fill="white"
                                                                    transform="translate(2 2)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col d-flex flex-column gap-1">
                                                <span class="text-4">Sep 2, 2023</span>
                                                <span class="text-2">Patient stated: I have been experiencing pain in my
                                                    wrists and
                                                    ankles. I am currently taking 2.5 mg of prednisone daily, 10 mg of
                                                    methotrexate weekly, and 1 mg of folic acid daily. I also take 10 mg
                                                    of leflunomide daily and 200 mg of hydroxychloroquine twice
                                                    daily.
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="box-icon-purple">
                                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_701_16191)">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M23.3103 8.87844L19.1216 4.68875C18.8402 4.40737 18.4587 4.24929 18.0608 4.24929C17.6629 4.24929 17.2813 4.40737 17 4.68875L5.43969 16.25C5.15711 16.5303 4.99873 16.9123 5 17.3103V21.5C5 22.3284 5.67157 23 6.5 23H10.6897C11.0877 23.0013 11.4697 22.8429 11.75 22.5603L23.3103 11C23.5917 10.7187 23.7498 10.3371 23.7498 9.93922C23.7498 9.54133 23.5917 9.15975 23.3103 8.87844ZM6.81031 17L14.75 9.06031L16.3147 10.625L8.375 18.5637L6.81031 17ZM6.5 18.8103L9.18969 21.5H6.5V18.8103ZM11 21.1897L9.43531 19.625L17.375 11.6853L18.9397 13.25L11 21.1897ZM20 12.1897L15.8103 8L18.0603 5.75L22.25 9.93875L20 12.1897Z"
                                                                fill="#F0F0F2" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_701_16191">
                                                                <rect width="24" height="24" fill="white"
                                                                    transform="translate(2 2)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col d-flex flex-column gap-1">
                                                <span class="text-4">Sep 2, 2023</span>
                                                <span class="text-2">Patient stated: I have been experiencing pain in my
                                                    wrists and
                                                    ankles. I am currently taking 2.5 mg of prednisone daily, 10 mg of
                                                    methotrexate weekly, and 1 mg of folic acid daily. I also take 10 mg
                                                    of leflunomide daily and 200 mg of hydroxychloroquine twice
                                                    daily.
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Upload -->
                                        <div class="d-flex justify-content-between align-items-center bg-light py-2 px-3 rounded-2">
                                            <div class="w-50">
                                                <input type="text" class="form-control border-0 bg-transparent"
                                                    placeholder="Add a note">
                                            </div>
                                            <div>
                                                <button class="btn bi bi-paperclip"></button>
                                                <button class="btn btn-purple text-white">Post</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-files" role="tabpanel"
                                aria-labelledby="v-pills-files-tab">Files Content</div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
