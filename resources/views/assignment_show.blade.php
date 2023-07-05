<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
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
                            <div class="table-responsive p-0" style="overflow-x: auto;" >
                                <table class="table table-bordered  align-items-center justify-content-center mb-0">
                                    
                                    {{-- <tr>
                                        <th>Id</th>
                                        <td>{{ $assignment->id }}</td>
                                    </tr> --}}

                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $assignment->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Organaisation Assigning </th>
                                        <td>{{ $assignment->company_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>{{ $assignment->request_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $assignment->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date Assigned</th>
                                        <td>{{ $assignment->start_date }}</td>
                                    </tr>
                                        
                                    <tr>
                                    <th>Request Letter</th>
                                        <td>
                                            @if ($assignment->request)
                                                <a href="{{ asset('storage/' . $assignment->request) }}" target="_blank">{{ $assignment->request }}</a>
                                            @endif
                                            <input type="file" name="request_file">
                                        </td>
                                    </tr>
                                   


                                    <tr>        
                                        <th> Response </th>
                                        <td>                               
                                        <form action="/response.php">
                                            <label for="response">Response :</label>
                                            <input type="text" id="response" name="response"><br><br>
                                            <input type="submit" value="Submit">
                                        </form>
                                        </td>
                                    </tr>
                                        <th>Status</th>
                                        <td>
                                            <form action="{{ route('update.status', ['id' => $assignment->id, 'status' => $assignment->status]) }}" method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <select name="status" class="form-select" onchange="this.form.submit()">
                                                    <option value="InProgress" {{ $assignment->status === 'InProgress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="Completed" {{ $assignment->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr> 
                                        <th> Members Assigned </th>
                                        <td> 
                                            @foreach ($assignment->$users as $user)
                                                {{ $user->id }}
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </main>
</x-layout>