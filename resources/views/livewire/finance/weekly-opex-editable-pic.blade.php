<div>
    @if($is_edit)
        <div wire:ignore>
            <select class="form-control select2">
                <option value=""> -- Select -- </option>
            </select>
            <div wire:loading.remove wire:target="save,is_edit">
                <a href="javascript:void(0)" wire:click="$set('is_edit',false)"><i class="fa fa-close text-danger"></i></a>
                <a href="javascript:void(0)" wire:click="save"><i class="fa fa-save text-success"></i></a>
            </div>
        </div>
    @else
        <a href="javascript:void(0)" class="editable" wire:click="$set('is_edit',true)">{!!isset($data->pic->name) ? $data->pic->name:'edit'!!}</a>
    @endif
    <span wire:loading wire:target="save,is_edit">
        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        <span class="sr-only">{{ __('Loading...') }}</span>
    </span>
    @push('after-scripts')
        <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" />
        <script>
            Livewire.on('is-edit',()=>{
                $(".select2").select2(
                    {
                    ajax: {
                        url: '{{route('ajax.get-employees')}}',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public'
                            }
                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });

                $('.select2').on('select2:select', function (e) {
                    var data = e.params.data;
                    console.log(data);
                    @this.set('employee_id',data.id);
                    // $('.select2').val({{$employee_id}}).trigger('change');
                    $('.select2').select2().val(data.id).trigger("change")
                });
            });
        </script>
    @endpush
</div>