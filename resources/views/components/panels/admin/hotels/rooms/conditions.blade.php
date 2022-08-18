<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="conditions_link" class="btn btn-link" data-bs-toggle="collapse" href="#conditions_collapse" aria-expanded="true">شروط قیمتی</a>
        </div>

        <div class="card-toolbar">
            <a id="conditionsAddRow" class="btn btn-sm btn-primary">افزودن</a>
        </div>
    </div>
    <!--end::Card header-->


    <!--begin::Card body-->
    <div class="card-body collapse show" id="conditions_collapse">
        
    <table class="table table-hover table-rounded border">
            <thead class="table-light">
                <tr class="text-center">
                    <th class="col-5">عنوان</th>
                    <th class="col-2">پاسخ کاربر</th>
                    <th class="col-2">مقدار تغییر</th>
                    <th class="col-2">نوع تغییر</th>
                    <th class="col-1"></th>
                </tr>
            </thead>
    </table>
        <!--begin::Row-->
        <div id="conditions" class="row mb-8">

            @if(isset($room) && isset($room->conditions))
                @foreach($room->conditions as $condition)
                    <div class="row mt-2">
                        <div class="col-5">
                            <input name="conditions[titles][]" type="text" class="form-control" value="{{ $condition['title'] }}"/>
                        </div>
                        <div class="col-2">
                            <select name="conditions[answers][]" class="form-select">
                                <option selected disabled>انتخاب کنید ...</option>
                                <option @selected($condition['answer'] == 1) value="1">بله</option>
                                <option @selected($condition['answer'] == 0) value="0">خیر</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input name="conditions[values][]" type="text" class="form-control text-center" value="{{ $condition['value'] }}"/>
                        </div>
                        <div class="col-2">
                            <select name="conditions[changes][]" class="form-select">
                                <option selected disabled>انتخاب کنید ...</option>
                                <option @selected($condition['change'] == "==") value="==">ریال شود</option>
                                <option @selected($condition['change'] == "+%") value="+%">درصد افزایش یابد</option>
                                <option @selected($condition['change'] == "-%") value="-%">درصد کاهش یابد</option>
                                <option @selected($condition['change'] == "++") value="++">ریال افزایش یابد</option>
                                <option @selected($condition['change'] == "--") value="--">ریال کاهش یابد</option>
                            </select>
                        </div>
                        <div class="col-1">
                            <a class="btn btn-sm btn-danger conditionsRemoveRow">حذف</a>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        <!--end::Row-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->


@push('scripts')

    <script>
        function addRows(){ 
            var table = document.getElementById('table');
            var rowCount = table.rows.length;
            var cellCount = table.rows[0].cells.length; 
            var row = table.insertRow(rowCount);
            for(var i =0; i <= cellCount; i++){
                var cell = 'cell'+i;
                cell = row.insertCell(i);
                var copycel = document.getElementById('col'+i).innerHTML;
                cell.innerHTML=copycel;
            }
        }

        function deleteRows(x){
            var table = document.getElementById('table');
            var rowIndex = x.closest('tr').rowIndex;
            if (confirm("آیا از حذف مطمئن هستید؟")) {
                if(1){
                    var row = table.deleteRow(rowIndex);
                }
                else{
                    alert('ردیف یک قابل حذف نیست');
                }
            }
        }
    </script>

@endpush