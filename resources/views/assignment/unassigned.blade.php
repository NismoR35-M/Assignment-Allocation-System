<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.admin_side_bar activePage="tables"></x-navbars.admin_side_bar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <!-- Include Flatpickr styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">

        <!-- Main content -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Unassigned Assignments</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <!-- Your custom content for unassigned assignments -->
                            <style> 
                                input[type=text],
                                input.date-input,
                                textarea {
                                 
                                  width: 100%;
                                  padding: 12px 20px;
                                  margin: 8px 0;
                                  box-sizing: border-box;
                                  /* border: 2px solid purple; */
                                  border-radius: 4px;
                                  background-color:rgb(241, 241, 241);
                                  
                                }

                                input[type='text']:hover{
                                    background-color:rgba(255, 166, 0, 0.208)
                                }

                                body {
                                 
                                 margin-left: 2px;
                                 }
                                 form {
                                  margin-left:12px;
                                  margin-inline-end: 12px;
                                }
                                </style>
                                {{--Assignment table  --}}
                                <div class="center">
                                    <!-- Your custom content for assigned assignments -->
                                    @if ($unassignedAssignments->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Organization Name</th>
                                                    <th>Request Type</th>
                                                    <th>Description</th>
                                                    <th>Attachment</th>
                                                    <th>Date Request Received</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($unassignedAssignments->where('status', 'Unassigned') as $assignment)
                                                    <tr>
                                                        <td>{{ $assignment->company_name }}</td>
                                                        <td>{{ $assignment->request_type }}</td>
                                                        <td>{{ $assignment->description }}</td>
                                                        <td>
                                                            @if($assignment->request)
                                                                <a href="{{ asset('storage/' . $assignment->request) }}" class="btn btn-primary" target="_blank">View Attachment</a>
                                                            @else
                                                                No attachment
                                                            @endif
                                                        </td>
                                                        <td>{{ $assignment->start_date }}</td>
                                                       
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <p>No assigned assignments found.</p>
                                    @endif
                                </div>
                            </a>
                            <div class="flex">
                                <a href="{{ route('show_assignments') }}">
                                    <button type="button" class="btn bg-gradient-dark">Back</button>
                                 </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
