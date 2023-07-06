<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.admin_side_bar activePage="tables"></x-navbars.admin_side_bar>
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
                                                Response</th>
                                            
                                                
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
                                             <select>
                                                 @foreach($assignment->users as $user)
                                                     <option>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                 @endforeach
                                             </select>
                                         </td>
                                      </tr>
                                     @endforeach
                                    </tbody>
                            </table>

                       </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>