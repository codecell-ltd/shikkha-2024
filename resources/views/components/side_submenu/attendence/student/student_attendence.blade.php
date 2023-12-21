
@if (Route::has('school.attendance.report'))
                            <a href="{{ route('school.attendance.report') }}" class="list-group-item @if (Route::is('school.attendance.report') || Route::is('school.attendance.report.user')) submenu active @endif">
                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                {{ __('Report') }}
                            </a>
                            @endif