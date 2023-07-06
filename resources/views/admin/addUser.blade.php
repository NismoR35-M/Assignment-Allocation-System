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
                                    <h2>Create</h2>
                                <form action="{{ route('admin.users.save') }}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" required>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" required>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="staff_number">Staff Number</label>
                                        <input type="text" name="staff_number" id="staff_number" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Password</label>
                                        <input type="text" name="email" id="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="text" name="password" id="password" required>
                                    </div>

                                    <button type="button" class="btn btn-dark">Create User</button>
                            </form>   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>