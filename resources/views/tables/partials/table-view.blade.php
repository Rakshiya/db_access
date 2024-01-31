<section>
    <header>
        <div class="flex justify-between spacing-2">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Perform table operations here.') }}
            </h2>
            <div class="px-2"><x-primary-button id="clear">{{ __('Clear Operations') }}</x-primary-button></div>
        </div>
    </header>
    <div class="py-4">
        <div class="flex space-between spacing-2">
            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">Query Type -</h4>
            <div class="px-2"><x-secondary-button id="select" class="" active="">{{ __('Select') }}</x-secondary-button></div>
            <div class="px-2"><x-secondary-button id="update">{{ __('Update') }}</x-secondary-button></div>
            <div class="px-2"><x-secondary-button id="delete">{{ __('Delete') }}</x-secondary-button></div>
            <div class="px-2"><x-secondary-button id="select">{{ __('Insert') }}</x-secondary-button></div>
            <div class="px-2"><x-secondary-button id="select">{{ __('Create') }}</x-secondary-button></div>
        </div>
    </div>
    <div class="py-4">
        <div class="flex space-between spacing-2 wrap">
            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">Where Coulumn -</h4>
            <div class="px-2">
                @foreach($columnArray as $column)
                    <x-secondary-button class="py-2" id="where_{{$column}}" class="where_column">{{ $column }}</x-secondary-button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="flex space-between spacing-2 wrap">
            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">Group By -</h4>
            <div class="px-2">
                @foreach($columnArray as $column)
                    <x-secondary-button class="py-2" id="group_{{$column}}" class="group_column">{{ $column }}</x-secondary-button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="flex space-between spacing-2 wrap">
            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">Order By -</h4>
            <div class="px-2">
                @foreach($columnArray as $column)
                    <x-secondary-button class="py-2" id="order_{{$column}}" class="order_column">{{ $column }}</x-secondary-button>
                @endforeach
            </div>
        </div>
    </div>
    <form method="post" action="#" class="mt-6 space-y-6">
        <div>
            <x-input-label for="inputQuery" :value="__('Review Input Query')" />
            <x-text-input id="inputQuery" name="inputQuery" type="text" class="w-full" disabled />
        </div>
        <x-primary-button>{{ __('Submit') }}</x-primary-button>
    </form>
</section>

<script >
    $(document).ready(function() {
        var tableName = "{{$tableName}}";
        $(document).on('click', '#select', function (e) {
            $('#inputQuery').val('SELECT * FROM '+tableName);
        })
        $(document).on('click', '#update', function (e) {
            $('#inputQuery').val('UPDATE '+tableName+' SET ');
        })
        $(document).on('click', '#clear', function (e) {
            $('#inputQuery').val('');
        })

        /** Where clause conditions */
        $(document).on('click', '.where_column', function (e) {
            var value = e.target.id;
            var columnId = value.slice(6);
            var query = $('#inputQuery').val();
            if(query == ''){
                alert('Please select Query Type first.');
            }else{
                var ifActive = $('.where_column').hasClass('active');
                var ifRowActive = $('#'+value).hasClass('active');
                console.log(ifRowActive);
                if(ifRowActive){
                    console.log('active');
                    $("#"+value).removeClass();
                    $('#'+value).addClass('where_column inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150');
                }else{
                    if(ifActive){
                        $('#inputQuery').val(query +' AND '+columnId+' = ');
                    }else{
                        $('#inputQuery').val(query +' WHERE '+columnId+' = ');
                    }
                    $("#"+value).removeClass();
                    $('#'+value).addClass('where_column active inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150');
                }
            }
        })
        /** Where clause conditions ends*/

        /** group by clause conditions */
        $(document).on('click', '.group_column', function (e) {
            var value = e.target.id;
            var columnId = value.slice(6);
            console.log(columnId);

            var query = $('#inputQuery').val();
            if(query == ''){
                alert('Please select Query Type first.');
            }else{
                var ifActive = $('.group_column').hasClass('active');
                if(ifActive){
                    $('#inputQuery').val(query +','+columnId);
                }else{
                    $('#inputQuery').val(query +' GROUP BY '+columnId);   
                }                
                $('#'+value).addClass('active');

            }
        })
        /** group by clause conditions ends*/

    })
</script>