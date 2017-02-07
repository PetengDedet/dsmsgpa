<html>
<head>
	<title>mSukorejo</title>
	<script src="{{asset('js/jquery-3.1.1.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('semantic')}}/semantic.min.css">
	<script src="{{asset('semantic')}}/semantic.min.js"></script>
</head>
<body>
	<div class="ui menu visible">
		<div class="header item">Brand</div>
		<a class="active item">Link</a>
		<a class="item">Link</a>
		<div class="ui dropdown item" tabindex="0">
			Dropdown
			<i class="dropdown icon"></i>
			<div class="menu transition hidden" tabindex="-1">
				<div class="item">Action</div>
				<div class="item">Another Action</div>
				<div class="item">Something else here</div>
				<div class="divider"></div>
				<div class="item">Separated Link</div>
				<div class="divider"></div>
				<div class="item">One more separated link</div>
			</div>
		</div>
		<div class="right menu">
			<div class="item">
				<div class="ui action left icon input">
					<i class="search icon"></i>
					<input type="text" placeholder="Search">
					<button class="ui button">Submit</button>
				</div>
			</div>
			<a class="item">Link</a>
		</div>
	</div>


	<script type="text/javascript">
		$(document).ready(function(){
			$('.dropdown').dropdown();
		})
	</script>
</body>
</html>