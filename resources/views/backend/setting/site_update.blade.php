<x-main-layout>
    @section('title', breadcrumb())

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title fw-bold pb-4">Update Site Setting </h6>
                {{-- resources/views/components/backend/backend_component/site-settings-form.blade.php --}}
                <x-backend.backend_component.site-settings-form :sitesetting="$sitesetting" />
            </div>
        </div>
    </div>
    @section('script')
        <script src="{{ asset('backend/assets/src/plugins/src/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
        <script src="{{ asset('backend/assets/src/plugins/src/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

        <script src="{{ asset('backend/assets/src/plugins/src/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/src/plugins/src/input-mask/input-mask.js') }}"></script>


        <script>
            $('#static-masks').inputmask("99-9999-9999");

            $("#emails").inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
                greedy: !1,
                onBeforePaste: function(m, a) {
                    return (m = m.toLowerCase()).replace("mailto:", "")
                },
                definitions: {
                    "*": {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            })

            $('.address').maxlength({
                alwaysShow: true,
                threshold: 100,
                warningClass: "badge badge-secondary",
                limitReachedClass: "badge badge-dark",
                separator: ' of ',
                preText: 'You have ',
                postText: ' chars remaining.',
                validate: true
            });
            $('.about').maxlength({
                alwaysShow: true,
                threshold: 200,
                warningClass: "badge badge-secondary",
                limitReachedClass: "badge badge-dark",
                separator: ' of ',
                preText: 'You have ',
                postText: ' chars remaining.',
                validate: true
            });
            $('.meta_des').maxlength({
                alwaysShow: true,
                threshold: 300,
                warningClass: "badge badge-secondary",
                limitReachedClass: "badge badge-dark",
                separator: ' of ',
                preText: 'You have ',
                postText: ' chars remaining.',
                validate: true
            });
            $('.meta_key').maxlength({
                alwaysShow: true,
                threshold: 400,
                warningClass: "badge badge-secondary",
                limitReachedClass: "badge badge-dark",
                separator: ' of ',
                preText: 'You have ',
                postText: ' chars remaining.',
                validate: true
            });
        </script>

        <script type="text/javascript">
            function mainThamUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @stop
    </x-dashboard-layout>
