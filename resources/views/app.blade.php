@extends('common::framework')

@section('progressive-app-tags')
	<link rel="manifest" href="client/manifest.json">
	<meta name="theme-color" content="#1976d2">
@endsection

@section('angular-styles')
    {{--angular styles begin--}}
		<link rel="stylesheet" href="client/styles.1f996f199030255eb815.css" media="print" onload="this.media='all'">
	{{--angular styles end--}}
@endsection

@section('angular-scripts')
    {{--angular scripts begin--}}
		<script src="client/runtime-es2015.46a4f185773a93157538.js" type="module"></script>
		<script src="client/runtime-es5.46a4f185773a93157538.js" nomodule="" defer=""></script>
		<script src="client/polyfills-es5.da18fc63cdef693ce715.js" nomodule="" defer=""></script>
		<script src="client/polyfills-es2015.4a051482fc9338768ee5.js" type="module"></script>
		<script src="client/main-es2015.b9e79d4e6de6436ec702.js" type="module"></script>
		<script src="client/main-es5.b9e79d4e6de6436ec702.js" nomodule="" defer=""></script>
	{{--angular scripts end--}}
@endsection
