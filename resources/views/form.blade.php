@extends('app')

@section('content')


<div class="row">
  <div class="col-md-6 col-md-offset-3 col-xs-12">

<div class="page-header">
	<h2 class="page-title">Enter Some W-9 Data</h2>
</div>
<p class="lead">Throw in some junk, hit submit and I'll write it to the IRS's official W-9.</p>

	<form class="form" action="/writer" method="post">
	<?php echo csrf_field(); ?>

	<div class="form-group">
	  <label for="name">Name</label>
	  <input type="text" name="name" id="name" class="form-control">
	</div>

	<div class="form-group">
	  <label for="business_name">Business Name</label>
	  <input type="text" name="business_name" id="business_name" class="form-control">
	</div>

	<div class="form-group">
	  <label for="address">Street Address</label>
	  <input type="text" name="address" id="address" class="form-control">
	</div>

	<div class="form-group">
	  <label for="city_state_zip">City, State, Zip</label>
	  <input type="text" name="city_state_zip" id="city_state_zip" class="form-control">
	</div>

	<div class="form-group">
	  <label for="classification">Classification</label>
	  <select name="classification" id="classification" class="form-control">
		  <option value="">Choose...</option>
		  <option value="individual">Individual/Sole proprietor</option>
		  <option value="c-corp">C Corporation</option>
		  <option value="s-corp">S Corporation</option>
		  <option value="partnership">Partnership</option>
		  <option value="trust">Trust/Estate</option>
	  </select>
	</div>

	<div class="row">
	  <div class="col-md-5">
		<div class="form-group">
		  <label for="ssn">SSN</label>
		  <input type="text" name="ssn" id="ssn" class="form-control">
		</div>
	  </div>
	  <div class="col-md-2 text-center">
	  	<p class="lead">OR</p>
	  </div>
	  <div class="col-md-5">
		<div class="form-group">
		  <label for="ein">EIN</label>
		  <input type="text" name="ein" id="ein" class="form-control">
		</div>
	  </div>
	</div>

	<div class="form-group">
	  <button type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
	</div>

	</form>

  </div>
</div>

@endsection