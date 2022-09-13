<script src="{{asset('theme/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('theme/js/scripts.bundle.js')}}"></script>
<script src="{{asset('theme/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{asset('theme/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('theme/js/jquery.validate.js')}}"></script>
@yield('pagespecificscripts')
<script src="{{asset('theme/js/widgets.bundle.js')}}"></script>
<script src="{{asset('theme/js/custom/widgets.js')}}"></script>
<script src="{{asset('theme/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('theme/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('theme/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('theme/js/custom/utilities/modals/users-search.js')}}"></script>
<script src="{{asset('theme/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
<script>
	jQuery(document).ready(function(){
                    jQuery(document).on('click','.admin_logout_btn',function(){
                        jQuery(document).find('form#logout-form').submit();
                    });

					setTimeout(() => {
						$('.alert').alert('close');
					}, 3000);
            });
</script>
</body>

</html>