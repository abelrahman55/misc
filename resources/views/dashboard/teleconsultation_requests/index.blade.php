@extends('dashboard.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card mb-4 box-1">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center bg-transparent border-0">
                    <h4 class="header-page-1">Teleconsultation Requests</h4>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 dashboard-table">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Patient</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Specialty</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Complaint</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Appointment Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Assigned Doctor</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($requests as $req)
                                @php $lang = app()->getLocale(); @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">#{{ $req->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $req->client->full_name ?? ($req->client->f_name . ' ' . $req->client->l_name ?? 'N/A') }}
                                        </p>
                                        <p class="text-xs text-secondary mb-0">{{ $req->client->phone ?? '' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $req->specialty ? $req->specialty->title : 'N/A' }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0" title="{{ $req->complaint }}">
                                            {{ Str::limit($req->complaint, 40) }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $req->appointment_date ? \Carbon\Carbon::parse($req->appointment_date)->format('Y-m-d H:i') : 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $req->doctor->full_name ?? ($req->doctor->f_name ?? '—') }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $req->price ? number_format($req->price, 2) : '—' }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm
                                            @if($req->status == 'pending') bg-warning
                                            @elseif($req->status == 'offered') bg-info
                                            @elseif($req->status == 'approved') bg-primary
                                            @elseif($req->status == 'rejected') bg-danger
                                            @elseif($req->status == 'paid') bg-success
                                            @elseif($req->status == 'completed') bg-dark
                                            @endif">
                                            {{ ucfirst($req->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @if($req->medicalFiles->count())
                                            <button class="btn btn-sm btn-outline-secondary mb-0" data-bs-toggle="modal" data-bs-target="#filesModal{{ $req->id }}">
                                                Files
                                            </button>
                                            @endif

                                            <a href="{{ route('teleconsultation_requests.messages', $req->id) }}" class="btn btn-sm btn-outline-primary mb-0">
                                                 Chat
                                            </a>
                                            @if(in_array($req->status, ['paid', 'completed']))
                                                <a href="{{ route('teleconsultation_meetings.doctor', $req->id) }}" class="btn btn-sm btn-info mb-0">Meetings</a>
                                            @endif

                                            @if(in_array($req->status, ['pending', 'offered', 'rejected']))
                                            <button class="btn btn-sm {{ $req->status == 'offered' ? 'btn-info' : 'btn-primary' }} mb-0" data-bs-toggle="modal" data-bs-target="#offerModal{{ $req->id }}">
                                                {{ $req->status == 'offered' ? 'Edit Offer' : 'Offer' }}
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                {{-- Files Modal and Offer Modal here (already planned/created in previous steps) --}}
                                {{-- For brevity, including just the structures in this re-creation --}}
                                @empty
                                <tr><td colspan="9" class="text-center py-4">No requests found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Essential Modals (Brief versions for re-creation) --}}
@foreach($requests as $req)
    @if($req->medicalFiles->count())
    <div class="modal fade" id="filesModal{{ $req->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Files #{{ $req->id }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            @foreach($req->medicalFiles as $file)
                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="d-block mb-2">{{ basename($file->file_path) }}</a>
            @endforeach
        </div>
    </div></div></div>
    @endif

    <div class="modal fade" id="offerModal{{ $req->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
        <form action="{{ route('teleconsultation_requests.make_offer', $req->id) }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">{{ $req->status == 'offered' ? 'Edit Offer' : 'Make Offer' }} #{{ $req->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Doctor</label>
                    <select name="doctor_id" class="form-select">
                        @foreach($doctors as $d)
                            <option value="{{ $d->id }}" {{ $req->doctor_id == $d->id ? 'selected' : '' }}>{{ $d->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Price (EGP)</label>
                    <input type="number" name="price" class="form-control" required step="0.01" value="{{ $req->price }}">
                </div>
                <div class="mb-3">
                    <label>Offer Details (Optional)</label>
                    <textarea name="offer_details" class="form-control" rows="3">{{ $req->offer_details }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ $req->status == 'offered' ? 'Update Offer' : 'Send Offer' }}</button>
            </div>
        </form>
    </div></div></div>
@endforeach

@endsection
