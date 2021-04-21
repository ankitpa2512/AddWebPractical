<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AddWeb - Practical</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
<div class="content">
<div class="container-fluid">
<div class="row mt-4 mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">List Data</h4>
            </div>
            <div class="card-body">
                @if(count($reports) > 0)
                <div>
                    @foreach($reports as $re=>$reportData)
                    @php $report = $reportData->data; @endphp
                    <ul class="mt-3">
                        <li>ID: {{ $report['ID'] }}</li>
                        <li>Country: {{ $report['Country'] }}</li>
                        <li>Language: {{ $report['Language'] }}</li>
                        <li>
                            <label>Chapters:</label>
                            @if(count($report['Chapters']) > 0)
                                <ul>
                                @foreach($report['Chapters'] as $cpt=>$chapters)
                                    <li> <label>{{ $cpt }}:</label>
                                        <ul>
                                            <li>ID: {{ $chapters['ID'] }}</li>
                                            <li>Data: {{ $chapters['Data'] }}</li>
                                            <li>Title: {{ $chapters['Title'] }}</li>
                                            <li>
                                                <label>Sections:</label> 
                                                @if(count($chapters['Sections']) > 0)
                                                <ul>
                                                @foreach($chapters['Sections'] as $sec=>$sections)
                                                    <li> <label>{{ $sec }}:</label>
                                                        <ul>
                                                            <li>ID: {{ $sections['ID'] }}</li>
                                                            <li>Data: {{ $sections['Data'] }}</li>
                                                            <li>Title: {{ $sections['Title'] }}</li>
                                                        </ul>
                                                    </li>
                                                @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                        </li>
                    </ul>
                    <br>
                    @endforeach
                </div>
                @else
                <div class="text-center">
                    <b>No any data available!</b>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <form method="POST" action="{{ route('store') }}">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Data</h4>
                </div>   
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            @php
                                Session::forget('error');
                            @endphp
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endforeach
                    @endif
                    @php
                    $randomId = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(6));
                    @endphp
                    <ul class="mt-3">
                        <input type="hidden" name="report[ID]" value="{{$randomId}}" />
                        <li>
                            <label class="float-left mt-2 mb-0 mr-2">Country:</label> 
                            <input name="report[Country]"  class="form-control col-md-6 mb-1" required/>
                        </li>
                        <li>
                            <label class="float-left mt-2 mb-0 mr-2">Language:</label> 
                            <input name="report[Language]"  class="form-control col-md-6 mb-1" required/>
                        </li>
                        <li>
                            <label>Chapters:</label>
                            <ul>
                                <li> <label>#1:</label>
                                    <ul>
                                        <input type="hidden" name="report[Chapters][#1][ID]" value="{{$randomId}}_Chapters_1"/>
                                        <li>
                                            <label class="float-left mt-2 mb-0 mr-2">Data:</label> 
                                            <input name="report[Chapters][#1][Data]"  class="form-control col-md-6 mb-1" />
                                        </li>
                                        <li>
                                            <label class="float-left mt-2 mb-0 mr-2">Title:</label> 
                                            <input name="report[Chapters][#1][Title]"  class="form-control col-md-6 mb-1" />
                                        </li>
                                        <li>
                                            <label>Sections:</label>
                                            <ul>
                                                <li> <label>#1:</label>
                                                    <ul>
                                                        <input type="hidden" name="report[Chapters][#1][Sections][#1][ID]" value="{{$randomId}}_Chapters_1_Sections_1"/>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Data:</label><input name="report[Chapters][#1][Sections][#1][Data]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Title:</label><input name="report[Chapters][#1][Sections][#1][Title]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                    </ul>
                                                </li>                                
                                                <li> <label>#2:</label>
                                                    <ul>
                                                        <input type="hidden" name="report[Chapters][#1][Sections][#2][ID]" value="{{$randomId}}_Chapters_1_Sections_2"/>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Data:</label><input name="report[Chapters][#1][Sections][#2][Data]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Title:</label><input name="report[Chapters][#1][Sections][#2][Title]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                    </ul>
                                                </li> 
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li> <label>#2:</label>
                                    <ul>
                                        <input type="hidden" name="report[Chapters][#2][ID]" value="{{$randomId}}_Chapters_2"/>
                                        <li>
                                            <label class="float-left mt-2 mb-0 mr-2">Data:</label> 
                                            <input name="report[Chapters][#2][Data]"  class="form-control col-md-6 mb-1" />
                                        </li>
                                        <li>
                                            <label class="float-left mt-2 mb-0 mr-2">Title:</label> 
                                            <input name="report[Chapters][#2][Title]"  class="form-control col-md-6 mb-1" />
                                        </li>
                                        <li>
                                            <label>Sections:</label>
                                            <ul>
                                                <li> <label>#1:</label>
                                                    <ul>
                                                        <input type="hidden" name="report[Chapters][#2][Sections][#1][ID]" value="{{$randomId}}_Chapters_2_Sections_1"/>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Data:</label><input name="report[Chapters][#2][Sections][#1][Data]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Title:</label><input name="report[Chapters][#2][Sections][#1][Title]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                    </ul>
                                                </li>                                
                                                <li> <label>#2:</label>
                                                    <ul>
                                                        <input type="hidden" name="report[Chapters][#2][Sections][#2][ID]" value="{{$randomId}}_Chapters_2_Sections_2"/>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Data:</label><input name="report[Chapters][#2][Sections][#2][Data]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Title:</label><input name="report[Chapters][#2][Sections][#2][Title]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li> <label>#3:</label>
                                                    <ul>
                                                        <input type="hidden" name="report[Chapters][#2][Sections][#3][ID]" value="{{$randomId}}_Chapters_2_Sections_3"/>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Data:</label><input name="report[Chapters][#2][Sections][#3][Data]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                        <li>
                                                            <label class="float-left mt-2 mb-0 mr-2">Title:</label><input name="report[Chapters][#2][Sections][#3][Title]"  class="form-control col-md-6 mb-1" />
                                                        </li>
                                                    </ul>
                                                </li> 
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        <button type="Submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>
