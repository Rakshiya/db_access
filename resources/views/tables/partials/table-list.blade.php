<section>
    <header>
        <!-- <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('All users Information') }}
        </h2> -->
    </header>
    <div >
        <table class="border-collapse border border-slate-400">
            <thead>
                <tr>
                    <th class="border border-slate-300 p-2 ">Sr No</th>
                    <th class="border border-slate-300 p-2 ">Table Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tableList as $key => $tableName)
                <tr>
                    <td class="border border-slate-300 p-2 ">{{ $key+1 }}</td>
                    <td class="border border-slate-300 p-2 "><a href="{{ url('/table/'.base64_encode($tableName)) }}">{{ $tableName }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>