@extends('app')

@section('content')

<div class="page-header">
<a href="/" class="btn btn-info btn-sm pull-right">Try Another</a>
<h2 class="page-title">Your Prepared Form</h2>
</div>

<object data="/{{$filename}}" type="application/pdf" width="100%" height="500">
 
  <p>It appears you don't have a PDF plugin for this browser.
  No biggie... you can <a href="/{{$filename}}">click here to
  download the PDF file.</a></p>
  
</object>

@endsection