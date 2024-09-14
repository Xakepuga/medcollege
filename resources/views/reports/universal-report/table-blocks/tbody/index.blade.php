<td class="text-center align-content-center">
    {{ ($students->perPage() * ($students->currentPage() - 1)) + $loop->iteration }}
</td>
<td class="text-center align-content-center">
    <a href="{{ route('personal-files.manage.personal-file.show', $student->id) }}">{{ $student->id }}</a>
</td>
<td class="text-center align-content-center">{{ $student->surname }}</td>
<td class="text-center align-content-center">{{ $student->name }}</td>
<td class="text-center align-content-center">{!! $student->patronymic ?? '&mdash;' !!}</td>
@if($students->isNotEmpty())
    @include('reports.universal-report.table-blocks.tbody.passport')
    <td class="text-center align-content-center">{!! $student->pensionInsurance->number ?? '&mdash;' !!}</td>
    <td class="text-center align-content-center">{!! $student->enrollment->faculty->name ?? '&mdash;' !!}</td>
    @if(request()->input('report') !== 'accounting')
        <td class="text-center align-content-center">{{ $student->educational->avg_rating }}</td>
        <td class="text-center align-content-center">{{ $student->enrollment->is_budget ? 'Да' : 'Нет' }}</td>
        <td class="text-center align-content-center">{{ $student->enrollment->is_budget || is_null($student->enrollment->faculty_id) ? 'Нет' : 'Да' }}</td>
        <td class="text-center align-content-center">{{ $student->specialCircumstances[1]->pivot->status ? 'Да' : 'Нет' }}</td>
        <td class="text-center align-content-center">{{ $student->specialCircumstances[2]->pivot->status ? 'Да' : 'Нет' }}</td>
        @include('reports.universal-report.table-blocks.tbody.' . request()->input('report'))
    @else
        @include('reports.universal-report.table-blocks.tbody.accounting')
    @endif
@endif
