@extends('layouts.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        {{-- <a class="btn btn-success" href="{{ route('stage.add') }}">Add Stage</a> --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            {{ trans('classroom.Add-Class') }}
                        </button>
                        <button type="button" class="btn btn-success" id="deleteAll" onclick="broo()">
                            {{ trans('classroom.Delete_All') }}
                        </button>
                        <button class="btn btn-warning " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ trans('classroom.Specific') }}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($stages as $stage)
                                <li><a style="color: black" class="dropdown-item"
                                        href="{{ route('classroom.specificSearch', $stage->ID) }}">{{ $stage->Name }}</a>
                                </li>
                            @endforeach

                        </ul>
                        <!-- Modal -->

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            {{ trans('classroom.Add-Class') }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <form role="form" action="{{ route('classroom.store') }}" method="POST">
                                                @csrf
                                                <label>{{ trans('classroom.Ename') }}</label>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder=""
                                                        aria-label="text" aria-describedby="email-addon" name="Ename">
                                                </div>
                                                <label>{{ trans('classroom.Aname') }}</label>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder=""
                                                        aria-label="text" aria-describedby="email-addon" name="Aname">
                                                </div>
                                                <label>{{ trans('classroom.stage_name') }}</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="stage">
                                                    @foreach ($stages as $stage)
                                                        <option>{{ $stage->Name }}</option>
                                                    @endforeach
                                                </select>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ trans('stages.Close') }}</button>
                                        <button type="submit"
                                            class="btn btn-primary">{{ trans('stages.Confirm') }}</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" style="border-block-color: black;border:1cm"
                                id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            style="text-align: center">
                                            <input type="checkbox" name="delete_all" id="delete_all"
                                                onclick="checkAll('box',this)" />
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            style="text-align: center">
                                            {{ trans('Stages.Stage-ID') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                                            style="text-align: center">
                                            {{ trans('classroom.Name') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            style="text-align: center">
                                            {{ trans('classroom.stage_name') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            style="text-align: center">
                                            {{ trans('Stages.Stage-Process') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $i = 0;
                                    @endphp
                                  @if (isset($details))
                                  @php
                                       $classrooms = $details;
                                  @endphp
                                     
                                  @endif
                                    @foreach ($classrooms as $item)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td class="align-middle text-center"><input type="checkbox"
                                                    value="{{ $item->id }}" id="check_1" class="box"></td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">{{ $i }}</p>
                                            </td>
                                            <td class="align-middle text-center">

                                                <p class="text-xs text-secondary mb-0">{{ $item->name }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center"
                                                    style="text-overflow: ellipsis">
                                                    {{-- <p class="text-xs font-weight-bold mb-0">Manager</p> --}}
                                                    <p class="text-xs font-weight-bold mb-0" style="text-align: center">
                                                        {{ $item->stage->Name }}</p>
                                                </div>
                                                {{-- <p class="text-xs text-secondary mb-0" style="text-align: center">{{ $item->stage->Name }}</p> --}}
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="container text-center">
                                                    <div class="row">
                                                        <div class="col">
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop{{ $item->id }}">
                                                                {{ trans('stages.Edit') }}
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="staticBackdrop{{ $item->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="staticBackdropLabel">
                                                                                {{ trans('stages.Edit') }}</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <form role="form"
                                                                                action="{{ route('classroom.update') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <label>{{ trans('classroom.Ename') }}</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        value="{{ $item->getTranslation('name','en') }}"
                                                                                        name="Ename">
                                                                                </div>
                                                                                <label>{{ trans('classroom.Aname') }}</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        value="{{ $item->getTranslation('name','ar') }}"
                                                                                        name="Aname">
                                                                                </div>
                                                                                <label>{{ trans('classroom.stage_name') }}</label>
                                                                                <select class="form-select"
                                                                                    aria-label="Default select example"
                                                                                    name="stage">
                                                                                    <option
                                                                                        value="{{ $item->stage->Name }}">
                                                                                        {{ $item->stage->Name }}</option>
                                                                                    @foreach ($stages as $stage)
                                                                                        @if ($stage->Name != $item->stage->Name)
                                                                                            <option
                                                                                                value="{{ $stage->Name }}">
                                                                                                {{ $stage->Name }}
                                                                                            </option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>
                                                                                <div class="mb-3">
                                                                                    <input type="hidden"
                                                                                        class="form-control"
                                                                                        name="id"
                                                                                        value="{{ $item->id }}">
                                                                                </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">{{ trans('stages.Close') }}</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">{{ trans('stages.Save-Change') }}</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                        </div>
                                                        <div class="col">
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#warning{{ $item->id }}">
                                                                {{ trans('stages.Delete') }}
                                                            </button>
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="warning{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="exampleModalLabel" style="color:red"> <i
                                                                                class="fa fa-exclamation-triangle"
                                                                                aria-hidden="true"></i></h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"
                                                                            style="color:green"><i class="fa fa-times"
                                                                                aria-hidden="true"></i></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('classroom.delete') }}"
                                                                            method="DELETE">
                                                                            @csrf
                                                                            <label>{{ trans('messages.Warning') }}
                                                                            </label></br>
                                                                            <label
                                                                                style="color:green">{{ $item->name }}</label>
                                                                            <input type="hidden" name = "id"
                                                                                value="{{ $item->id }}">

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">{{ trans('stages.Close') }}</button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            {{ trans('stages.Delete') }} </button>
                                                                    </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="modalToDeleteAll" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="exampleModalLabel" style="color:red"> <i
                                                                                class="fa fa-exclamation-triangle"
                                                                                aria-hidden="true"></i></h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"
                                                                            style="color:green"><i class="fa fa-times"
                                                                                aria-hidden="true"></i></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('classroom.deleteall') }}"
                                                                            method="DELETE">
                                                                            @csrf
                                                                            <label>{{ trans('messages.showselected') }}</label>
                                                                            <label id = "showselected"></label>
                                                                            <label>{{ trans('classroom.showselected') }}
                                                                                </lable>

                                                                                <input type="hidden" name = "id"
                                                                                    id="sendselected">

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">{{ trans('stages.Close') }}</button>
                                                                        <button type="submit" class="btn btn-primary">
                                                                            {{ trans('stages.Delete') }} </button>
                                                                    </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div>
                {{ $classrooms->onEachSide(1)->links() }}
            </div>




        </div>
        {{-- <div style="text-align:center"> --}}
        {{-- </div> --}}
        {{-- <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Projects table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Project</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Budget</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Completion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-spotify.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Spotify</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">$2,500</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">working</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">60%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info" role="progressbar"
                                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 60%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-invision.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="invision">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Invision</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">$5,000</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">done</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">100%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-jira.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="jira">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Jira</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">$3,400</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">canceled</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">30%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="30"
                                                            style="width: 30%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-slack.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="slack">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Slack</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">$1,000</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">canceled</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">0%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"
                                                            style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-webdev.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Webdev</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">$14,000</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">working</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">80%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info" role="progressbar"
                                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="80"
                                                            style="width: 80%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="../assets/img/small-logos/logo-xd.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="xd">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Adobe XD</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">$2,300</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">done</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">100%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    @endsection
