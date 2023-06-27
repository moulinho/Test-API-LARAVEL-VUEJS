@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Com') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
               <div class="">
               {{ Auth::user()->name }}
               </div>
                <textarea name="" id="" cols="30" rows="10"></textarea>
            </div>
        </div>
    </div>
</div>
@endsection
