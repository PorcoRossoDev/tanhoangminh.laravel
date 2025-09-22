@extends('homepage.layout.home')
@section('content')
    <main class="page-findding-result">
        {!! htmlBreadcrumb(0) !!}

        <div class="main-content wow fadeInUp">
            <div class="container">
                <div class="logo-find--container">
                    <img src="{{ $fcSystem['homepage_logo'] }}" alt="{{ $fcSystem['homepage_brandname'] }}">
                    <h1 class="text-center">{{ $fcSystem['homepage_brandname'] }}</h1>
                </div>

                <div class="return-find--container">
                    <h2 class="title text-center">Phiếu kết quả</h2>

                    <div class="return-table--container">
                        <table class="return-table table table-bordered">
                            <thead>
                                <tr>
                                    <th class="return-col--1">Họ và tên</th>
                                    <th class="return-col--2">Ngày khám</th>
                                    <th class="return-col--4">Ngày nhận kết quả</th>
                                    <th class="return-col--5">Ngày trả kết quả</th>
                                    <th class="return-col--6">Trạng thái</th>
                                    <th class="return-col--7">Tệp đính kèm</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="return-col--1">
                                        {{ $detail->fullname }}
                                    </td>

                                    <td class="return-col--2">
                                        {{ date('d-m-Y', strtotime($detail->examination_date)) }}
                                    </td>

                                    <td class="return-col--4 text-left">
                                        {{ date('d-m-Y', strtotime($detail->date_of_result)) }}
                                    </td>
                                    <td class="return-col--5">
                                        {{ date('d-m-Y', strtotime($detail->date_of_return)) }}
                                    </td>
                                    <td class="return-col--6">
                                        {{ date('d-m-Y', strtotime($detail->status)) }}
                                    </td>
                                    <td class="return-col--7">
                                        <a href="{{ asset($detail->image) }}" style="text-decoration: underline;">Xem
                                            file</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@push('css')
    <style>
        .return-table--container {
            margin-top: 35px;
        }

        .logo-find--container h1 {
            font-size: 35px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--primary-color);
        }

        .return-find--container .results .result-content>.row:not(:first-child) {
            margin-top: 12px;
        }

        .logo-find--container {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding-bottom: 10px;
        }

        .logo-find--container:after {
            content: "";
            width: 100%;
            height: 17px;
            display: block;
            background-position: center;
            background-repeat: no-repeat;
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAARCAMAAAAhQZhyAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAABOUExURUdwTEtLS1FRUVdXV1lZWVhYWFdXV1dXV1hYWFdXV1hYWFZWVlhYWFdXV1hYWFhYWFhYWFhYWFZWVlhYWFdXV1hYWFZWVlhYWFhYWFlZWXgqQL8AAAAZdFJOUwAKFJWQmyZVhi+qQYu+b3ukszfjWmGUxtl4nAW5AAAAoUlEQVQYGdXAyw7CIBRF0Q3lUoE+0tbX+f8f1RoTRw7sAOLiXxVPG9NMG2ZU5S68uGyeahxMo2NXpEI1c/R5PLObpYlazosUMAcQYgocE77rnsys67rwMZj5LMgThHIC8/TDMJx+RPoiPqW3mD7i6sAD5tKoO2jlmtfS/4jDbpsWBcgXf6UqiTlBL4mqto2dkzJV+ciL5GliFG30C404DngAG9AKhsaG3kUAAAAASUVORK5CYII=);
            position: absolute;
            left: 0;
            bottom: -10px;
        }

        .logo-find--container img {
            height: 51px;
            display: none;
        }

        .return-find--container {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .return-find--container .results .result-content {
            margin-top: 40px;
            border: 2px solid #7c8185;
            background: #fff none;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .result-content label {
            font-weight: 600;
        }


        .return-table--container table {
            border: 1px solid #dee2e6;
            border-spacing: 2px;
            border-collapse: unset;
        }

        .return-table--container table tbody tr td {
            font-size: 16px;
            line-height: 22px;
            color: #333;
            border: 1px solid #b7d6ef;
            padding: 16px 15px 14px;
            text-align: center;
            vertical-align: middle;
        }

        .return-table--container table th {
            text-align: center;
            background: var(--primary-color);
            color: #fff;
        }

        @media (max-width: 767px) {
            .logo-find--container h1 {
                font-size: 23px;
            }

            .return-table--container table th {
                min-width: 175px;
                font-size: 14px;
            }

            .return-table--container table td {
                font-size: 14px !important;
            }

            .return-table--container table {
                overflow-x: scroll;
            }
            .return-table--container {
                margin-top: 35px;
                overflow-x: scroll;
            }
        }
    </style>
@endpush

@push('javascript')
@endpush
