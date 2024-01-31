<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

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

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
               
                <input type="hidden" name="product_id" id="product_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Operator</label>
                    <div class="col-sm-12">
                        <select id="operatorDropdown">
                            <option value="=">=</option>
                            <option value=">">></option>
                            <option value=">=">>=</option>
                            <option value="<"><</option>
                            <option value="<="><=</option>
                            <option value="!=">!=</option>
                            <option value="LIKE">LIKE</option>
                            <option value="LIKE %...%">LIKE %...%</option>
                            <option value="NOT LIKE">NOT LIKE</option>
                            <option value="NOT LIKE %...%">NOT LIKE %...%</option>
                            <option value="IN(...)">IN</option>
                            <option value="NOT IN(...)">NOT IN</option>
                            <option value="BETWEEN">BETWEEN</option>
                            <option value="NOT BETWEEN">NOT BETWEEN</option>
                            <option value="IN(...)">IS NULL</option>
                            <option value="S NOT NULL">IS NOT NULL</option>
                        </select>
                    </div>
                </div>
    
                <div class="form-group">
                    <label class="col-sm-2 control-label">Value</label>
                    <div class="col-sm-12">
                    <input type="text" class="form-control" id="value" name="value" placeholder="Enter Value" value="" maxlength="50" required>
                    </div>
                </div>
    
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>
</div>

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
            } else {
                $('#ajaxModel').modal('show');
                var ifActive = $('.where_column').hasClass('active');
                var ifRowActive = $('#' + value).hasClass('active');
                console.log(ifRowActive);
                //On Modal Save Take operator and value
                $('#saveBtn').on('click', function () {
                    var operator = $('#operatorDropdown').val();
                    var searchValue = $('#value').val();
                    if (searchValue == '') {
                        alert('Please enter Value');
                    }
                    else{
                        if (ifRowActive) {
                            console.log('active');
                            $("#" + value).removeClass();
                            $('#' + value).addClass('where_column inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150');
                        } else {
                            if (ifActive) {
                                $('#inputQuery').val(query + ' AND ' + columnId + ' ' + operator + ' ' + searchValue + ' ');
                            } else {
                                $('#inputQuery').val(query + ' WHERE ' + columnId + ' ' + operator + ' ' + searchValue + ' ');
                            }
                            $("#" + value).removeClass();
                            $('#' + value).addClass('where_column active inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150');
                        }
                        // Close the modal after processing
                        $('#ajaxModel').modal('hide');
                    }
                    
                });
            }
        });
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