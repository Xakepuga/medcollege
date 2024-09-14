<td class="text-center align-content-center">{!! $student->phone ?? '&mdash;' !!}</td>
<td class="text-center align-content-center">{{ $student->educational->is_first_spo ? 'Да' : 'Нет' }}</td>
<td class="text-center align-content-center">{{ $student->specialCircumstances[0]->pivot->status ? 'Да' : 'Нет' }}</td>
