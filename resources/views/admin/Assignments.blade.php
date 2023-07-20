<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.admin_side_bar activePage="tables"></x-navbars.admin_side_bar>
        {{-- <!-- CSS -->   
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- JavaScript -->
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Assignments"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Assignments table</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Company Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                Members Assigned</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                View Details</th>
                                            
                                                
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach ($assignments as $assignment)
                                      <tr>
                                         <td>{{$assignment->id}}</td>
                                         <td>{{ $assignment->name }}</td>
                                         <td>{{ $assignment->company_name }}</td>
                                         <td>{{ $assignment->status }}</td>
                                         <td>
                                            @if($assignment->status === 'Assigned')
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="assignmentUsersDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select User
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="assignmentUsersDropdown">
                                                        @foreach($assignment->users as $user)
                                                            <button class="dropdown-item" type="button">{{ $user->first_name }} {{ $user->last_name }}</button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        {{-- <td><a href="{{ route('view_assignment')
                                        }}" class="btn btn-primary"> Details</button></td>
                                     </tr> --}}
                                         <td>
                                            <a href="{{ route('view_assignment', ['id' => $assignment->id]) }}"
                                            class="btn btn-primary"> View Assignment</a> 
                                        </td>
                                      </tr>
                                     @endforeach
                                    </tbody>
                            </table>
                               <div class="card-footer">
                                    <a href="{{ route('assigned_assignments') }}" class="btn btn-primary">Assigned</a>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('unassigned_assignments') }}" class="btn btn-primary">Un Assigned</a>
                                </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
                                    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                                        return new bootstrap.Dropdown(dropdownToggleEl);
                                    });
                                });
                            </script>                            
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>