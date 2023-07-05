<!-- Your HTML form -->
<form action="{{ route('assign_assignment') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="company_name">Company Name:</label>
    <input type="text" id="company_name" name="company_name" required>

    <label for="request_type">Request Type:</label>
    <input type="text" id="request_type" name="request_type" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>

    <label for="start_date">Date Received:</label>
    <input type="status_date" id="start_date" name="start_date" required>

    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="assigned">Assigned</option>
        <option value="not_assigned">Not Assigned</option>
    </select>

    <label for="request_file">Request File:</label>
    <input type="file" id="request_file" name="request_file">

    <label for="users_id">Members Assigned:</label>
    <!-- @foreach ($users as $user)
        <div>
            <input type="checkbox" id="useer_{{ $user->id }}" name="users_assigned[]" value="{{ $user->id }}">
            <label for="member_{{ $user->id }}">{{ $user->name }}</label>
        </div>
    @endforeach -->

    <label for="response">Response:</label>
    <textarea id="response" name="response"></textarea>

    <label for="response_file">Response File:</label>
    <input type="file" id="response_file" name="response_file">


    <button type="submit">Submit</button>
</form>
