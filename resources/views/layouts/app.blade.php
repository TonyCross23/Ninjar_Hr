<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

   

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet"/>

    {{-- Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">

    {{-- daterangepicker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.3/viewer.css" integrity="sha512-0IJ01kDH6fR7Oo1QEcyF+PgSLpefYXuGICVfNNoOseW6+HmsoaHzSZ7BAnwuu6BoK+nSn9WOeh0kiNjPNtGpuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
@yield('extra_css')
    
</head>

<body>

    <div class="page-wrapper chiller-theme ">
        <nav id="sidebar" class="sidebar-wrapper">
          <div class="sidebar-content">
            <div class="sidebar-brand">
              <a href="#">NinjaHR</a>
              <div id="close-sidebar">
                <i class="fas fa-times"></i>
              </div>
            </div>
            <div class="sidebar-header">
              <div class="user-pic">
                <img class="img-responsive img-rounded" src="{{ auth()->user()->profile_img_path() }}"
                  alt="">
              </div>
              <div class="user-info">
                <span class="user-name">
                  <strong>{{ Auth::user()->name }}</strong>
                </span>
                <span class="user-status">
                  
                  <span>{{ auth()->user()->department ? auth()->user()->department->title : 'No Department' }}</span>
                </span>
                <span class="user-status">
                  <i class="fa fa-circle"></i>
                  <span>Online</span>
                </span>
              </div>
            </div>
            <!-- sidebar-header  -->
            <div class="sidebar-menu">
              <ul>
                <li class="header-menu">
                  <span>Menu</span>
                </li>

                @can('View_Profile')
                  <li>
                    <a href="#">
                      <i class="fa fa-home"></i>
                      <span>Home</span>
                    </a>
                  </li>
                @endcan

                @can('View_Company_Setting')
                <li>
                  <a href="{{ route('company-setting.show', 1) }}">
                    <i class="fa-solid fa-building"></i>
                    <span>Company Setting</span>
                  </a>
                </li>
                @endcan


                @can('View_Employee')
                <li>
                  <a href="{{ route('employee.index') }}">
                    <i class="fa fa-users"></i>
                    <span>Employees</span>
                  </a>
                </li>
                @endcan

                @can('View_Salary')
                <li>
                  <a href="{{ route('salary.index') }}">
                    <i class="fas fa-money-bill"></i>
                    <span>Salary</span>
                  </a>
                </li>
                @endcan


                @can('View_Department')
                <li>
                  <a href="{{ route('department.index') }}">
                    <i class="fa fa-sitemap"></i>
                    <span>Department</span>
                  </a>
                </li>
                @endcan

                @can('view_project')
                <li>
                    <a href="{{route('project.index')}}">
                        <i class="fas fa-toolbox"></i>
                        <span>Project</span>
                    </a>
                </li>
                @endcan

                @can('View_Role')
                  
                <li>
                  <a href="{{ route('role.index') }}">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>Role</span>
                  </a>
                </li>
                @endcan

                @can('View_Permission')
                <li>
                  <a href="{{ route('permission.index') }}">
                    <i class="fa-solid fa-shield"></i>
                    <span>Permission</span>
                  </a>
                </li>
                @endcan

                @can('View_Attendance')
                <li>
                  <a href="{{ route('attendance.index') }}">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Attendance (Employee)</span>
                  </a>
                </li>
                @endcan

                @can('View_Attendance_Over')
                <li>
                  <a href="{{ route('attendance.overview') }}">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Attendance (Over View)</span>
                  </a>
                </li>
                @endcan
             
                @can('view_payroll')
                <li>
                    <a href="{{route('payroll')}}">
                        <i class="fas fa-money-check"></i>
                        <span>Payroll</span>
                    </a>
                </li>
                @endcan

                {{-- <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Maps</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="#">Google maps</a>
                      </li>
                      <li>
                        <a href="#">Open street map</a>
                      </li>
                    </ul>
                  </div>
                </li>
               --}}

              </ul>
            </div>
            <!-- sidebar-menu  -->
          </div>
          <!-- sidebar-content  -->
        </nav>
        <!-- sidebar-wrapper  -->
            <div class="app-bar">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8 ">
                        <div class="d-flex justify-content-around align-items-sm-center">
                            @if ( request()->is('/'))
                              <a href="#" id="show-sidebar" ><i class="fas fa-bars "></i></a>
                            @else
                              <a href="#" id="back-btn" onclick="history.back()"> <i class="fas fa-chevron-left "></i></a>
                              @endif
                            <h5 class="ms-4 me-4">@yield('title')</h5>
                            <a href=""></a>
                        </div>
                    </div>
                </div>
            </div>

      <div class="py-4 ">
              <div class="container">
                @yield('content')
              </div>
       </div>




      <div class="bottom-menu">
          <div class="row d-flex justify-content-center">
              <div class="col-md-8">
                  <div class="d-flex justify-content-between">
                      <a href="{{ route('home') }}">
                          <i class="fa fa-home"></i>
                          <p class="mb-0">Home</p>
                      </a>

                      <a href="{{ route('attendance.scan') }}">
                        <i class="fa-solid fa-user-clock"></i>
                          <p class="mb-0">Attendance</p>
                      </a>

                      <a href="{{ route('my-project.index') }}">
                        <i class="fa-solid fa-briefcase"></i>
                          <p class="mb-0">Project</p>
                      </a>

                      <a href="{{ route('profile.prfile') }}">
                          <i class="fa fa-user"></i>
                          <p class="mb-0">Profile</p>
                      </a>
                  </div>
              </div>
          </div>
      </div>

  </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>

    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    {{-- daterangepicker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>


    {{-- Datatable --}}
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/responsive/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/js/jquery.dataTables.min.js">
    </script>

    {{-- select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- sweet alert 2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- sweet alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.3/viewer.min.js" integrity="sha512-f8kZwYACKF8unHuRV7j/5ILZfflRncxHp1f6y/PKuuRpCVgpORNZMne1jrghNzTVlXabUXIg1iJ5PvhuAaau6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
      const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
        
    $(function($) {

          let token = document.head.querySelector('meta[name="csrf-token"]');

            if(token){
              $.ajaxSetup({
                  headers : {
                    'X-CSRF-TOKEN'  : token.content
                  }
                })
            };

            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(200);
                if (
                    $(this).parent().hasClass("active")
                ) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this).parent().removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                          $(this).next(".sidebar-submenu").slideDown(200);
                          $(this).parent().addClass("active");
                }
            });

            $("#close-sidebar").click(function(e) {
                e.preventDefault();
                $(".page-wrapper").removeClass("toggled");
            });
            $("#show-sidebar").click(function(e) {
                e.preventDefault();
                $(".page-wrapper").addClass("toggled");
            });

            @if (request()->is('/'))
              document.addEventListener('click' , function(event){
                  if(document.getElementById('show-sidebar').contains(event.target)){
                    $(".page-wrapper").addClass("toggled");
                  } else if (!document.getElementById('sidebar').contains(event.target)){
                    $(".page-wrapper").removeClass("toggled");
                  }
              });
            @endif

            @if (session('create'))
                 Swal.fire({
                    title: 'Successfully Create',
                    text: "{{ session('create') }}",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                 });
            @endif

            @if (session('update'))
                 Swal.fire({
                    title: 'Successfully Update',
                    text: "{{ session('create') }}",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                 });
            @endif

            @if (session('update'))
           

                Toast.fire({
                  icon: 'success',
                  title: 'Update successfully'
                })
            @endif

            @if (session('create'))
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

                Toast.fire({
                  icon: 'success',
                  title: 'Create successfully'
                })
            @endif

            $.extend(true, $.fn.dataTable.defaults, {
              scrollCollapse: true,
              paging: true,
              paginate:true,
                mark: true,
                  pagingType: 'simple_numbers',
                pageLength : 5,
                "language": {
                    "paginate": {
                          "previous": "<i class='fas fa-arrow-left'></i>",
                          "next": "<i class='fas fa-arrow-right'></i>"
                    },
                    "processing": "<p class='my-2'>Loading...</p>",
                },

                columnDefs: [
            {
                "targets": 'hidden',
                "visible": false,
              
            },
            {
                "targets": 0,
                "class" : "control",
                "orderable" :false
            },
            {
                "targets": 'no-sort',
                "orderable" : false
              
            },
            {
                "targets": 'no-search',
                "searchable" : false
              
            },
        ],

            });

            
            $('.select-item').select2({
                placeholder: '-- Please Choose --',
                allowClear: true,
            });
        });
    </script>

@yield('script')

</body>

</html>
