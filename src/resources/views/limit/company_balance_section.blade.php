<tbody xmlns:v-on="http://www.w3.org/1999/xhtml">
<tr>
    <td colspan="3"><strong>{{$section->balance_article->description}}</strong></td>
</tr>
@foreach($balance_date->get_Child_Corporation_Balance_Section($section) as $child_section)
    <tr>
        <td class="pl-3 @if($child_section->balance_article->parent_code) pl-4 @endif">{{$child_section->balance_article->description}}</td>
        <td class="">{{$child_section->balance_article->code}}</td>
        <td class="text-right" style="min-width: 100px; max-width: 125px;">
            @if (!$child_section->balance_article->has_children)
                <input type="text" autocomplete="off"
                       onblur="this.value = this.value.replace(',','.').replace(/[^\d.-]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ' ')"
                       onfocus="this.value = this.value.replace(/\s/g, '')"
                       class="text-right without-arrow
                       sec{{$balance_date->id}}tion{{$child_section->balance_article->section_code}}
                       @if ($child_section->balance_article->parent_code) par{{$balance_date->id}}ent{{$child_section->balance_article->parent_code}} @endif"
                       name="{{$child_section->balance_article->code}}"
                       v-on:input="summing"
                       data-section-code="sec{{$balance_date->id}}tion{{$child_section->balance_article->section_code}}"
                       data-part="pa{{$balance_date->id}}rt{{$child_section->balance_article->balance_part}}"
                       data-balance-id="{{$balance_date->id}}"
                       @if ($child_section->balance_article->parent_code) data-parent-code="par{{$balance_date->id}}ent{{$child_section->balance_article->parent_code}}"
                       @endif
                       style="width: 100%;" value="{{str_replace('.00', '', number_format($child_section->value, 2, '.', ' '))}}">
            @else
                @php //isset для phpshtorm, он считает, что переменной нет.
                if( isset( $balance_date) and isset( $child_section)) $value=$balance_date->get_sum_parent($child_section);
                @endphp
                <div id="par{{$balance_date->id}}ent{{$child_section->balance_article->code}}div">
                    {{str_replace('.00', '', number_format($value, 2, '.', ' '))}}
                </div>
                <input type="number" hidden
                       id="par{{$balance_date->id}}ent{{$child_section->balance_article->code}}"
                       name="{{$child_section->balance_article->code}}" value="{{$value}}">
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
        <strong class="pa{{$balance_date->id}}rt{{$child_section->balance_article->balance_part}}" id="sec{{$balance_date->id}}tion{{$child_section->balance_article->section_code}}">{{str_replace('.00', '', number_format($sum_section->value, 2, '.', ' '))}}</strong></th>
</tr>
</tbody>

