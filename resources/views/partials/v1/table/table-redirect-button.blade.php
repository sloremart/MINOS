<div class="col-2">
    <button class="{{$button_color}} hover:{{$button_hover}} text-white font-bold  rounded-full px-3 py-2"
       data-toggle="tooltip" data-placement="{{$tooltip_position??"top"}}" title="{{$tooltip_title??""}}">
       <a href="{{route($button_route,array_merge([

    ($button_binding=="")?$model_id:$button_binding=>$model_id],
    $redirect_values??[]
    ))}}">
        <i class="text-{{$icon_color}} {{$icon}}"></i></a>
    </button>


</div>
