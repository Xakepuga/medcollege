<th scope="col" class="text-center align-middle custom-st-min-width-75">№</th>
<th scope="col" class="text-center align-middle custom-st-min-width-75">Дело,&nbsp;№</th>
<th scope="col" class="text-center align-middle custom-st-min-width-75">Фамилия</th>
<th scope="col" class="text-center align-middle custom-st-min-width-75">Имя</th>
<th scope="col" class="text-center align-middle custom-st-min-width-75">Отчество</th>
@if($students->isNotEmpty())
    @include('reports.universal-report.table-blocks.thead.passport')
    <th scope="col" class="text-center align-middle custom-st-min-width-175">СНИЛС</th>
    <th scope="col" class="text-center align-middle custom-st-min-width-325" >Зачислен на специальность</th>
    @if(request()->input('report') !== 'accounting')
        <th scope="col" class="text-center align-middle custom-st-min-width-75">Ср.балл</th>
        <th scope="col" class="text-center align-middle custom-st-min-width-75">Бюджет</th>
        <th scope="col" class="text-center align-middle custom-st-min-width-75">Внебюджет</th>
        <th scope="col" class="text-center align-middle custom-st-min-width-75">Инвалидность</th>
        <th scope="col" class="text-center align-middle custom-st-min-width-75">Общежитие</th>
        @include('reports.universal-report.table-blocks.thead.' . request()->input('report'))
    @else
        @include('reports.universal-report.table-blocks.thead.accounting')
    @endif
@endif
