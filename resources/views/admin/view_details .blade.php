<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.admin_side_bar activePage="tables"></x-navbars.admin_side_bar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Project</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0" style="overflow-x: auto;">
                                <table class="table table-bordered align-items-center justify-content-center mb-0">
                                    <tr class="bg-color-1">
                                        <th>Id</th>
                                        <td>{{ $assignment->id }}</td>
                                    </tr>
                                    <tr class="bg-color-2">
                                        <th>Name</th>
                                        <td>{{ $assignment->name }}</td>
                                    </tr>
                                    <tr class="bg-color-1">
                                        <th>Company Name</th>
                                        <td>{{ $assignment->company_name }}</td>
                                    </tr>
                                    <tr class="bg-color-2">
                                        <th>Type</th>
                                        <td>{{ $assignment->request_type }}</td>
                                    </tr>
                                    <tr class="bg-color-1">
                                        <th>Description</th>
                                        <td>{{ $assignment->description }}</td>
                                    </tr>

                                                                    <tr class="bg-color-1">
                                        <th>Request</th>
                                        <td>
                                        @if ($assignment->request)
                                            <a href="{{ asset('storage/'. $assignment->request) }}" target="_blank" class="btn btn-primary">View Request Attached</a>
                                        @else
                                            <span class="text-muted">No PDF attached</span>
                                        @endif
                                    </td>

                                    </tr>
                                    <tr class="bg-color-1">
                                    <th>Members Assigned</th>
                                    <td>
                                        <div class="dropdown">
                                         <button class="btn btn-secondary dropdown-toggle" type="button" id="membersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                          Show Members Assigned
                                          </button>
                                            <ul class="dropdown-menu" aria-labelledby="membersDropdown">
                                               @foreach ($assignment->users as $user)
                                                  <li><a class="dropdown-item" href="#">{{ $user->first_name }}</a></li>
                                               @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                   </tr>

                                   <tr class="bg-color-1">

                                    <tr class="bg-color-2">
                                        <th>Date Received</th>
                                        <td>{{ $assignment->start_date }}</td>
                                    </tr>
                                    <tr class="bg-color-1">
                                        <th>Response</th>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#responseModal">View Response</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                        <a href="#" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.Assignments') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

     <!-- Response Modal -->
     <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Response</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ $assignment->response }}</p>
                    @if ($assignment->response_file)
                        <a href="{{ asset('storage/'. $assignment->response_file) }}" target="_blank" class="btn btn-primary">View Attached File</a>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <style>
        .bg-color-1 {
            background-color: rgb(12, 121, 157); /* Add your desired background color for odd rows */
        }

        .bg-color-2 {
            background-color: #187cdf; /* Add your desired background color for even rows */
        }
    </style>
</x-layout>