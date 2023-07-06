<!-- Your HTML form -->
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.admin_side_bar activePage="tables"></x-navbars.admin_side_bar>
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
                                    <form action="{{ route('assign_assignment') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <tr>
                                        <td>
                                        <label for="name">Name:</label>
                                        <input type="text" id="name" name="name" required>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td>
                                        <label for="company_name">Company Name:</label>
                                        <input type="text" id="company_name" name="company_name" required>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td>
                                        <label for="request_type">Request Type:</label>
                                        <input type="text" id="request_type" name="request_type" required>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td>
                                        <label for="description">Description:</label>
                                        <textarea id="description" name="description" required></textarea>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td>
                                        <label for="start_date">Date Received:</label>
                                        <input type="status_date" id="start_date" name="start_date" required>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td>
                                        <label for="status">Status:</label>
                                        <select id="status" name="status" required>
                                            <option value="assigned">Assigned</option>
                                            <option value="not_assigned">Not Assigned</option>
                                        </select>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td>
                                        <label for="request_file">Request File:</label>
                                        <input type="file" id="request_file" name="request_file">
                                        </td>
                                        </tr>

                                        <tr>
                                        <td>
                                        <label for="users_id">Members Assigned:</label>
                                        {{-- <!-- @foreach ($users as $user)
                                            <div>
                                                <input type="checkbox" id="useer_{{ $user->id }}" name="users_assigned[]" value="{{ $user->id }}">
                                                <label for="member_{{ $user->id }}">{{ $user->name }}</label>
                                            </div>
                                        @endforeach --> --}}


                                        <td>
                                        <label for="response">Response:</label>
                                        <textarea id="response" name="response"></textarea>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td>
                                        <label for="response_file">Response File:</label>
                                        <input type="file" id="response_file" name="response_file">
                                        </td>
                                        </tr>


                                        <button type="submit">Create Assignment</button>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </main>
</x-layout>
