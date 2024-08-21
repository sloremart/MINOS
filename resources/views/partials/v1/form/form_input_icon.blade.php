<div class="mb-{{$mb??2}} mt-{{$mt??0}} col-span-{{$col_with??1}}">
    <label for="{{$input_name??""}}" class="block text-gray-700 text-sm font-bold mb-2">{{$input_label??""}}
        @if($tooltip_title??false)
            <span class="fas fa-circle-question"
                  data-toggle="tooltip" data-placement="{{$tooltip_position??"top"}}"
                  title="{{$tooltip_title??""}}"
            ></span>
        @endif
    </label>
    <div class="relative">
        @isset($icon_class)
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="text-gray-700 {{$icon_class}}"></i>
            </span>
        @endisset

        @if($input_rows??1 > 1)
            <textarea
                @if($updated_input??"" == "live")
                    wire:model.live="{{ $input_model }}"
                @else
                    wire:model="{{ $input_model }}"
                @endif
                rows="{{$input_rows}}"
                class="pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full"
                autocomplete="on"
                placeholder="{{$placeholder??''}}"
                @if($required??false)
                    required
                @endif
            ></textarea>

        @elseif($input_type == "checkbox")
            <div class="form-check form-switch ml-3">
                <input
                    wire:model.lazy="{{$input_model}}"
                    class="form-check-input border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    type="checkbox"
                    id="flexSwitchCheckChecked"
                    @if($disabled??false)disabled @endif
                    @if($required??false)
                        required
                    @endif
                >
            </div>

        @elseif($input_type == "select")
            <select
                wire:model.lazy="{{$input_model}}"
                class="{{$aux_class??'custom-select'}} {{$background??''}} pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full"
                @if($required??false)
                    required
                @endif
                @if($disabled??false)disabled @endif
            >
                <option disabled value="0">{{$select_default??""}}</option>
                @foreach($select_options??[] as $option)
                    <option
                        @if($select_option_title??"" != "")
                            title="{{ $option[$select_option_title] }}"
                        @endif
                        value="{{ $option[$select_option_value] }}"
                    >
                        {{ $option[$select_option_view] }}
                    </option>
                @endforeach
            </select>

        @else
            <input
                @if(($updated_input??null) == "live")
                    wire:model.live="{{ $input_model }}"
                @else
                    wire:model="{{ $input_model }}"
                @endif
                @if(($input_type??"text") == "number")
                    min="{{ $number_min??''}}" max="{{ $number_max??''}}" step="{{ $number_step??''}}"
                @endif
                id="{{$input_id??""}}"
                type="{{$input_type??'text'}}"
                class="pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full"
                autocomplete="{{$autocomplete??'on'}}"
                name="{{$input_name??""}}"
                onchange="{{$input_on_change??''}}()"
                placeholder="{{$placeholder??''}}"
                @if($disabled??false)disabled @endif
                @if($required??false)
                    required
                @endif
            >
        @endif
    </div>
    @error($input_model)
    <div class="error-container">
        <small class="form-text text-danger">{{$message}}</small>
    </div>
    @enderror
</div>
