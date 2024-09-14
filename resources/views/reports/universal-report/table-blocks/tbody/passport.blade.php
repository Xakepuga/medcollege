<td class="text-center align-content-center">{{ $student->passport->gender === 'male' ? 'муж.' : 'жен.' }}</td>
<td class="text-center align-content-center">{{ date('d.m.Y', strtotime($student->passport->birthday)) }}</td>
<td class="text-center align-content-center">{{ $student->passport->nationality->name }}</td>
<td class="text-center align-content-center">{{ $student->passport->birthplace }}</td>
<td class="text-center align-content-center">{{ $student->passport->number }}</td>
<td class="text-center align-content-center">{{ date('d.m.Y', strtotime($student->passport->issue_date)) }}</td>
<td class="text-center align-content-center">{{ $student->passport->issue_by }}</td>
<td class="text-center align-content-center">{{ $student->passport->address_registered }}</td>
<td class="text-center align-content-center">{{ $student->passport->address_residential }}</td>
