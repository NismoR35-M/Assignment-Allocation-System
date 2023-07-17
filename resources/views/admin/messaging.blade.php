<!-- user_messages.blade.php -->

<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.admin_side_bar activePage="assignments"></x-navbars.admin_side_bar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Messages"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="message-container">
                                <div class="user-messages">
                                    <!-- Display user messages -->
                                    @foreach($userMessages as $message)
                                        <div class="message user-message">
                                            {{ $message->message }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="admin-messages">
                                    <!-- Display admin messages -->
                                    @foreach($adminMessages as $message)
                                        <div class="message admin-message">
                                            {{ $message->message }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <form action="{{ route('assignments.replyMessage', $assignment->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="message" placeholder="Type a message">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
