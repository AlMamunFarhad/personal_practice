{{-- <html>
    <table>
        <thead>
            <tr>
                <th style="font-size: 18px">{{translate('employee_List')}}</th>
            </tr>
            <tr>

                <th>{{ translate('employee_Analytics') .' '.'-'}}</th>
                <th></th>
                <th>
                        {{translate('filter_By').' '.'-'.' '.ucwords($data['filter'])}}
                    <br>
                        {{translate('total_Employee').' '.'-'.' '.count($data['employees'])}}
                    <br>
                        {{translate('active_Employee').' '.'-'.' '.$data['active']}}
                    <br>
                        {{translate('inactive_Employee').' '.'-'.' '.$data['inactive']}}
                </th>
            </tr>
            <tr>
                <th>{{translate('search_Criteria')}}-</th>
                <th></th>
                <th>  {{translate('search_Bar_Content').' '.'-'.' '.$data['search'] ?? 'N/A'}}</th>
            </tr>
            <tr>
                <td> {{translate('SL')}}	</td>
                <td> {{translate('employee_Image')}}</td>
                <td> {{translate('Name')}}</td>
                <td> {{translate('phone')}}	</td>
                <td> {{translate('email')}}	</td>
                <td> {{translate('role')}}	</td>
                <td> {{translate('accesses')}} </td>
                <td> {{translate('date_of_Joining')}} </td>
                <td> {{translate('status')}}</td>
            </tr>
            @foreach ($data['employees'] as $key=>$item)
                <tr>
                    <td> {{++$key}}	</td>
                    <td style="height: 70px"></td>
                    <td> {{ucwords($item->name)}}</td>
                    <td> {{$item->phone}}</td>
                    <td> {{ucwords($item->email)}}</td>
                    <td> {{ucwords($item?->role?->name)}}</td>
                    <td>
                        @if(!empty($item->role->module_access))
                            @foreach ( json_decode($item?->role->module_access) as $value)
                                @isset($value)
                                    {{ucwords(str_replace('_',' ',$value))}}
                                    <br>
                                @endisset
                            @endforeach
                        @endif
                    </td>
                    <td> {{date('d M, Y h:i A',strtotime($item->created_at))}}</td>
                    <td> {{translate($item->status == 1 ? 'active' : 'inactive')}}</td>
                </tr>
            @endforeach
        </thead>
    </table>
</html> --}}

<html>
    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead>
            <tr>
                <th colspan="9" class="px-4 py-3 text-lg font-bold text-left">
                    {{translate('employee_List')}}
                </th>
            </tr>
            <tr>
                <th colspan="2" class="px-4 py-3 text-left font-semibold">
                    {{ translate('employee_Analytics') .' '.'-'}}
                </th>
                <th colspan="7" class="px-4 py-3 text-left font-normal">
                    {{translate('filter_By').' '.'-'.' '.ucwords($data['filter'])}}
                    <br>
                    {{translate('total_Employee').' '.'-'.' '.count($data['employees'])}}
                    <br>
                    {{translate('active_Employee').' '.'-'.' '.$data['active']}}
                    <br>
                    {{translate('inactive_Employee').' '.'-'.' '.$data['inactive']}}
                </th>
            </tr>
            <tr>
                <th colspan="2" class="px-4 py-3 text-left font-semibold">
                    {{translate('search_Criteria')}}-
                </th>
                <th colspan="7" class="px-4 py-3 text-left font-normal">
                    {{translate('search_Bar_Content').' '.'-'.' '.$data['search'] ?? 'N/A'}}
                </th>
            </tr>
            <tr class="bg-blue-900 text-white">
                <td class="border border-gray-300 px-3 py-3 text-center font-semibold">
                    {{translate('SL')}}
                </td>
                <td class="border border-gray-300 px-3 py-3 text-center font-semibold">
                    {{translate('employee_Image')}}
                </td>
                <td class="border border-gray-300 px-3 py-3 text-center font-semibold">
                    {{translate('Name')}}
                </td>
                <td class="border border-gray-300 px-3 py-3 text-center font-semibold">
                    {{translate('phone')}}
                </td>
                <td class="border border-gray-300 px-3 py-3 text-center font-semibold">
                    {{translate('email')}}
                </td>
                <td class="border border-gray-300 px-3 py-3 text-center font-semibold">
                    {{translate('role')}}
                </td>
                <td class="border border-gray-300 px-3 py-3 text-center font-semibold">
                    {{translate('accesses')}}
                </td>
                <td class="border border-gray-300 px-3 py-3 text-center font-semibold">
                    {{translate('date_of_Joining')}}
                </td>
                <td class="border border-gray-300 px-3 py-3 text-center font-semibold">
                    {{translate('status')}}
                </td>
            </tr>
            @foreach ($data['employees'] as $key=>$item)
                <tr>
                    <td class="border border-gray-300 px-3 py-3 text-center">
                        {{++$key}}
                    </td>
                    <td class="h-[70px] border border-gray-300 px-3 py-3"></td>
                    <td class="border border-gray-300 px-3 py-3">
                        {{ucwords($item->name)}}
                    </td>
                    <td class="border border-gray-300 px-3 py-3">
                        {{$item->phone}}
                    </td>
                    <td class="border border-gray-300 px-3 py-3">
                        {{ucwords($item->email)}}
                    </td>
                    <td class="border border-gray-300 px-3 py-3">
                        {{ucwords($item?->role?->name)}}
                    </td>
                    <td class="border border-gray-300 px-3 py-3">
                        @if(!empty($item->role->module_access))
                            @foreach ( json_decode($item?->role->module_access) as $value)
                                @isset($value)
                                    {{ucwords(str_replace('_',' ',$value))}}
                                    <br>
                                @endisset
                            @endforeach
                        @endif
                    </td>
                    <td class="border border-gray-300 px-3 py-3">
                        {{date('d M, Y h:i A',strtotime($item->created_at))}}
                    </td>
                    <td class="border border-gray-300 px-3 py-3 text-center">
                        {{translate($item->status == 1 ? 'active' : 'inactive')}}
                    </td>
                </tr>
            @endforeach
        </thead>
    </table>
</html>

