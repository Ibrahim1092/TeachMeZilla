@extends('layouts.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            {{ trans('stages.Add-Stage') }}
                        </button>
                        <button type="button" class="btn btn-success" id="deleteAll" onclick="broo()">
                            {{ trans('classroom.Delete_All') }}
                        </button>
                        {{-- <div class="dropdown" > --}}
                          
                        {{-- </div> --}}
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="datatable" class="table align-items-center mb-0" style="border-color: black">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            style="text-align: center">
                                            <input type="checkbox" name="delete_all" id="delete_all"
                                                onclick="checkAll('box',this)" />
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            style="text-align: center">
                                            {{ trans('Stages.Stage-ID') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                                            style="text-align: center">
                                            {{ trans('Stages.Stage-Name') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                                            style="text-align: center">
                                            {{ trans('Stages.Stage-Note') }}</th>
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
                                    @foreach ($stage as $item)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td class="align-middle text-center"><input type="checkbox"
                                                    value="{{ $item->ID }}" class="box"></td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">{{ $i }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs text-secondary mb-0">{{ $item->Name }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs text-secondary mb-0"
                                                    style="border: 3cm">{{ $item->Note }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="container text-center">
                                                    <div class="row">
                                                        <div class="col">
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop{{ $item->ID }}">
                                                                {{ trans('stages.Edit') }}
                                                            </button>
                                                        </div>
                                                        <div class="col">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#warning{{ $item->ID }}">
                                                                {{ trans('stages.Delete') }}
                                                            </button>                                                  
                                                        </div>
                                                      
                                                        
                                                                     <!-- Modals -->
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
                                                                        <form action="{{ route('stage.deleteall') }}"
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
                                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel"aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="exampleModalLabel">
                                                                            {{ trans('stages.Add-Stage') }}
                                                                        </h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>

                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card-body">
                                                                            <form role="form"
                                                                                action="{{ route('stage.store') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <label>{{ trans('stages.E-Name') }}</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="" aria-label="text"
                                                                                        aria-describedby="email-addon"
                                                                                        name="eName">
                                                                                </div>
                                                                                <label>{{ trans('stages.A-Name') }}</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="" aria-label="text"
                                                                                        aria-describedby="password-addon"
                                                                                        name="aName">
                                                                                </div>
                                                                                <label>{{ trans('stages.E-Note') }}</label>
                                                                                <div class="mb-3">

                                                                                    <textarea class="form-control" aria-label="text" name="eNote"> </textarea>
                                                                                </div>
                                                                                <label>{{ trans('stages.A-Note') }}</label>
                                                                                <div class="mb-3">

                                                                                    <textarea class="form-control" aria-label="text" name="aNote"> </textarea>
                                                                                </div>
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
                                                        <div class="modal fade" id="staticBackdrop{{ $item->ID }}"
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
                                                                            action="{{ route('stage.update') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <label>{{ trans('stages.E-Name') }}</label>
                                                                            <div class="mb-3">
                                                                                <input type="text"
                                                                                    class="form-control" placeholder=""
                                                                                    aria-label="text"
                                                                                    aria-describedby="email-addon"
                                                                                    name="eName"
                                                                                    value="{{ $item->getTranslation('Name', 'en') }}">
                                                                            </div>
                                                                            <label>{{ trans('stages.A-Name') }}</label>
                                                                            <div class="mb-3">
                                                                                <input type="text"
                                                                                    class="form-control" placeholder=""
                                                                                    aria-label="text"
                                                                                    aria-describedby="password-addon"
                                                                                    name="aName"
                                                                                    value="{{ $item->getTranslation('Name', 'ar') }}">
                                                                            </div>
                                                                            <label>{{ trans('stages.E-Note') }}</label>
                                                                            <div class="mb-3">
                                                                                <textarea name="eNote" class="form-control" cols="5" rows="5">{{ $item->getTranslation('Note', 'en') }}</textarea>
                                                                                {{-- <input type="text" class="form-control" placeholder=""
                                                                                    aria-label="text" aria-describedby="password-addon" name="eNote" value="{{$item->getTranslation('Note','en')}}"> --}}
                                                                            </div>
                                                                            <label>{{ trans('stages.A-Note') }}</label>
                                                                            <div class="mb-3">
                                                                                <textarea name="aNote" class="form-control" cols="5" rows="5">{{ $item->getTranslation('Note', 'ar') }}</textarea>
                                                                                {{-- <input type="text" class="form-control" placeholder=""
                                                                                    aria-label="text" aria-describedby="password-addon" name="aNote" value="{{$item->getTranslation('Note','ar')}}"> --}}
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <input type="hidden"
                                                                                    class="form-control"
                                                                                    name="id"
                                                                                    value="{{ $item->ID }}">
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
                                                        <div class="modal fade" id="warning{{ $item->ID }}"
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
                                                                        <form action="{{ route('stage.delete') }}"
                                                                            method="DELETE">
                                                                            @csrf
                                                                            <label>{{ trans('messages.Warning') }}
                                                                            </label></br>
                                                                            <label
                                                                                style="color:green">{{ $item->Name }}</label>
                                                                            <input type="hidden" name = "id"
                                                                                value="{{ $item->ID }}">

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
                {{ $stage->onEachSide(1)->links() }}
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
