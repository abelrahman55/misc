            <aside id="aside-sidebar" class="d-none d-lg-flex col-md-2 flex-column justify-content-between p-2 bg-white shadow-sm">
                <div class="d-flex justify-content-between align-items-center d-lg-none mb-3 px-2">
                    <img src="{{ asset('assets/logos/logo2.png') }}" height="30">
                    <button id="closeSidebar" class="btn btn-sm btn-light border-0">
                        <i class="bi bi-x-lg fs-5"></i>
                    </button>
                </div>
                
                <div class="text-center d-none d-lg-block mb-4">
                    <img src="{{ asset('assets/logos/logo2.png') }}" height="45" class="mb-2">
                </div>

                <ul class="nav-links flex-column nav position-relative ">
                    @can('patient_welcome')
                    <li class="nav-item">
                        <a href="{{ route('patient_welcome') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <i class="bi bi-house-door-fill" style="color: #347fc2;"></i>
                            </div>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('appointments.myAppointments') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <i class="bi bi-calendar-check-fill" style="color: #347fc2;"></i>
                            </div>
                            My Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('appointment_packages.patient_index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <i class="bi bi-gift-fill" style="color: #347fc2;"></i>
                            </div>
                            Special Packages
                        </a>
                    </li>
                    @endcan
                    @can('admin_welcome')
                    <li class="nav-item">
                        <a href="{{ route('admin_welcome') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('appointment_chat.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <i class="bi bi-chat-dots-fill" style="color: #347fc2;"></i>
                            </div>
                            Appointment Messages
                        </a>
                    </li>
                    @endcan
                    @if (auth()?->guard('web')?->user()?->type == 'hospital')
                    @can('welcome_provider')
                    <li class="nav-item">
                        <a href={{ route('welcome_provider') }} class="nav-link d-flex align-items-center gap-3">
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
                    @endcan

                    <li class="nav-item">
                        <a href="{{ route('appointment_chat.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <i class="bi bi-chat-dots-fill" style="color: #347fc2; font-size: 16px;"></i>
                            </div>
                            Appointment Messages
                        </a>
                    </li>
                    @endif

                    @if (auth()?->guard('web')?->user()?->type == 'doctor')
                    @can('welcome_doctor')
                    <li class="nav-item">
                        <a href={{ route('welcome_doctor') }} class="nav-link d-flex align-items-center gap-3">
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
                    @endcan

                    <li class="nav-item">
                        <a href="{{ route('appointment_chat.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <i class="bi bi-chat-dots-fill" style="color: #347fc2; font-size: 16px;"></i>
                            </div>
                            Appointment Messages
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('doctor.appointments.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <i class="bi bi-calendar-check-fill" style="color: #347fc2; font-size: 16px;"></i>
                            </div>
                            Assigned Appointments
                        </a>
                    </li>
                    @endif
                    @if (auth()?->guard('web')?->user()?->type == 'hospital')
                    @can('provider_reservations')
                    <li class="nav-item">
                        <a href={{ route('provider_reservations') }}
                            class="nav-link d-flex align-items-center gap-3">
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
                            Reservations
                        </a>
                    </li>
                    @endcan
                    @endif
                    @can('admin_patients')
                    <li class="nav-item">
                        <a href="{{ route('admin_patients') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Patients
                        </a>
                    </li>
                    @endcan
                    {{-- <li class="nav-item">
                        <a href="{{ route('patients') }}" class="nav-link d-flex align-items-center gap-3">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                    </div>
                    Patients
                    </a>
                    </li> --}}
                    @can('about_us')
                    <li class="nav-item">
                        <a href="{{ route('aboutus.create') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            AboutUs
                        </a>
                    </li>
                    @endcan
                    @can('articles')
                    <li class="nav-item">
                        <a href="{{ route('get_articles.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Articles
                        </a>
                    </li>
                    @endcan
                    @can('admin_welcome')
                    <li class="nav-item">
                        <a href="{{ route('appointments.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16v9zm-7-4.646V11a.5.5 0 0 0 .708.457L11 10.83l1.292.627A.5.5 0 0 0 13 11V8.31a.5.5 0 0 0-.864-.345l-.001.001-2.135 2.135V8.5a.5.5 0 0 0-1 0v1.5a.5.5 0 0 0 .5.5H11a.5.5 0 0 0 0-1h-.793l2.135-2.135a.5.5 0 0 1 .158-.103V11l-1.157-.562a.5.5 0 0 0-.414 0L10 11V8.5a.5.5 0 0 0-1 0v1.5a.5.5 0 0 0 .5.5H11a.5.5 0 0 0 0-1H10V8.5a.5.5 0 0 0-1 0v1.5z" />
                                </svg>
                            </div>
                            Appointments
                        </a>
                    </li>
                    @endcan
                    @can('services')
                    <li class="nav-item">
                        <a href="{{ route('services.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Service
                        </a>
                    </li>
                    @endcan

                    @can('blogs')
                    <li class="nav-item">
                        <a href="{{ route('get_blogs.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Blogs
                        </a>
                    </li>
                    @endcan
                    {{-- @can('brand')
                        <li class="nav-item">
                            <a href="{{ route('brand.create') }}" class="nav-link d-flex align-items-center gap-3">
                    <div class="box-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                    </div>
                    Brand
                    </a>
                    </li>
                    @endcan --}}

                    @can('faqs')
                    <li class="nav-item">
                        <a href="{{ route('get_faqs.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Faqs
                        </a>
                    </li>
                    @endcan
                    
                       @can('faqs')
                    <li class="nav-item">
                        <a href="{{ route('specialty-questions.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                </svg>
                            </div>
                            Specialty Questions
                        </a>
                    </li>
                    @endcan



                    {{-- <li class="nav-item">
                        <a href="{{ route('welcome_provider') }}" class="nav-link d-flex align-items-center gap-3">
                    <div class="box-icon">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                    </div>
                    Provider Dashboard
                    </a>
                    </li>
                    </li> --}}
                    @can('provider_profile')
                    <li class="nav-item">
                        <a href="{{ route('provider_profile') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg>
                            </div>
                            Profile
                        </a>
                    </li>
                    @endcan

                    @if (auth()?->guard('web')?->user()?->type == 'doctor')
                    @can('doctor_patients')
                    <li class="nav-item">
                        <a href="{{ route('provider_patient') }}"
                            class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg>
                            </div>
                            doctor Patients
                        </a>
                    </li>
                    @endcan
                    @endif


                    @can('my_sick_bookings')
                    <li class="nav-item">
                        <a href="{{ route('patient.consultations.book') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-plus" viewBox="0 0 16 16">
                                    <path d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z" />
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                            </div>
                            Book Consultation
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('patient.consultations.my-bookings') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-pulse" viewBox="0 0 16 16">
                                    <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z" />
                                    <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z" />
                                    <path d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128L9.979 5.356Z" />
                                </svg>
                            </div>
                            My Consultations
                        </a>
                    </li>
                    @endcan



                    @can('doctor_reviews_ratings')
                                        <li class="nav-item">
                        <a href="{{ route('doctor.consultations.pricing') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                </svg>
                            </div>
                            Consultation Pricing
                        </a>
                    </li>
                      <li class="nav-item">
                        <a href="{{ route('doctor.consultations.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                            </div>
                            Patient Bookings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('provider_ratings') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg>
                            </div>
                            Reviews & Ratings
                        </a>
                    </li>
                    @endcan

                    @if (auth()?->guard('web')?->user()?->type == 'doctor')
                    @can('doctor_reviews_ratings')
                    <li class="nav-item">
                        <a href="{{ route('provider_schedules') }}"
                            class="nav-link d-flex align-items-center gap-3">
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
                            Provider Scedule
                        </a>
                    </li>
                    @endcan
                    @endif



                    <!--@can('inquiries')-->
                    <!--    <li class="nav-item">-->
                    <!--        <a href="{{ route('inquiries.index') }}" class="nav-link d-flex align-items-center gap-3">-->
                    <!--            <div class="box-icon">-->
                    <!--                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
                    <!--                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">-->
                    <!--                    <path-->
                    <!--                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />-->
                    <!--                </svg>-->
                    <!--            </div>-->
                    <!--            Inquiries-->
                    <!--        </a>-->
                    <!--    </li>-->
                    <!--@endcan-->

                    @can('document_center')
                    <li class="nav-item">
                        <a href="{{ route('document_centers') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Documents Center
                        </a>
                    </li>
                    @endcan


                    @can('package-options')
                    <li class="nav-item">
                        <a href="{{ route('package-options.index') }}"
                            class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Package Options
                        </a>
                    </li>
                    @endcan


                    @can('packages')
                    <li class="nav-item">
                        <a href="{{ route('packages.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Packages
                        </a>
                    </li>
                    @endcan


                    @can('packages_nursing')
                    <li class="nav-item">
                        <a href="{{ route('packages_nursing.index') }}"
                            class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Nursing Packages
                        </a>
                    </li>
                    @endcan

                    @can('package-options-nursing')
                    <li class="nav-item">
                        <a href="{{ route('package-options-nursing.index') }}"
                            class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Nursing Package Options
                        </a>
                    </li>
                    @endcan




                    @can('package-options-hospital')
                    <li class="nav-item">
                        <a href="{{ route('package-options-hospital.index') }}"
                            class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Package Options Providers
                        </a>
                    </li>
                    @endcan


                    @can('packages_hospital')
                    <li class="nav-item">
                        <a href="{{ route('packages_hospital.index') }}"
                            class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Packages Providers
                        </a>
                    </li>
                    @endcan



                    {{-- <li class="nav-item">
                        <a href="{{ route('feedback_review') }}" class="nav-link d-flex align-items-center gap-3">
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
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a href="{{ route('patient_schedules') }}" class="nav-link d-flex align-items-center gap-3">
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
                    Scedule
                    </a>
                    </li> --}}
                    {{-- @can('messages')
                        <li class="nav-item">
                            <a href="{{ route('messages') }}" class="nav-link d-flex align-items-center gap-3">
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
                    Messages
                    </a>
                    </li>
                    @endcan --}}


                    @can('coupons')
                    <li class="nav-item">
                        <a href="{{ route('coupons') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            coupons
                            {{-- حجوزات الرعايه  --}}
                        </a>
                    </li>
                    @endcan





                    {{-- Patient Pages   --}}

                    @can('my_nursing_bookings')
                    <li class="nav-item">
                        <a href="{{ route('my_nursing_bookings') }}"
                            class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Care bookings
                            {{-- حجوزات الرعايه  --}}
                        </a>
                    </li>
                    @endcan

                    @can('my_provider_bookings')
                    <li class="nav-item">
                        <a href="{{ route('my_provider_bookings') }}"
                            class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Providers bookings
                            {{-- حجوزات الرعايه  --}}
                        </a>
                    </li>
                    @endcan


                    @can('my_sick_bookings')
                    <li class="nav-item">
                        <a href="{{ route('my_sick_bookings') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Sick bookings
                            {{-- حجوزات الرعايه  --}}
                        </a>
                    </li>
                    @endcan
                    @can('patient_doctors')
                    <li class="nav-item">
                        <a href="{{ route('patient_doctors') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Doctors
                            {{-- حجوزات الرعايه  --}}
                        </a>
                    </li>
                    @endcan
                    @can('patient_provider')
                    <li class="nav-item">
                        <a href="{{ route('patient_provider') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                </svg>
                            </div>
                            Providers
                            {{-- حجوزات الرعايه  --}}
                        </a>
                    </li>
                    @endcan
                    
                    
                    @can('faqs')
                    <li class="nav-item">
                        <a href="{{ route('specialties.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heptagon-half" viewBox="0 0 16 16">
                                    <path d="M7.779.052a.5.5 0 0 1 .442 0l6.015 2.97a.5.5 0 0 1 .267.34l1.485 6.676a.5.5 0 0 1-.093.45l-4.11 5.4a.5.5 0 0 1-.397.197H4.611a.5.5 0 0 1-.397-.197l-4.11-5.4a.5.5 0 0 1-.093-.45l1.485-6.676a.5.5 0 0 1 .267-.34L7.779.052zM8 15h3.093l3.868-5.082-1.398-6.28L8 1.179V15z" />
                                </svg>
                            </div>
                            Specialties
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('treatment-services.index') }}" class="nav-link d-flex align-items-center gap-3">
                            <div class="box-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bandaid" viewBox="0 0 16 16">
                                    <path d="M14.12 1.88a5.5 5.5 0 0 0-7.78 0L1.88 6.34a5.5 5.5 0 0 0 0 7.78l4.46 4.46a5.5 5.5 0 0 0 7.78-7.78l-4.46-4.46zm-1.06 1.06a4 4 0 0 1 0 5.66l-1.06 1.06a4 4 0 0 1-5.66-5.66l1.06-1.06a4 4 0 0 1 5.66 0z" />
                                </svg>
                            </div>
                            Treatment Services
                        </a>
                    </li>
                    @endcan



                    <li class="nav-item">
                        <a href="{{ route('log_out') }}" class="nav-link d-flex align-items-center gap-3">
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
                            Logout
                        </a>
                    </li>

                </ul>
                <!-- Doc -->
                {{-- <div class="px-4">
                    <div class="d-flex flex-column gap-3 bg-primary bg-circle-pattern px-2 py-3 text-white rounded-4">
                        <div class="bg-white p-1 pt-0 rounded-2" style="width: fit-content;">
                            <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9 0.5C4.03125 0.5 0 4.53125 0 9.5C0 14.4687 4.03125 18.5 9 18.5C13.9687 18.5 18 14.4687 18 9.5C18 4.53125 13.9687 0.5 9 0.5ZM8.71875 14.75C8.53333 14.75 8.35207 14.695 8.1979 14.592C8.04373 14.489 7.92357 14.3426 7.85261 14.1713C7.78165 14 7.76309 13.8115 7.79926 13.6296C7.83544 13.4477 7.92472 13.2807 8.05584 13.1496C8.18695 13.0185 8.35399 12.9292 8.53585 12.893C8.71771 12.8568 8.90621 12.8754 9.07751 12.9464C9.24882 13.0173 9.39524 13.1375 9.49825 13.2916C9.60126 13.4458 9.65625 13.6271 9.65625 13.8125C9.65625 14.0611 9.55748 14.2996 9.38166 14.4754C9.20585 14.6512 8.96739 14.75 8.71875 14.75V14.75ZM10.2862 9.96875C9.5264 10.4787 9.42187 10.9461 9.42187 11.375C9.42187 11.549 9.35273 11.716 9.22966 11.839C9.10659 11.9621 8.93967 12.0312 8.76562 12.0312C8.59157 12.0312 8.42466 11.9621 8.30158 11.839C8.17851 11.716 8.10937 11.549 8.10937 11.375C8.10937 10.348 8.58187 9.5314 9.55406 8.87844C10.4578 8.27187 10.9687 7.8875 10.9687 7.04234C10.9687 6.46766 10.6406 6.03125 9.9614 5.70828C9.80156 5.63234 9.44578 5.55828 9.00797 5.56344C8.45859 5.57047 8.03203 5.70172 7.70344 5.96609C7.08375 6.46484 7.03125 7.00765 7.03125 7.01562C7.02709 7.1018 7.006 7.18632 6.96919 7.26435C6.93237 7.34238 6.88054 7.41239 6.81666 7.4704C6.75279 7.5284 6.67811 7.57325 6.5969 7.60239C6.51569 7.63153 6.42954 7.64439 6.34336 7.64023C6.25718 7.63608 6.17266 7.61499 6.09463 7.57817C6.0166 7.54135 5.94659 7.48952 5.88859 7.42565C5.83059 7.36177 5.78574 7.2871 5.75659 7.20589C5.72745 7.12468 5.71459 7.03852 5.71875 6.95234C5.7239 6.83844 5.80312 5.81234 6.87984 4.94609C7.43812 4.49703 8.14828 4.26359 8.98922 4.25328C9.58453 4.24625 10.1437 4.34703 10.523 4.52609C11.6578 5.06281 12.2812 5.95766 12.2812 7.04234C12.2812 8.62812 11.2214 9.34015 10.2862 9.96875Z"
                                    fill="#347FC2" fill-opacity="0.98" />
                            </svg>
                        </div>
                        <div class="d-flex flex-column ">
                            <span>Need help?</span>
                            <span class="text-4 text-white">Please check our docs</span>
                        </div>
                        <button class="btn bg-white">Documentation</button>
                    </div>
                </div>  --}}



            </aside>