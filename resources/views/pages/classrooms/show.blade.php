@extends('layouts/layoutMaster')

@section('title', 'الفصل الدراسي')

@section('vendor-style')
    @vite('resources/assets/vendor/libs/plyr/plyr.scss')
@endsection

@section('page-style')
    @vite('resources/assets/vendor/scss/pages/app-academy-details.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/plyr/plyr.js')
@endsection

@section('page-script')
    @vite('resources/assets/js/app-academy-course-details.js')
@endsection

@section('content')

    <div class="row g-6">
    <div class="col-lg-8">
        <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-6 gap-2">
            <div class="me-1">
                <h5 class="mb-0">{{ $classroom->name }}</h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge bg-label-danger">{{ $classroom->level }}</span>
                <i class='ti ti-share ti-lg mx-4'></i>
                <i class='ti ti-bookmarks ti-lg'></i>
            </div>
            </div>
            <div class="card academy-content shadow-none border">
            <div class="card-body pt-4">
                <h5>الوصف</h5>
                <p class="mb-0">{{ $classroom->description }}</p>
                <hr class="my-6">
                <h5>حول</h5>
                <div class="d-flex flex-wrap row-gap-2">
                    <div class="me-12">
                        <p class="text-nowrap mb-2"><i class='ti ti-users me-2 align-bottom'></i>السعة: {{ $classroom->capacity }} طالب</p>
                    </div>
                    <div>
                        <p class="text-nowrap mb-2"><i class='ti ti-tag me-2 align-top ms-50'></i>المستوى الدراسي: {{ $classroom->level }}</p>
                    </div>
                    <hr class="my-6">
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="accordion stick-top accordion-custom-button" id="courseContent">
        <div class="accordion-item active mb-0">
            <div class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button " data-bs-toggle="collapse" data-bs-target="#chapterOne" aria-expanded="true" aria-controls="chapterOne">
                <span class="d-flex flex-column">
                <span class="h5 mb-0">Course Content</span>
                <span class="text-body fw-normal">2 / 5 | 4.4 min</span>
                </span>
            </button>
            </div>
            <div id="chapterOne" class="accordion-collapse collapse show" data-bs-parent="#courseContent">
            <div class="accordion-body py-4">
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="" />
                <label for="defaultCheck1" class="form-check-label ms-4">
                    <span class="mb-0 h6">1. Welcome to this course</span>
                    <small class="text-body d-block">2.4 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defaultCheck2" checked="" />
                <label for="defaultCheck2" class="form-check-label ms-4">
                    <span class="mb-0 h6">2. Watch before you start</span>
                    <small class="text-body d-block">4.8 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                <label for="defaultCheck3" class="form-check-label ms-4">
                    <span class="mb-0 h6">3. Basic design theory</span>
                    <small class="text-body d-block">5.9 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defaultCheck4" />
                <label for="defaultCheck4" class="form-check-label ms-4">
                    <span class="mb-0 h6">4. Basic fundamentals</span>
                    <small class="text-body d-block">3.6 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-0">
                <input class="form-check-input" type="checkbox" id="defaultCheck5" />
                <label for="defaultCheck5" class="form-check-label ms-4">
                    <span class="mb-0 h6">5. What is ui/ux</span>
                    <small class="text-body d-block">10.6 min</small>
                </label>
                </div>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" id="headingTwo">
            <button type="button" class=" accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterTwo" aria-expanded="false" aria-controls="chapterTwo">
                <span class="d-flex flex-column">
                <span class="h5 mb-0">Web Design for Web Developers</span>
                <span class="text-body fw-normal">1 / 4 | 4.4 min</span>
                </span>
            </button>
            </div>
            <div id="chapterTwo" class="accordion-collapse collapse" data-bs-parent="#courseContent">
            <div class="accordion-body py-4">
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck1" checked="" />
                <label for="defCheck1" class="form-check-label ms-4">
                    <span class="mb-0 h6">1. How to use Pages in Figma</span>
                    <small class="text-body d-block">8:31 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck2" />
                <label for="defCheck2" class="form-check-label ms-4">
                    <span class="mb-0 h6">2. What is Lo Fi Wireframe</span>
                    <small class="text-body d-block">2 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck3" />
                <label for="defCheck3" class="form-check-label ms-4">
                    <span class="mb-0 h6">3. How to use color in Figma</span>
                    <small class="text-body d-block">5.9 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-0">
                <input class="form-check-input" type="checkbox" id="defCheck4" />
                <label for="defCheck4" class="form-check-label ms-4">
                    <span class="mb-0 h6">4. Frames vs Groups in Figma</span>
                    <small class="text-body d-block">3.6 min</small>
                </label>
                </div>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" id="headingThree">
            <button type="button" class=" accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterThree" aria-expanded="false" aria-controls="chapterThree">
                <span class="d-flex flex-column">
                <span class="h5 mb-0">Build Beautiful Websites!</span>
                <span class="text-body fw-normal">0 / 6 | 4.4 min</span>
                </span>
            </button>
            </div>
            <div id="chapterThree" class="accordion-collapse collapse" data-bs-parent="#courseContent">
            <div class="accordion-body py-4">
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck-01" />
                <label for="defCheck-01" class="form-check-label ms-4">
                    <span class="mb-0 h6">1. Section & Div Block</span>
                    <small class="text-body d-block">8:31 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck-02" />
                <label for="defCheck-02" class="form-check-label ms-4">
                    <span class="mb-0 h6">2. Read-Only Version of Chat App</span>
                    <small class="text-body d-block">8 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck-03" />
                <label for="defCheck-03" class="form-check-label ms-4">
                    <span class="mb-0 h6">3. Webflow Autosave</span>
                    <small class="text-body d-block">2.9 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck-04" />
                <label for="defCheck-04" class="form-check-label ms-4">
                    <span class="mb-0 h6">4. Canvas Settings</span>
                    <small class="text-body d-block">7.6 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck-05" />
                <label for="defCheck-05" class="form-check-label ms-4">
                    <span class="mb-0 h6">5. HTML Tags</span>
                    <small class="text-body d-block">10 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-0">
                <input class="form-check-input" type="checkbox" id="defCheck-06" />
                <label for="defCheck-06" class="form-check-label ms-4">
                    <span class="mb-0 h6">6. Footer (Chat App)</span>
                    <small class="text-body d-block">9.10 min</small>
                </label>
                </div>

            </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-header" id="headingFour">
            <button type="button" class=" accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterFour" aria-expanded="false" aria-controls="chapterFour">
                <span class="d-flex flex-column">
                <span class="h5 mb-0">Final Project</span>
                <span class="text-body fw-normal">2 / 3 | 4.4 min</span>
                </span>
            </button>
            </div>
            <div id="chapterFour" class="accordion-collapse collapse" data-bs-parent="#courseContent">
            <div class="accordion-body py-4">
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck-101" checked="" />
                <label for="defCheck-101" class="form-check-label ms-4">
                    <span class="mb-0 h6">1. Responsive Blog Site</span>
                    <small class="text-body d-block">10:0 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-4">
                <input class="form-check-input" type="checkbox" id="defCheck-102" checked="" />
                <label for="defCheck-102" class="form-check-label ms-4">
                    <span class="mb-0 h6">2. Responsive Portfolio</span>
                    <small class="text-body d-block">13:00 min</small>
                </label>
                </div>
                <div class="form-check d-flex align-items-center gap-1 mb-0">
                <input class="form-check-input" type="checkbox" id="defCheck-103" />
                <label for="defCheck-103" class="form-check-label ms-4">
                    <span class="mb-0 h6">3. Responsive eCommerce Website</span>
                    <small class="text-body d-block">15 min</small>
                </label>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Popular Instructors -->
    <div class="col-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                <h5 class="m-0 me-2">Popular Instructors</h5>
                </div>
            <div class="dropdown">
              <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="popularInstructors" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-dots-vertical ti-md text-muted"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularInstructors">
                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
              </div>
            </div>
          </div>
          <div class="px-5 py-4 border border-start-0 border-end-0">
            <div class="d-flex justify-content-between align-items-center">
              <p class="mb-0 text-uppercase">Instructors</p>
              <p class="mb-0 text-uppercase">courses</p>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-6">
              <div class="d-flex align-items-center">
                <div class="avatar avatar me-4">
                  <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle" />
                </div>
                <div>
                  <div>
                    <h6 class="mb-0 text-truncate">Maven Analytics</h6>
                    <small class="text-truncate text-body">Business Intelligence</small>
                  </div>
                </div>
              </div>
              <div class="text-end">
                <h6 class="mb-0">33</h6>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-6">
              <div class="d-flex align-items-center">
                <div class="avatar avatar me-4">
                  <img src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle" />
                </div>
                <div>
                  <div>
                    <h6 class="mb-0 text-truncate">Bentlee Emblin</h6>
                    <small class="text-truncate text-body">Digital Marketing</small>
                  </div>
                </div>
              </div>
              <div class="text-end">
                <h6 class="mb-0">52</h6>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-6">
              <div class="d-flex align-items-center">
                <div class="avatar avatar me-4">
                  <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle" />
                </div>
                <div>
                  <div>
                    <h6 class="mb-0 text-truncate">Benedetto Rossiter</h6>
                    <small class="text-truncate text-body">UI/UX Design</small>
                  </div>
                </div>
              </div>
              <div class="text-end">
                <h6 class="mb-0">12</h6>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <div class="avatar avatar me-4">
                  <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle" />
                </div>
                <div>
                  <div>
                    <h6 class="mb-0 text-truncate">Alma Gonzalez</h6>
                    <small class="text-truncate text-body">Java Developer</small>
                  </div>
                </div>
              </div>
              <div class="text-end">
                <h6 class="mb-0">8</h6>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!--/ Popular Instructors -->
    </div>

@endsection
