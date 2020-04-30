<tbody>
<tr>
    <td colspan="3"><strong>{{$section->balance_article->description}}</strong></td>
</tr>
@foreach($balance_date->get_Child_Corporation_Balance_Section($section) as $child_section)
    <tr>
        <td class="pl-3 @if($child_section->balance_article->parent_code) pl-4 @endif">{{$child_section->balance_article->description}}</td>
        <td class="">{{$child_section->balance_article->code}}</td>
        <td class="text-right" style="min-width: 100px; max-width: 125px;">
            @if (!$child_section->balance_article->has_children)
                <input type="text" class="text-right" name="{{$child_section->balance_article->code}}"
                       style="width: 100%;" value="{{$child_section->value}}">
            @else
                @php //isset для phpshtorm, он считает, что переменной нет.
                if( isset( $balance_date) and isset( $child_section)) $value=$balance_date->get_sum_parent($child_section);
                @endphp
                {{$value}}
                <input hidden name="{{$child_section->balance_article->code}}" value="{{$value}}">
            @endif
        </td>
    </tr>
@endforeach
<tr>
    @php //isset для phpshtorm, он считает, что переменной нет.
        if( isset( $section) and isset( $balance_date)) $sum_section=$balance_date->get_Razdel_Sum($section);
    @endphp
    <th scope="col">
        <strong>{{$sum_section->balance_article->description}}</strong>
    </th>
    <th scope="col">
        <strong>{{$sum_section->balance_article->code}}</strong></th>
    <th scope="col" class="text-right">
        <strong>{{$sum_section->value}}</strong></th>
</tr>
</tbody>

