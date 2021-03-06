<!-- barcodegenerator.blade.php --> 

@if(count($errors) > 0)

	<div class="alert alert-danger">
gf
	</div>

@endif


@extends('layouts.main')

@section('page-title')
  Barcode Generator
@stop()

@section('page-description')
  A tool for generating barcode images
@stop()

@section('content')


  <form method="post" action="{{route('barcode.generator')}}" >
  {{csrf_field()}}


  <div class="row">
    <div class="col col-md-6">
      <div class="form-group ">
        <label for="barcode" style="visibility:">Value</label>
        <input type="text" value="{{ Session::get('bcode_val')}}"  class="form-control" id="barcode" name="barcode_val" required>
      </div>
    </div>
    <div class="col col-md-6">
    <div class="form-group">
      <label for="sel1">Select Barcode Type:</label>
      <select  class="form-control" id="sel1" name="bcode_type" required >
        <option id="{{ Session::get('bcode_type_id')}}" value="{{ Session::get('bcode_type_id')}}" >{{ Session::get('bcode_type_name')}}</option>
        <!-- <option >C128</option> -->
        @foreach($codes as $code)
          <option value="{{$code->id}}" id="{{$code->id}}" >{{$code->name}}</option>
        @endforeach
      </select>

    </div>
    </div>
  </div>
   
  <div class="row">
    <div class="col col-md-6">
      <div class="form-group">
      <label for="height">Height</label>
      <input type="number" value="{{ Session::get('bcode_height')}}"  step="0.01" class="form-control" id="height" name="height"  max="124" >
      </div>
    </div>
    <div class="col col-md-6">
      <div class="form-group">
      <label for="width">width</label>
      <input type="number" value="{{ Session::get('bcode_width')}}"  placeholder=""  step="0.01" class="form-control" id="width" name="width"   max="4.4"  >
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col col-md-12 float-right">
      
        <button type="submit" id="submit" class="btn btn-primary btn-lg float-right">Generate</button>
      <br>
      <br>
    </div>
  </div>
  </form>

<br><br>

  <div class="row">
    <div class="col col-md-12">
      <div class="card">
        <div class="card-body">
          <p>{{ App\Code::find(1)->codetype->desc }}</p>
          <h4>Click the Barcode to Download</h4>
          <hr><br>
          <div class="row">
          <div class="col col-md-3" style="background-color: antiquewhite;">
          <b>Barcode Type:</b> {{ Session::get('bcode_type_name')}} <br>
          <b>Barcode Value:</b> {{ Session::get('bcode_val')}} <br>
          <b>Barcode Width:</b> {{ Session::get('bcode_width')}} <br>
          <b>Barcode Width:</b> {{ Session::get('bcode_height')}} <br>
          <button  onclick="document.getElementById('123').click()" type="button" class="btn btn-outline-primary btn-sm float-right">Download</button><br><br>
          </div>
          <div class="col col-md-9">
          <center>
          @php
            if(!isset($barcode_val)){ $barcode_val="12345";}
            if(!isset($width)){  $width = 3;}
            if(!isset($height)){  $height = $width * 10;}
            
            echo '
            <a id="123" href="data:image/png;base64,' . DNS1D::getBarcodePNG("$barcode_val", "$bcode_type", number_format($width, 2),number_format($height, 2) ) . '" download="'.$barcode_val.'">
            <img  src="data:image/png;base64,' . DNS1D::getBarcodePNG("$barcode_val", "$bcode_type", number_format($width, 2),number_format($height, 2) ) . '" alt="barcode" />
            
            </a>';
            
             DNS1D::getBarcodePNGPath("$barcode_val", "$bcode_type",number_format($width, 2),number_format($height, 2),[0,0,0],true);
          @endphp 
          </center>
          </div>
          </div>
        </div>
      </div>

    </div>
  </div>


 
@stop()
