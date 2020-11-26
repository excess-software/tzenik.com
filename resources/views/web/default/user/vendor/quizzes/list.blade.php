@extends(getTemplate() . '.user.vendor.layout.layout')
@section('title')
{{{ trans('admin.quizzes') }}}
@endsection
@section('page')

<section class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">

                @if (empty($quiz))
                <div class="link">
                    <h2>{{ trans('main.quizzes_list') }}</h2><i class="mdi mdi-chevron-down"></i>
                </div>
                <ul class="submenu dblock">
                    <div class="h-10"></div>
                    {{--count($lists)--}}
                    @if(empty($quizzes))
                    <div class="text-center">
                        <img src="/assets/default/images/empty/Request.png">
                        <div class="h-20"></div>
                        <span class="empty-first-line">{{ trans('main.no_quizzes') }}</span>
                        <div class="h-10"></div>

                        <div class="h-20"></div>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table ucp-table" id="request-table">
                            <thead class="thead-s">
                                <th class="cell-ta">{{ trans('main.name') }}</th>
                                <th class="text-center">{{ trans('main.students') }}</th>
                                <th class="text-center">{{ trans('main.questions') }}</th>
                                <th class="text-center">{{ trans('main.average_grade') }}</th>
                                <th class="text-center">{{ trans('main.review_needs') }}</th>
                                <th class="text-center">{{ trans('main.status') }}</th>
                                <th class="text-center" width="100">{{ trans('main.controls') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($quizzes as $quiz)
                                <tr>
                                    <td class="text-center">
                                        {{ $quiz->name }}
                                        <small class="dblock">({{ $quiz->content->title }})</small>
                                    </td>
                                    <td class="text-center">{{ count($quiz->QuizResults) }}</td>
                                    <td class="text-center">{{ count($quiz->questions) }}</td>
                                    <td class="text-center">{{ $quiz->average_grade }}</td>
                                    <td class="text-center">{{ $quiz->review_needs }}</td>
                                    <td class="text-center">
                                        @if($quiz->status == 'active')
                                        <b class="c-g">{{ trans('admin.active') }}</b>
                                        @else
                                        <span class="c-r">{{ trans('admin.disabled') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center" width="250">
                                        <a href="/user/vendor/quizzes/edit/{{ $quiz->id }}" class="gray-s"
                                            data-toggle="tooltip" title="{{ trans('main.edit_quizzes') }}"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="/user/vendor/quizzes/{{ $quiz->id }}/questions" class="gray-s"
                                            data-toggle="tooltip" title="{{ trans('main.questions') }}">
                                            <i class="fa fa-question"></i>
                                        </a>
                                        <a href="/user/vendor/quizzes/{{ $quiz->id }}/results" class="gray-s"
                                            data-toggle="tooltip" title="{{ trans('main.show_results') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button data-id="{{ $quiz->id }}" class="btn-transparent"
                                            data-toggle="tooltip" title="{{ trans('main.delete') }}" style="color: red;"><i
                                                class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="h-10"></div>
                    @endif
                </ul>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
