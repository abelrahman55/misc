@extends('dashboard.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card mb-4 box-1">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center bg-transparent border-0">
                    <h4 class="header-page-1">My Teleconsultation Requests</h4>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 dashboard-table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Specialty</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Complaint</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Doctor</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($requests as $req)
                                @php $lang = app()->getLocale(); @endphp
                                <tr>
                                    <td><h6 class="mb-0 text-sm px-3">#{{ $req->id }}</h6></td>
                                    <td><p class="text-xs font-weight-bold mb-0">{{ $req->specialty ? $req->specialty->title : 'N/A' }}</p></td>
                                    <td><p class="text-xs text-secondary mb-0">{{ Str::limit($req->complaint, 40) }}</p></td>
                                    <td><span class="text-secondary text-xs font-weight-bold">{{ $req->appointment_date ?? 'N/A' }}</span></td>
                                    <td><p class="text-xs font-weight-bold mb-0">{{ $req->doctor->full_name ?? '—' }}</p></td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $req->price ? number_format($req->price, 2) : '—' }}</p>
                                        @if($req->offer_details)
                                            <p class="text-xxs text-secondary mb-0" title="{{ $req->offer_details }}">{{ Str::limit($req->offer_details, 30) }}</p>
                                        @endif
                                    </td>
                                    <td class="align-middle text-sm"><span class="badge badge-sm bg-{{ $req->status == 'paid' ? 'success' : ($req->status == 'offered' ? 'info' : 'warning') }}">{{ $req->status }}</span></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('teleconsultation_requests.messages', $req->id) }}" class="btn btn-sm btn-outline-primary mb-0">
                                                Chat
                                            </a>
                                            @if(in_array($req->status, ['paid', 'completed']))
                                                <a href="{{ route('teleconsultation_meetings.patient', $req->id) }}" class="btn btn-sm btn-info mb-0">Meetings</a>
                                            @endif
                                            @if($req->status == 'offered')
                                                <form action="{{ route('teleconsultation_requests.respond', $req->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="btn btn-sm btn-success mb-0">Approve</button>
                                                </form>
                                                <button class="btn btn-sm btn-danger mb-0" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $req->id }}">Reject</button>
                                            @endif
                                            @if($req->status == 'approved')
                                                <form action="{{ route('teleconsultation_requests.pay', $req->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary mb-0">Pay Now</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @if($req->status == 'offered')
                                <div class="modal fade" id="rejectModal{{ $req->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                                    <form action="{{ route('teleconsultation_requests.respond', $req->id) }}" method="POST">
                                        @csrf <input type="hidden" name="status" value="rejected">
                                        <div class="modal-header"><h5 class="modal-title">Reject Offer #{{ $req->id }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                        <div class="modal-body"><textarea name="rejection_reason" class="form-control" required placeholder="Reason..."></textarea></div>
                                        <div class="modal-footer"><button type="submit" class="btn btn-danger">Confirm</button></div>
                                    </form>
                                </div></div></div>
                                @endif
                                @empty
                                <tr><td colspan="8" class="text-center py-4">No requests found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
