<section>
    <header>
        <!-- <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('All users Information') }}
        </h2> -->
    </header>
    <div>
        <table class="border-collapse border border-slate-400">
            <thead>
                <tr>
                    <th class="border border-slate-300 p-2 ">Sr No</th>
                    <th class="border border-slate-300 p-2 ">First Name</th>
                    <th class="border border-slate-300 p-2 ">Last Name</th>
                    <th class="border border-slate-300 p-2 ">Email</th>
                    <th class="border border-slate-300 p-2 ">Phone</th>
                    <th class="border border-slate-300 p-2 ">User Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userList as $key => $user)
                <tr>
                    <td class="border border-slate-300 p-2 ">{{ $key+1 }}</td>
                    <td class="border border-slate-300 p-2 ">{{ $user['first_name'] }}</td>
                    <td class="border border-slate-300 p-2 ">{{ $user['last_name'] }}</td>
                    <td class="border border-slate-300 p-2 ">{{ $user['email'] }}</td>
                    <td class="border border-slate-300 p-2 ">{{ $user['phone_no'] }}</td>
                    <td class="border border-slate-300 p-2 ">{{ $user['role']['role_name'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>