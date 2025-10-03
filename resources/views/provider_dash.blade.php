@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar - col-md-2 for medium screens and up, full width on smaller screens -->
                    @include('dashboard.layouts.sidebar')
            <!-- Main content - col-md-10 for medium screens and up, full width on smaller screens -->
            <main class="col-md-10 p-4 pb-0">
                <h2 class="text-head">Welcome <strong>Dr.Mohamed</strong></h2>
                <!-- Button trigger modal -->
                <button id="btnModal" type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#onboardingModal" hidden>
                </button>

                <!-- Main Modal -->
                <div class="modal fade" id="onboardingModal" tabindex="-1" aria-labelledby="onboardingModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content tf-dialog">
                            <div class="modal-header">
                                <div class="d-flex align-items-center gap-1 w-100 ">
                                    <div class="current-step">1</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="next-step">2</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="next-step">3</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="next-step">4</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body p-5">
                                <div class="mb-4">
                                    <h3 class="dialog-head">Notice</h3>
                                    <span class="txt-sm fs-6">Please, enter your information to onboard new healthcare
                                        providers as partners on the MISC platform</span>
                                </div>
                                <fieldset>
                                    <label for="">Legal business name</label>
                                    <input type="text" name="" id=""
                                        placeholder="As registered with the relevant authorities">
                                </fieldset>
                                <fieldset>
                                    <label for="">Type of healthcare facility</label>
                                    <select name="" id="">
                                        <option value="">Select type</option>
                                    </select>
                                </fieldset>
                                <div class="grid-3">
                                    <fieldset>
                                        <label for="">Physical address</label>
                                        <input type="text" name="" id="" placeholder="Street name">
                                    </fieldset>
                                    <fieldset>
                                        <label for="" class="invisible ">Town</label>
                                        <select name="" id="">
                                            <option value="">Select Town</option>
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        <label for="" class="invisible ">Country</label>
                                        <select name="" id="">
                                            <option value="">Select Country</option>
                                        </select>
                                    </fieldset>

                                </div>
                                <div class="grid-3">
                                    <fieldset>
                                        <label for="">Contact information</label>
                                        <input type="text" name="" id="" placeholder="Phone number">
                                    </fieldset>
                                    <fieldset>
                                        <label for="" class="invisible ">Email</label>
                                        <input type="text" name="" id="" placeholder="Email">
                                    </fieldset>
                                    <fieldset>
                                        <label for="" class="invisible ">main point of contact</label>
                                        <input type="text" name="" id="" placeholder="main point of contact">
                                    </fieldset>
                                </div>
                                <fieldset>
                                    <label for="">Website and social media links</label>
                                    <input type="text" name="" id="" placeholder="Optional">
                                </fieldset>
                                <div class="mt-4">
                                    <button class="btn btn-primary w-100" data-bs-target="#ModalToggle2"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Second Modal -->
                <div class="modal fade" id="ModalToggle2" aria-hidden="true" aria-labelledby="ModalToggleLabel2"
                    tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content tf-dialog">
                            <div class="modal-header">
                                <div class="d-flex align-items-center gap-1 w-100 ">
                                    <div class="current-step">1</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 100%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="current-step">2</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="next-step">3</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="next-step">4</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body p-5">
                                <div class="mb-4">
                                    <h3 class="dialog-head">Licenses and Certifications</h3>
                                </div>
                                <fieldset class="gap-2 w-75">
                                    <label for="">Local Operating License</label>
                                    <p class="text-2 mb-1">Add your Current and valid licenses issued by Qatar’s health
                                        authority or relevant international authorities.</p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>
                                <fieldset class="gap-2 w-75">
                                    <label for="">Accreditations</label>
                                    <p class="text-2 mb-1">Documents or certification numbers for relevant
                                        accreditations (e.g., JCI for hospitals, ISO certifications, etc.).</p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>
                                <fieldset class="gap-2 w-75">
                                    <label for="">Professional Licenses</label>
                                    <p class="text-2 mb-1">Copies of doctors’ and specialists’ licenses for verification
                                        of credentials.</p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>
                                <div class="mt-4">
                                    <button class="btn btn-primary w-100" data-bs-target="#ModalToggle3"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Third Modal -->
                <div class="modal fade" id="ModalToggle3" aria-hidden="true" aria-labelledby="ModalToggleLabel3"
                    tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content tf-dialog">
                            <div class="modal-header">
                                <div class="d-flex align-items-center gap-1 w-100 ">
                                    <div class="current-step">1</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 100%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="current-step">2</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 100%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="current-step">3</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="next-step">4</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body p-5">
                                <div class="mb-4">
                                    <h3 class="dialog-head">Insurance and Liability Coverage</h3>
                                </div>
                                <fieldset>
                                    <label for="">Insurance & Patient Safety and Risk Management Policies</label>
                                    <div style="height: 400px;overflow-y: auto;" class="bg-white py-2 px-4">
                                        <span>
                                            Last Updated: [Date]

                                            MISC HealthConnect is committed to creating a trusted community where users
                                            can share experiences and provide feedback on healthcare services and
                                            facilities. This Review and Comment Policy outlines who can submit reviews,
                                            the content standards required, and how we moderate and display reviews.

                                            1. Purpose of the Review and Comment Policy

                                            The purpose of this policy is to establish guidelines for submitting,
                                            moderating, and displaying reviews and comments on the MISC HealthConnect
                                            platform. This helps ensure the reliability and relevance of user feedback,
                                            fostering a supportive and safe community for all users.

                                            2. Eligibility to Submit Reviews and Comments

                                            To submit a review or comment on MISC HealthConnect:

                                            - Registered Users Only: Reviews and comments may only be submitted by
                                            registered users who have booked or used services through MISC
                                            HealthConnect.
                                            - Verified Service Interaction: Users must have a verified interaction with
                                            the healthcare provider or service they are reviewing. This ensures the
                                            authenticity and relevance of feedback.
                                            - No Conflict of Interest: Individuals who are associated with healthcare
                                            providers, partners, or MISC HealthConnect employees are prohibited from
                                            submitting reviews to prevent conflicts of interest.
                                            - Age Requirement: Users must be 18 years or older to post reviews. Parental
                                            consent may be required for individuals sharing feedback on behalf of
                                            minors.


                                            3. Guidelines for Review and Comment Content

                                            To maintain a constructive environment, all submitted reviews and comments
                                            must adhere to the following content standards:

                                        </span>
                                    </div>

                                </fieldset>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex gap-3">
                                        <input type="checkbox" class="form-check-input" name="" id="">
                                        <span class="text-dark fw-semibold">I confirm that I have read and accept the
                                            terms and conditions and privacy policy.</span>
                                    </div>
                                    <button class="btn btn-primary" data-bs-target="#ModalToggle4"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fourth Modal -->
                <div class="modal fade" id="ModalToggle4" aria-hidden="true" aria-labelledby="ModalToggleLabel4"
                    tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content tf-dialog">
                            <div class="modal-header">

                                <div class="current-step">4</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="next-step">5</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="next-step">6</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="next-step">7</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="modal-body p-5">
                                <div class="mb-4">
                                    <h3 class="dialog-head">Service Portfolio</h3>
                                </div>
                                <fieldset>
                                    <label for="">Detailed Service List</label>
                                    <span class="text-2 mb-3">Description of services offered (e.g., cosmetic surgery,
                                        cardiology, physical therapy).</span>
                                    <input type="text" placeholder="services offered">
                                </fieldset>
                                <fieldset>
                                    <label for="">Specializations</label>
                                    <span class="text-2 mb-3">Key areas of expertise or unique treatment
                                        offerings.</span>
                                    <input type="text" placeholder="Specializations">
                                </fieldset>
                                <fieldset>
                                    <label for="">Pricing Information</label>
                                    <span class="text-2 mb-3">Optional but encouraged for transparency, especially for
                                        common services.</span>
                                    <input type="text" placeholder="Pricing Information">
                                </fieldset>
                                <fieldset class="gap-2 w-75">
                                    <label for="">Patient Testimonials/Reviews</label>
                                    <p class="text-2 mb-1">If available, patient feedback that demonstrates quality of
                                        care .</p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>
                                <div class="mt-4">
                                    <button class="btn btn-primary w-100" data-bs-target="#ModalToggle5"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fivth Modal -->
                <div class="modal fade" id="ModalToggle5" aria-hidden="true" aria-labelledby="ModalToggleLabel5"
                    tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content tf-dialog">
                            <div class="modal-header">
                                <div class="current-step">4</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="current-step">5</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="next-step">6</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="next-step">7</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="modal-body p-5">
                                <div class="mb-4">
                                    <h3 class="dialog-head">Medical Staff Profiles</h3>
                                </div>
                                <fieldset>
                                    <label for="">Detailed Profiles for Key Practitioners</label>
                                    <div class="d-flex flex-column gap-3">
                                        <input type="text" placeholder="Full name">
                                        <input type="text" placeholder="qualification">
                                        <select name="" id="">
                                            <option value="">Years of experience</option>
                                        </select>
                                        <input type="text" placeholder="specialty details">
                                    </div>
                                </fieldset>

                                <fieldset class="gap-2 w-75">
                                    <p class="text-2 mb-1">
                                        Add professional photo here, High-quality headshots of doctor for him profile on
                                        the platform.
                                    </p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>
                                <fieldset class="gap-2 w-75">
                                    <p class="text-2 mb-1">
                                        Add certifications and training records
                                    </p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>
                                <div class="mt-4">
                                    <button class="btn btn-primary w-100" data-bs-target="#ModalToggle6"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- sixth Modal -->
                <div class="modal fade" id="ModalToggle6" aria-hidden="true" aria-labelledby="ModalToggleLabel6"
                    tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content tf-dialog">
                            <div class="modal-header">
                                <div class="current-step">4</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="current-step">5</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="current-step">6</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="next-step">7</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="modal-body p-5">
                                <div class="mb-4">
                                    <h3 class="dialog-head">Facility and Service Standards</h3>
                                </div>
                                <fieldset class="gap-2 w-75">
                                    <label for="">Facility Photos</label>
                                    <p class="text-2 mb-1">Add high-resolution images of the facility, treatment rooms,
                                        waiting areas, etc., for visual representation on the platform.</p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>

                                <fieldset>
                                    <label for="">Technology and Equipment List</label>
                                    <p class="text-2 mb-1">Documentation of advanced technology available at the
                                        facility (e.g., MRI, robotic surgery tools).</p>
                                    <input type="text" placeholder="Technology and Equipment List">
                                </fieldset>
                                <fieldset>
                                    <label for="">Quality Assurance Protocols</label>
                                    <p class="text-2 mb-1">Information on quality standards, infection control
                                        protocols, and patient experience measures.</p>
                                    <input type="text" placeholder="Quality Assurance Protocols">
                                </fieldset>
                                <div class="mt-4">
                                    <button class="btn btn-primary w-100" data-bs-target="#ModalToggle7"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seventh Modal -->
                <div class="modal fade" id="ModalToggle7" aria-hidden="true" aria-labelledby="ModalToggleLabel7"
                    tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content tf-dialog">
                            <div class="modal-header">
                                <div class="current-step">7</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="next-step">8</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-success"><i class="bi bi-check-circle-fill fs-4"></i></div>
                            </div>
                            <div class="modal-body p-5">
                                <div class="mb-4">
                                    <h3 class="dialog-head">Marketing and Promotion Preferences</h3>
                                </div>
                                <fieldset>
                                    <label for="">Preferred Partnership Package</label>
                                    <p class="text-2 mb-1">Choose depending on desired exposure and features.</p>
                                    <select name="" id="">
                                        <option value="">Services Offered</option>
                                    </select>
                                </fieldset>
                                <fieldset>
                                    <span>
                                        Note: 1. Free Package
                                        - Cost: Free
                                        - Features:
                                        - Basic Listing: Healthcare provider listed in MISC’s directory with minimal
                                        information.
                                        - Contact Information: Displayed with direct contact (phone/email).
                                        - User Access: Patients can view basic details but no in-depth profile or
                                        testimonials.
                                        - Added Benefits:
                                        - Access to periodic newsletters and updates on the medical tourism industry in
                                        Qatar.
                                        - Limited access to training and webinars provided by MISC on healthcare
                                        marketing and quality standards.

                                        2. Basic Package
                                        - Cost: QAR 10,000 annually
                                        - Features:
                                        - Enhanced Listing: Display with basic provider information, including contact
                                        details and a brief description of services.
                                        - User Access: Patients can read brief service descriptions, view doctor names,
                                        and see photos of facilities.
                                        - Reviews & Ratings Display: Ability to display patient reviews and star ratings
                                        (if available).
                                        - Added Benefits:
                                        - Featured in “Basic Partners” section on the MISC platform.
                                        - Access to one virtual training session or webinar per year.
                                        - One promotional feature in MISC’s quarterly email newsletter sent to
                                        prospective patients.

                                        3. Standard Package
                                        - Cost: QAR 25,000 annually
                                        - Features:
                                        - Detailed Profile Page: Comprehensive profile with detailed service
                                        descriptions, doctor bios, facility photos, and patient testimonials.
                                        - Priority Listing: Displayed higher than Basic partners in search results on
                                        MISC’s platform.
                                        - Direct Booking Option: Patients can request appointments directly through the
                                        MISC platform.
                                        - Enhanced Reviews & Ratings Display: Display additional patient reviews and
                                        priority responses to patient queries.
                                        - Added Benefits:
                                        - Highlighted in MISC’s “Standard Partners” section.
                                        - Two social media promotions annually on MISC’s platforms.
                                        - Access to quarterly training sessions and industry insights.
                                        - Featured on MISC’s blog or newsletter twice per year.

                                        4. Premium Package
                                        - Cost: QAR 50,000 annually
                                        - Features:
                                        - Top-Tier Profile Page: Premium profile with full media integration (videos,
                                        facility tours), and live chat support on the platform.
                                        - Top Priority Listing: Appears at the top in search results, above Standard
                                        listings.
                                        - Direct Appointment Scheduling and Inquiry Management: Patients can directly
                                        schedule consultations and engage in live support.
                                        - Exclusive Brand Highlight: Exclusive badge of “MISC Premium Partner” shown on
                                        the profile.
                                        - Added Benefits:
                                        - Premium partners featured prominently on the homepage.
                                        - Four dedicated social media promotions on MISC’s accounts.
                                        - Access to all MISC-hosted events and networking opportunities.
                                        - Participation in exclusive workshops and webinars on medical tourism
                                        strategies.
                                        - Customized reports on patient engagement and service demand analytics
                                        quarterly.
                                        - Exclusive invitation to join MISC’s advisory panel for input on platform
                                        improvements and industry trends.
                                    </span>
                                </fieldset>

                                <fieldset class="gap-2 w-75">
                                    <label for="">Promotional Content</label>
                                    <p class="text-2 mb-1">Any initial marketing materials or offers to be included in
                                        the platform’s promotions.</p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>

                                <fieldset>
                                    <label for="">Social Media Links and Hashtags</label>
                                    <div class="d-flex flex-column gap-3">
                                        <input type="text" placeholder="Facebook">
                                        <input type="text" placeholder="Instgram">
                                        <input type="text" placeholder="Twitter">
                                        <input type="text" placeholder="TikTok">
                                    </div>
                                </fieldset>
                                <div class="mt-4">
                                    <button class="btn btn-primary w-100" data-bs-target="#ModalToggle8"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Eight Modal -->
                <div class="modal fade" id="ModalToggle8" aria-hidden="true" aria-labelledby="ModalToggleLabel8"
                    tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content tf-dialog">
                            <div class="modal-header">
                                <div class="current-step">7</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="current-step">8</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-success"><i class="bi bi-check-circle-fill fs-4"></i></div>
                            </div>
                            <div class="modal-body p-5">
                                <div class="mb-4">
                                    <h3 class="dialog-head">Optional Features for Enhanced Profiles</h3>
                                </div>
                                <fieldset class="gap-2 w-75">
                                    <label for="">Virtual Tour Video:</label>
                                    <p class="text-2 mb-1">(If available) for an inside look at the facility, helping
                                        build trust with prospective patients.</p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>
                                <fieldset class="gap-2 w-75">
                                    <label for="">Patient Success Stories:</label>
                                    <p class="text-2 mb-1">Featured case studies or video testimonials highlighting
                                        successful treatments.</p>
                                    <div class="box-upload">
                                        <svg width="43" height="42" viewBox="0 0 43 42" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1927_7336)">
                                                <path
                                                    d="M33.9418 3.12109H14.6744V11.1111H38.0569V7.23451C38.0569 4.96616 36.2108 3.12109 33.9418 3.12109Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M23.0352 12.3403H0.5V4.92636C0.5 2.20972 2.71068 0 5.42828 0H12.6336C13.3497 0 14.0396 0.150925 14.6664 0.434509C15.5418 0.828964 16.2939 1.47913 16.8213 2.3286L23.0352 12.3403Z"
                                                    fill="#1640C1" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H4.62111C2.34891 42.0003 0.5 40.153 0.5 37.8817V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#2354E6" />
                                                <path
                                                    d="M42.5 14.0004V37.8817C42.5 40.153 40.6511 42.0003 38.3789 42.0003H21.5V9.88086H38.3789C40.6511 9.88086 42.5 11.7288 42.5 14.0004Z"
                                                    fill="#1849D6" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894C15.4082 36.9894 10.4521 32.0329 10.4521 25.9405C10.4521 19.8491 15.4082 14.8926 21.5 14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#E7ECFC" />
                                                <path
                                                    d="M32.5479 25.9405C32.5479 32.0329 27.5918 36.9894 21.5 36.9894V14.8926C27.5918 14.8926 32.5479 19.8491 32.5479 25.9405Z"
                                                    fill="#CED9F9" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803C20.8207 31.0803 20.2695 30.5292 20.2695 29.8499V25.2218L19.6732 25.9287C19.2342 26.4481 18.4584 26.5145 17.939 26.0758C17.4199 25.6378 17.3533 24.8617 17.7913 24.3422L20.2269 21.4548C20.5445 21.0793 21.0078 20.8633 21.5 20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6468 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#6C8DEF" />
                                                <path
                                                    d="M25.061 26.0758C24.8306 26.2709 24.5483 26.3661 24.2686 26.3661C23.9183 26.3661 23.5703 26.2177 23.3268 25.9287L22.7305 25.2218V29.8499C22.7305 30.5292 22.1793 31.0803 21.5 31.0803V20.8633C21.9922 20.8633 22.4555 21.0793 22.7731 21.4548L25.2087 24.3422C25.6467 24.8617 25.5801 25.6378 25.061 26.0758Z"
                                                    fill="#3B67E9" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1927_7336">
                                                    <rect width="42" height="42" fill="white"
                                                        transform="translate(0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="drag-text mb-0">Drag your file(s) to start uploading</p>
                                        <div class="d-flex align-items-center">
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                            <span class="mx-3 text-muted">OR</span>
                                            <hr class="flex-grow-1 border-top border-secondary" style="width: 100px" />
                                        </div>
                                        <label class="upload-btn p-0 px-1">
                                            Browse File
                                            <input type="file" hidden />
                                        </label>
                                    </div>
                                    <p class="text-2">Only support .jpg, .png and .svg and zip files</p>
                                </fieldset>

                                <fieldset>
                                    <label for="">Content for MISC Blog or Social Media</label>
                                    <p class="text-2 mb-1">Articles, tips, or news items from the provider’s team that
                                        could be shared to boost visibility.</p>

                                    <input type="text" placeholder="Content">

                                </fieldset>
                                <div class="mt-4">
                                    <button class="btn btn-primary w-100" data-bs-target="#SuccessModal"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Success Modal -->
                <div class="modal fade" id="SuccessModal" aria-hidden="true" aria-labelledby="SuccessModal"
                    tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content tf-dialog">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-5">
                                <div class="d-flex flex-column align-items-center gap-3">
                                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                                    <span class="text-success fw-semibold">Congratulations! You have successfully
                                        designed
                                        Your profile</span>
                                    <span class="text-2">Now, you are partner on the MISC platform.</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8 p-4 pb-0">
                        <div class="row box-1 shadow mb-5">
                            <div class="col-6 p-3">
                                <h3 class="header-1 text-dark mb-4">Daily Read</h3>
                                <div class="mb-3">
                                    <img src="../assets/images/read.jpg" alt="daily read" width="100%" height="150px"
                                        class="rounded">
                                </div>
                                <p class="fw-normal text-dark">DNA origami vaccine DoriVac paves way for
                                    personalised
                                    cancer immunotherapy. </p>
                                <button class="btn btn-purple text-white">Read More</button>
                            </div>
                            <div class="col-6 p-3">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h3 class="header-1 text-dark">Today’s Tasks</h3>
                                    <span class="badge bg-purple p-auto fs-6">12</span>
                                </div>
                                <div class="d-flex flex-column gap-2 mb-2">
                                    <div
                                        class="d-flex gap-1 align-items-start justify-content-between border py-2 px-3 rounded">
                                        <div class="d-flex gap-2 align-items-start">
                                            <div class="box-icon-purple">
                                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                        fill="#FAFAFA" />
                                                </svg>


                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="download-txt text-purple">Consultation with George
                                                    Gill</span>
                                                <span class="timing">9:00 AM</span>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </div>

                                    </div>
                                    <div
                                        class="d-flex gap-1 align-items-start justify-content-between border py-2 px-3 rounded">
                                        <div class="d-flex gap-2 align-items-start">
                                            <div class="box-icon-purple">
                                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                        fill="#FAFAFA" />
                                                </svg>


                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="download-txt text-purple">Consultation with George
                                                    Gill</span>
                                                <span class="timing">9:00 AM</span>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </div>

                                    </div>
                                    <div
                                        class="d-flex gap-1 align-items-start justify-content-between border py-2 px-3 rounded">
                                        <div class="d-flex gap-2 align-items-start">
                                            <div class="box-icon-purple">
                                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                        fill="#FAFAFA" />
                                                </svg>


                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="download-txt text-purple">Consultation with George
                                                    Gill</span>
                                                <span class="timing">9:00 AM</span>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </div>

                                    </div>
                                    <div
                                        class="d-flex gap-1 align-items-start justify-content-between border py-2 px-3 rounded">
                                        <div class="d-flex gap-2 align-items-start">
                                            <div class="box-icon-purple">
                                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path
                                                        d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                        fill="#FAFAFA" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                        fill="#FAFAFA" />
                                                </svg>


                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="download-txt text-purple">Consultation with George
                                                    Gill</span>
                                                <span class="timing">9:00 AM</span>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="text-dark">View All</a>
                                </div>

                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-5 ps-0">
                                <div class="p-3 box-1 shadow">
                                    <input type="text" class="form-control datepicker-input mb-4" id="datepicker"
                                        placeholder="Select date">

                                    <div class="d-flex flex-column gap-3 overflow-auto" style="height: 260px;">

                                        <div class="d-flex flex-column gap-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="box-icon-purple">
                                                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path
                                                            d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                            fill="#FAFAFA" />
                                                        <path
                                                            d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path
                                                            d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                            fill="#FAFAFA" />
                                                    </svg>


                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span>Consultation with George Gill</span>
                                                    <span class="tf-date">9:00 am - 11:30 am</span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="box-icon-purple">
                                                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path
                                                            d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                            fill="#FAFAFA" />
                                                        <path
                                                            d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path
                                                            d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                            fill="#FAFAFA" />
                                                    </svg>


                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span>Consultation with George Gill</span>
                                                    <span class="tf-date">9:00 am - 11:30 am</span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-4">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="box-icon-purple">
                                                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path
                                                            d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                            fill="#FAFAFA" />
                                                        <path
                                                            d="M3.68408 1.36421C3.68408 1.07353 3.91971 0.837891 4.2104 0.837891C4.50108 0.837891 4.73671 1.07353 4.73671 1.36421V4.5221C4.73671 4.81278 4.50108 5.04841 4.2104 5.04841C3.91971 5.04841 3.68408 4.81278 3.68408 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path
                                                            d="M12.1053 1.36421C12.1053 1.07353 12.3409 0.837891 12.6316 0.837891C12.9223 0.837891 13.1579 1.07353 13.1579 1.36421V4.5221C13.1579 4.81278 12.9223 5.04841 12.6316 5.04841C12.3409 5.04841 12.1053 4.81278 12.1053 4.5221V1.36421Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 10.8378H3.68373V11.8904H4.73636V10.8378ZM3.68373 9.78516C3.10237 9.78516 2.6311 10.2564 2.6311 10.8378V11.8904C2.6311 12.4718 3.10237 12.943 3.68373 12.943H4.73636C5.31773 12.943 5.78899 12.4718 5.78899 11.8904V10.8378C5.78899 10.2564 5.31773 9.78516 4.73636 9.78516H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 10.8378H7.89498V11.8904H8.94761V10.8378ZM7.89498 9.78516C7.31361 9.78516 6.84235 10.2564 6.84235 10.8378V11.8904C6.84235 12.4718 7.31361 12.943 7.89498 12.943H8.94761C9.52897 12.943 10.0002 12.4718 10.0002 11.8904V10.8378C10.0002 10.2564 9.52897 9.78516 8.94761 9.78516H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M13.1581 10.8378H12.1054V11.8904H13.1581V10.8378ZM12.1054 9.78516C11.5241 9.78516 11.0528 10.2564 11.0528 10.8378V11.8904C11.0528 12.4718 11.5241 12.943 12.1054 12.943H13.1581C13.7394 12.943 14.2107 12.4718 14.2107 11.8904V10.8378C14.2107 10.2564 13.7394 9.78516 13.1581 9.78516H12.1054Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.73636 15.0487H3.68373V16.1014H4.73636V15.0487ZM3.68373 13.9961C3.10237 13.9961 2.6311 14.4674 2.6311 15.0487V16.1014C2.6311 16.6827 3.10237 17.154 3.68373 17.154H4.73636C5.31773 17.154 5.78899 16.6827 5.78899 16.1014V15.0487C5.78899 14.4674 5.31773 13.9961 4.73636 13.9961H3.68373Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.94761 15.0487H7.89498V16.1014H8.94761V15.0487ZM7.89498 13.9961C7.31361 13.9961 6.84235 14.4674 6.84235 15.0487V16.1014C6.84235 16.6827 7.31361 17.154 7.89498 17.154H8.94761C9.52897 17.154 10.0002 16.6827 10.0002 16.1014V15.0487C10.0002 14.4674 9.52897 13.9961 8.94761 13.9961H7.89498Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.10526 3.99599H14.7368C15.3182 3.99599 15.7894 4.46725 15.7894 5.04862V13.4697C16.1529 13.4697 16.5057 13.5157 16.8421 13.6023V5.04862C16.8421 3.88592 15.8995 2.94336 14.7368 2.94336H2.10526C0.942556 2.94336 0 3.88592 0 5.04862V17.6802C0 18.8429 0.942556 19.7854 2.10526 19.7854H12.1422C11.9538 19.4597 11.8077 19.1062 11.7116 18.7328H2.10526C1.52391 18.7328 1.05263 18.2615 1.05263 17.6802V5.04862C1.05263 4.46725 1.52391 3.99599 2.10526 3.99599Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.3158 8.73232H0.526367V7.67969H16.3158V8.73232Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 20.8391C17.5335 20.8391 18.9473 19.4253 18.9473 17.6812C18.9473 15.9372 17.5335 14.5233 15.7894 14.5233C14.0454 14.5233 12.6315 15.9372 12.6315 17.6812C12.6315 19.4253 14.0454 20.8391 15.7894 20.8391ZM15.7894 21.8917C18.1149 21.8917 20 20.0066 20 17.6812C20 15.3558 18.1149 13.4707 15.7894 13.4707C13.464 13.4707 11.5789 15.3558 11.5789 17.6812C11.5789 20.0066 13.464 21.8917 15.7894 21.8917Z"
                                                            fill="#FAFAFA" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.7894 15.1426C16.0801 15.1426 16.3157 15.3782 16.3157 15.6689V17.931L17.606 18.8267C17.8447 18.9924 17.904 19.3204 17.7382 19.5592C17.5724 19.7979 17.2445 19.8571 17.0057 19.6914L15.2631 18.4818V15.6689C15.2631 15.3782 15.4987 15.1426 15.7894 15.1426Z"
                                                            fill="#FAFAFA" />
                                                    </svg>


                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span>Consultation with George Gill</span>
                                                    <span class="tf-date">9:00 am - 11:30 am</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-7 pe-0">
                                <div class="p-3 box-1 shadow">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="header-1 text-dark">Next patient’s details</h3>
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </div>
                                    <div class="d-flex flex-column gap-1 align-items-center mb-3">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <span class="heading-3 fw-bold text-dark">Ammar Hi</span>
                                        <div class="d-flex gap-1 text-3 text-head">
                                            <span>25 years old</span>
                                            <span>|</span>
                                            <span><i class="bi bi-geo-alt"></i> New York, USA</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between px-2 mb-3">
                                        <div class="d-flex flex-column">
                                            <span class="text-4">Blod</span>
                                            <span class="text-dark fw-bold">A+</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-4">Height</span>
                                            <span class="text-dark fw-bold">175cm</span>

                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-4">Weight</span>
                                            <span class="text-dark fw-bold">90Kg</span>

                                        </div>
                                    </div>
                                    <!-- Taps -->
                                    <div class="">
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
                                                <span class="d-inline-block text-truncate" style="max-width: 100%;">
                                                    James is a 32-year-old male with no known allergies or drug
                                                    sensitivities. He has a history of seasonal allergies and
                                                    occasional
                                                    migraines. He takes no medications regularly.
                                                </span>

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

                            </div>
                        </div>

                    </div>

                    <div class="col p-4">
                        <div class="p-3 box-1 shadow">
                            <h3 class="header-1 text-dark mb-4">Upcoming Consultations</h3>
                            <div class="d-flex flex-column gap-3 p-2" style="height: 670px;overflow-y: scroll;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <img src="../assets/images/doctor.png" alt="doctor" width="65" height="65"
                                            class="rounded-circle img-thumbnail">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <span class="heading-4 text-dark">Nemar</span>
                                            <span class="timing">18 March, 2023 | 09:00 PM</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-purple text-white">Clinical Record</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
